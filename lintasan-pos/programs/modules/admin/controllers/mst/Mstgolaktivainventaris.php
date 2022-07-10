<?php
class Mstgolaktivainventaris extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper("bdate") ;
        $this->load->model("mst/mstgolaktivainventaris_m") ;
        $this->bdb 	= $this->mstgolaktivainventaris_m ;
    }

    public function index(){
        $this->load->view("mst/mstgolaktivainventaris") ;

    } 

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->bdb->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->bdb->getrow($dbd) ){
            $vs = $dbr;   
            $vs['cmdedit']    = '<button type="button" onClick="bos.mstgolaktivainventaris.cmdedit(\''.$dbr['kode'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
            $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

            $vs['cmddelete']  = '<button type="button" onClick="bos.mstgolaktivainventaris.cmddelete(\''.$dbr['kode'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
            $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

            $vare[]		= $vs ; 
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "ssmstgolaktivainventaris_id", "") ;
    }

    public function saving(){
        $va 	= $this->input->post() ;
        $id 	= getsession($this, "ssmstgolaktivainventaris_id") ; 

        $this->bdb->saving($va, $id) ;
        echo(' bos.mstgolaktivainventaris.settab(0) ;  ') ;
    }

    public function deleting(){
        $va 	= $this->input->post() ; 
        $kode 	= $va['kode'] ;
        $this->bdb->delete("aset_golongan", "kode = " . $this->bdb->escape($kode)) ;
        echo(' bos.mstgolaktivainventaris.grid1_reload() ; ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->mstgolaktivainventaris_m->getdata($kode) ;
        if( $dbr = $this->mstgolaktivainventaris_m->getrow($data) ){
            savesession($this, "ssmstgolaktivainventaris_id", $dbr['kode']) ;
            $rekakmpeny[] = array("id"=>$dbr['rekakmpeny'],"text"=>$dbr['rekakmpeny'] ." - ". $dbr['ketrekakmpeny']);
            $rekbypeny[] = array("id"=>$dbr['rekbypeny'],"text"=>$dbr['rekbypeny'] ." - ". $dbr['ketrekbypeny']);

            echo('
            with(bos.mstgolaktivainventaris.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#kode").val("'.$dbr['kode'].'") ;
               find("#rekakmpeny").sval('.json_encode($rekakmpeny).') ;
               find("#rekbypeny").sval('.json_encode($rekbypeny).') ;
               find("#keterangan").val("'.$dbr['keterangan'].'").focus() ;
            }
            bos.mstgolaktivainventaris.setopt("jenis","'.$dbr['jenis'].'");
            bos.mstgolaktivainventaris.settab(1) ;
         ') ;
        }
    }

    public function seekrekakmpeny(){
        $search     = $this->input->get('q');
        $vdb    = $this->mstgolaktivainventaris_m->seekrekakmpeny($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->mstgolaktivainventaris_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ".$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function seekrekbypeny(){
        $search     = $this->input->get('q');
        $vdb    = $this->mstgolaktivainventaris_m->seekrekbypeny($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->mstgolaktivainventaris_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ". $dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
    
    

}
?>
