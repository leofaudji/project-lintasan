<?php
class Mstsatuan extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper("bdate") ;
        $this->load->model("mst/mstsatuan_m") ;
        $this->bdb 	= $this->mstsatuan_m ;
    }

    public function index(){
        $this->load->view("mst/mstsatuan") ;

    } 

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->bdb->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->bdb->getrow($dbd) ){
            $vs = $dbr;   
            $vs['cmdedit']    = '<button type="button" onClick="bos.mstsatuan.cmdedit(\''.$dbr['kode'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
            $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

            $vs['cmddelete']  = '<button type="button" onClick="bos.mstsatuan.cmddelete(\''.$dbr['kode'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
            $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

            $vare[]		= $vs ; 
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "ssmstsatuan_id", "") ;
    }

    public function saving(){
        $va 	= $this->input->post() ;
        $id 	= getsession($this, "ssmstsatuan_id") ; 

        $this->bdb->saving($va, $id) ;
        echo(' bos.mstsatuan.settab(0) ;  ') ;
    }

    public function deleting(){
        $va 	= $this->input->post() ; 
        $kode 	= $va['kode'] ;
        $this->bdb->delete("satuan", "kode = " . $this->bdb->escape($kode)) ;
        echo(' bos.mstsatuan.grid1_reload() ; ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->mstsatuan_m->getdata($kode) ;
        if( $dbr = $this->mstsatuan_m->getrow($data) ){
            savesession($this, "ssmstsatuan_id", $dbr['kode']) ;

            echo('
            with(bos.mstsatuan.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#kode").val("'.$dbr['kode'].'") ;
               find("#keterangan").val("'.$dbr['keterangan'].'").focus() ;

            }
            bos.mstsatuan.settab(1) ;
         ') ;
        }
    }

}
?>
