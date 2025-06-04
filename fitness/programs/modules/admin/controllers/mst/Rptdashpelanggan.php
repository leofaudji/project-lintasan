<?php
class Rptdashpelanggan extends Bismillah_Controller{
  protected $bdb ; 
  public function __construct(){ 
    parent::__construct() ;
    $this->load->helper("bdate") ; 
    $this->load->helper("toko") ; 
    $this->load->model("mst/rptdashpelanggan_m") ;
    $this->bdb   = $this->rptdashpelanggan_m ;
  }

  public function index(){
    $this->load->view("mst/rptdashpelanggan") ;
  
  }  

  public function init(){
    savesession($this, "ssrptdashpelanggan_id", "") ;
  } 
  
  public function loaddata(){
    $va   = $this->bdb->loaddata() ;  
    //print_r($va) ;
    $image = '<img src=\"./uploads/no-image.png\" class=\"img-responsive\"/>' ; ;
    if(!empty($va['data_var'])){      
      $image 	= '<img src=\"'.base_url($va['data_var']).'\" class=\"img-responsive\"/>' ;
    }
    //
    echo('  
      bos.rptdashpelanggan.obj.find("#memberid").html("ID: '.$va['pelanggan'].'") ;  
      bos.rptdashpelanggan.obj.find("#membernama").html("'.strtoupper($va['nama']).'") ;        
      bos.rptdashpelanggan.obj.find("#memberfoto").html("'.$image.'") ;

    ') ; 
  }


}
?>
