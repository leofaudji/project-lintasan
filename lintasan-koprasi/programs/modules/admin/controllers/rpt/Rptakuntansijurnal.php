<?php
class Rptakuntansijurnal extends Bismillah_Controller{
  protected $bdb ;
  public function __construct(){
    parent::__construct() ;
    $this->load->model("rpt/rptakuntansijurnal_m") ;
    $this->bdb   = $this->rptakuntansijurnal_m ; 
  } 

  public function index(){
    $this->load->view("rpt/rptakuntansijurnal") ; 

  }   

  public function loadgrid(){
      $va     = json_decode($this->input->post('request'), true) ; 
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      $n = 0 ;
      $cekfaktur  = "" ;  
      $rowtampil  = "" ;
      $faktur     = "" ;
      $tgl        = "" ;

      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;

        if($cekfaktur <> $dbr['faktur']){
          $cekfaktur = $dbr['faktur'] ;
          $rowtampil = ++$n ;
          $faktur = $dbr ['faktur'] ;
          $tgl = date_2d($dbr ['tgl']) ;
        }else{
          $cekfaktur = $dbr['faktur'] ;  
          $rowtampil = "" ;
          $faktur = "" ;
          $tgl = "" ;
        }

         $vs['no']      = $rowtampil ;
         if($va['offset'] > 0) $vs['no'] += $va['offset'] ; 
         $vs['tgl']     = $tgl ;  
         $vs['faktur']  = $faktur ;
         $vs['debet']   = string_2s($vs['debet']);
         $vs['kredit']  = string_2s($vs['kredit']);
         $vare[]    = $vs ;
    }

      $vare   = array("total"=>$vdb['rows'], "records"=>$vare ) ;
      $varpt = $vare['records'] ;
      echo(json_encode($vare)) ; 
      savesession($this, "rptakuntansijurnal_rpt", json_encode($varpt)) ; 
  }

  public function init(){
    savesession($this, "ssrptakuntansijurnal_id", "") ;    
  }


  public function showreport(){
      $data = getsession($this,"rptakuntansijurnal_rpt") ;      
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
                           "faktur"=>array("caption"=>"Faktur","width"=>15,"justification"=>"center"),
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
