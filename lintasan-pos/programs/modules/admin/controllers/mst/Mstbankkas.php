<?php
class Mstbankkas extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper("bdate") ;
        $this->load->model("mst/mstbankkas_m") ;
        $this->bdb 	= $this->mstbankkas_m ;
    }

    public function index(){
        $this->load->view("mst/mstbankkas") ;

    } 

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->bdb->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->bdb->getrow($dbd) ){
            $vs = $dbr;   
            $vs['cmdedit']    = '<button type="button" onClick="bos.mstbankkas.cmdedit(\''.$dbr['kode'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
            $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

            $vs['cmddelete']  = '<button type="button" onClick="bos.mstbankkas.cmddelete(\''.$dbr['kode'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
            $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

            $vare[]		= $vs ; 
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "ssmstbankkas_id", "") ;
    }

    public function saving(){
        $va 	= $this->input->post() ;
        $id 	= getsession($this, "ssmstbankkas_id") ; 

        $this->bdb->saving($va, $id) ;
        echo(' bos.mstbankkas.settab(0) ;  ') ;
    }

    public function deleting(){
        $va 	= $this->input->post() ; 
        $kode 	= $va['kode'] ;
        $this->bdb->delete("bank", "kode = " . $this->bdb->escape($kode)) ;
        echo(' bos.mstbankkas.grid1_reload() ; ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->mstbankkas_m->getdata($kode) ;
        if( $dbr = $this->mstbankkas_m->getrow($data) ){
            savesession($this, "ssmstbankkas_id", $dbr['kode']) ;
            $rekakt[] = array("id"=>$dbr['rekening'],"text"=>$dbr['rekening'] ." - ". $dbr['ketrekening']);


            echo('
            with(bos.mstbankkas.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#kode").val("'.$dbr['kode'].'") ;
               find("#rekening").sval('.json_encode($rekakt).') ;
               find("#keterangan").val("'.$dbr['keterangan'].'").focus() ;

            }
            bos.mstbankkas.settab(1) ;
         ') ;
        }
    }

    public function seekrekening(){
        $search     = $this->input->get('q');
        $vdb    = $this->mstbankkas_m->seekrekening($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->mstbankkas_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ".$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
}
?>
