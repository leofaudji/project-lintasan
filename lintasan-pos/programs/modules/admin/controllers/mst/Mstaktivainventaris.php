<?php
class Mstaktivainventaris extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper("bdate") ;
        $this->load->model("mst/mstaktivainventaris_m") ;
        $this->bdb 	= $this->mstaktivainventaris_m ;
    }

    public function index(){
        $this->load->view("mst/mstaktivainventaris") ;

    } 

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->bdb->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->bdb->getrow($dbd) ){
            $dbr['tglperolehan'] = date_2d($dbr['tglperolehan']);
            $vs = $dbr;   
            $vs['cmdedit']    = '<button type="button" onClick="bos.mstaktivainventaris.cmdedit(\''.$dbr['kode'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
            $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

            $vs['cmddelete']  = '<button type="button" onClick="bos.mstaktivainventaris.cmddelete(\''.$dbr['kode'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
            $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

            $vare[]		= $vs ; 
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "ssmstaktivainventaris_id", "") ;
    }

    public function saving(){
        $va 	= $this->input->post() ;
        $id 	= getsession($this, "ssmstaktivainventaris_id") ; 

        $this->bdb->saving($va, $id) ;
        echo(' bos.mstaktivainventaris.settab(0) ;  ') ;
    }

    public function deleting(){
        $va 	= $this->input->post() ; 
        $kode 	= $va['kode'] ;
        $this->bdb->delete("aset", "kode = " . $this->bdb->escape($kode)) ;
        echo(' bos.mstaktivainventaris.grid1_reload() ; ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->mstaktivainventaris_m->getdata($kode) ;
        if( $dbr = $this->mstaktivainventaris_m->getrow($data) ){
            savesession($this, "ssmstaktivainventaris_id", $dbr['kode']) ;
            $golaset[] = array("id"=>$dbr['golongan'],"text"=>$dbr['golongan'] ." - ". $dbr['ketgolongan']);
            $cabang[] = array("id"=>$dbr['cabang'],"text"=>$dbr['cabang'] ." - ". $dbr['ketcabang']);
            $dbr['tglperolehan'] = date_2d($dbr['tglperolehan']);
            echo('
            with(bos.mstaktivainventaris.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#kode").val("'.$dbr['kode'].'") ;
               find("#golaset").sval('.json_encode($golaset).') ;
               find("#cabang").sval('.json_encode($cabang).') ;
               find("#tglperolehan").val("'.$dbr['tglperolehan'].'") ;
               find("#hp").val("'.string_2s($dbr['hargaperolehan']).'") ;
               find("#unit").val("'.$dbr['unit'].'") ;
               find("#lama").val("'.$dbr['lama'].'") ;

               find("#tarifpeny").val("'.$dbr['tarifpenyusutan'].'") ;
               find("#residu").val("'.string_2s($dbr['residu']).'") ;
               find("#keterangan").val("'.$dbr['keterangan'].'").focus() ;

            }
            bos.mstaktivainventaris.setopt("jenis","'.$dbr['jenispenyusutan'].'");
            bos.mstaktivainventaris.settab(1) ;
         ') ;
        }
    }

    public function seekgolaset(){
        $search     = $this->input->get('q');
        $vdb    = $this->mstaktivainventaris_m->seekgolaset($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->mstaktivainventaris_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ".$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
    
    public function seekcabang(){
        $search     = $this->input->get('q');
        $vdb    = $this->mstaktivainventaris_m->seekcabang($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->mstaktivainventaris_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ".$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
    
    public function getkode(){
      $n  = $this->bdb->getkode(FALSE) ;

      echo('
        bos.mstaktivainventaris.obj.find("#kode").val("'.$n.'") ;
        ') ;
   }

}
?>
