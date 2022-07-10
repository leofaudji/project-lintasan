<?php
class Mstkdtransaksi extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper("bdate") ;
        $this->load->model("mst/mstkdtransaksi_m") ;
        $this->bdb 	= $this->mstkdtransaksi_m ;
    }

    public function index(){
        $this->load->view("mst/mstkdtransaksi") ;

    } 

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->bdb->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->bdb->getrow($dbd) ){
            $vs = $dbr;   
            $vs['cmdedit']    = '<button type="button" onClick="bos.mstkdtransaksi.cmdedit(\''.$dbr['kode'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
            $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

            $vs['cmddelete']  = '<button type="button" onClick="bos.mstkdtransaksi.cmddelete(\''.$dbr['kode'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
            $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

            $vare[]		= $vs ; 
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "ssmstkdtransaksi_id", "") ;
    }

    public function saving(){
        $va 	= $this->input->post() ;
        $id 	= getsession($this, "ssmstkdtransaksi_id") ; 

        $this->bdb->saving($va, $id) ;
        echo(' bos.mstkdtransaksi.settab(0) ;  ') ;
    }

    public function deleting(){
        $va 	= $this->input->post() ; 
        $kode 	= $va['kode'] ;
        $this->bdb->delete("kodetransaksi", "kode = " . $this->bdb->escape($kode)) ;
        echo(' bos.mstkdtransaksi.grid1_reload() ; ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->mstkdtransaksi_m->getdata($kode) ;
        if( $dbr = $this->mstkdtransaksi_m->getrow($data) ){
            savesession($this, "ssmstkdtransaksi_id", $dbr['kode']) ;
            $rekakt[] = array("id"=>$dbr['rekening'],"text"=>$dbr['rekening'] ." - ". $dbr['ketrekening']);


            echo('
            with(bos.mstkdtransaksi.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#kode").val("'.$dbr['kode'].'") ;
               find("#rekening").sval('.json_encode($rekakt).') ;
               find("#keterangan").val("'.$dbr['keterangan'].'").focus() ;

            }
            bos.mstkdtransaksi.setopt("dk","'.$dbr['dk'].'");
            bos.mstkdtransaksi.settab(1) ;
         ') ;
        }
    }

    public function seekrekening(){
        $search     = $this->input->get('q');
        $vdb    = $this->mstkdtransaksi_m->seekrekening($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->mstkdtransaksi_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ".$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
}
?>
