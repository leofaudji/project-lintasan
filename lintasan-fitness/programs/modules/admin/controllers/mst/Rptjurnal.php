<?php
class Rptjurnal extends Bismillah_Controller{
  protected $bdb ;
  public function __construct(){
    parent::__construct() ;
    $this->load->model("mst/rptjurnal_m") ;
    $this->bdb   = $this->rptjurnal_m ;
  } 

  public function index(){
    $this->load->view("mst/rptjurnal") ; 

  }   

  public function loadgrid(){
    $va     = json_decode($this->input->post('request'), true) ; 
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      $n = 0 ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;
         $vs['no'] = ++$n ;
         $vs['tgl'] = date_2d($vs['tgl']) ;  
         $vs['debet'] = string_2s($vs['debet']);
         $vs['kredit'] = string_2s($vs['kredit']);
         $vare[]    = $vs ;
    }

      $vare   = array("total"=>$vdb['rows'], "records"=>$vare ) ;
      $varpt = $vare['records'] ;
      echo(json_encode($vare)) ; 
      savesession($this, "rptjurnal_rpt", json_encode($varpt)) ; 
  }

  public function init(){
    savesession($this, "ssrptjurnal_id", "") ;    
  }


  public function showreport(){
      $data = getsession($this,"rptjurnal_rpt") ;      
      $data = json_decode($data,true) ;      
      if(!empty($data)){  
        $font = 8 ;
        $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'DaftarJurnal_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>LAPORAN JURNAL UMUM</b>",$font+4,array("justification"=>"center")) ;
    $this->bospdf->ezText("") ; 
    $this->bospdf->ezTable($data,"","",  
                array("fontSize"=>$font,"cols"=> array( 
                           "no"=>array("caption"=>"No","width"=>5,"justification"=>"right"),
                           "tgl"=>array("caption"=>"Tgl","width"=>10,"justification"=>"center"),
                           "faktur"=>array("caption"=>"Faktur","width"=>14,"justification"=>"center"),
                           "rekening"=>array("caption"=>"Rekening","width"=>12),
                           "keterangan"=>array("caption"=>"Keterangan","wrap"=>1),
                           "debet"=>array("caption"=>"Debet","width"=>13,"justification"=>"right"),
                           "kredit"=>array("caption"=>"Kredit","width"=>13,"justification"=>"right"),
                           "username"=>array("caption"=>"Username","width"=>8)))) ;   
        //print_r($data) ;    
        $this->bospdf->ezStream() ; 
      }else{
         echo('data kosong') ;
      }
   }

}
?>
