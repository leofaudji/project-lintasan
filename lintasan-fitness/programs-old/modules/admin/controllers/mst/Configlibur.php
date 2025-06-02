<?php
class Configlibur extends Bismillah_Controller{
  protected $bdb ; 
  public function __construct(){
    parent::__construct() ;
    $this->load->model("mst/configlibur_m") ;
    $this->bdb   = $this->configlibur_m ;
  }
 
  public function index(){
    $data['bdb'] = $this->configlibur_m ;      
    $this->load->view("mst/configlibur",$data) ; 
  }  

  public function init(){
    savesession($this, "ssconfiglibur_id", "") ; 
  }

  public function libur(){ 
    $va   = $this->input->post() ;  
    $dtgl = date("Y-m-d",$va['tgl']) ;       
    if($va['clibur'] == "Y"){
      $this->bdb->delete("harilibur","tgl = " . $this->bdb->escape($dtgl)) ;   
      $this->bdb->update("harilibur",array("tgl"=>$dtgl,"keterangan"=>$va['harilibur']),"tgl = " . $dtgl) ;   
    }else{
      $this->bdb->delete("harilibur","tgl = " . $this->bdb->escape($dtgl)) ;    
    }
    echo('   
      UpdCell("' . $va['clibur'] . '");
    ')  ;
  }

}
?>
