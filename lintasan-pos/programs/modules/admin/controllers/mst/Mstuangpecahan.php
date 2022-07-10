<?php
class Mstuangpecahan extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper("bdate") ;
        $this->load->model("mst/mstuangpecahan_m") ;
        $this->bdb 	= $this->mstuangpecahan_m ;
    }

    public function index(){
        $this->load->view("mst/mstuangpecahan") ;

    } 

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->bdb->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->bdb->getrow($dbd) ){
            $vs = $dbr;   
            $vs['cmdedit']    = '<button type="button" onClick="bos.mstuangpecahan.cmdedit(\''.$dbr['kode'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
            $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

            $vs['cmddelete']  = '<button type="button" onClick="bos.mstuangpecahan.cmddelete(\''.$dbr['kode'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
            $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

            $vare[]		= $vs ; 
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "ssmstuangpecahan_id", "") ;
    }

    public function saving(){
        $va 	= $this->input->post() ;
        $id 	= getsession($this, "ssmstuangpecahan_id") ; 

        $this->bdb->saving($va, $id) ;
        echo(' bos.mstuangpecahan.settab(0) ;  ') ;
    }

    public function deleting(){
        $va 	= $this->input->post() ; 
        $kode 	= $va['kode'] ;
        $this->bdb->delete("uang_pecahan", "kode = " . $this->bdb->escape($kode)) ;
        echo(' bos.mstuangpecahan.grid1_reload() ; ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->mstuangpecahan_m->getdata($kode) ;
        if( $dbr = $this->mstuangpecahan_m->getrow($data) ){
            savesession($this, "ssmstuangpecahan_id", $dbr['kode']) ;


            echo('
            with(bos.mstuangpecahan.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#kode").val("'.$dbr['kode'].'") ;
               find("#pecahan").val("'.$dbr['pecahan'].'").focus() ;

            }
            bos.mstuangpecahan.setopt("jenis","'.$dbr['jenis'].'");
            bos.mstuangpecahan.settab(1) ;
         ') ;
        }
    }

}
?>
