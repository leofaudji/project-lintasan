<?php
class Rptjdwlpel extends Bismillah_Controller{
  protected $bdb ; 
  public function __construct(){
    parent::__construct() ;
    $this->load->model("mst/rptjdwlpel_m") ;
    $this->bdb   = $this->rptjdwlpel_m ;
  }
 
  public function index(){
    $this->load->view("mst/rptjdwlpel") ; 
 
  }  

  public function loadgrid(){
    $va     = json_decode($this->input->post('request'), true) ; 
    $vare   = array() ;
    $vdb    = $this->bdb->loadgrid($va) ;
    $dbd    = $vdb['data'] ;   
    $no     = $vdb['rows'] ;
    $var   = array("total"=>$no, "records"=>$dbd) ; 
    echo(json_encode($var)) ; 
  }

  public function init(){
    savesession($this, "ssrptjdwlpel_id", "") ; 
    $kode   = $this->bdb->getfaktur(false) ;  
  }

  public function seekpel(){
    $va   = $this->input->post() ;
    $tr   = $this->bdb->stpelanggan($va) ;    
    echo('   
      bos.rptjdwlpel.grid1_reloaddata();
    ')  ;
  }

}
?>
