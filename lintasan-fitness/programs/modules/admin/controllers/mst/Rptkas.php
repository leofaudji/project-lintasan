<?php
class Rptkas extends Bismillah_Controller{
  protected $bdb ;
  public function __construct(){
    parent::__construct() ;
    $this->load->model("mst/rptkas_m") ;
    $this->bdb   = $this->rptkas_m ;
  } 

  public function index(){
    $this->load->view("mst/rptkas") ; 

  }   
 
  public function loadgrid(){ 
    $va     = json_decode($this->input->post('request'), true) ; 
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      $n = 0 ;
      $vare[0] = array("no"=>"","tgl"=>"","faktur"=>"","rekening"=>"","keterangan"=>"Saldo Awal","jumlah"=>"","total"=>string_2s($vdb['saldoawal'])) ;
      $total = $vdb['saldoawal'] ;
      while( $dbr = $this->bdb->getrow($dbd) ){     
         //$vs = $dbr;
         $vs['no'] = ++$n ;
         $vs['tgl'] = date_2d($dbr['tgl']) ;  
         $vs['faktur'] = $dbr['faktur']  ; 
         $vs['rekening'] = $dbr['rekening']  ; 
         $vs['keterangan'] = $dbr['keterangan']  ; 
         if($dbr['debet'] > 0) $vs['jumlah'] = $dbr['debet'] ;
         if($dbr['kredit'] > 0) $vs['jumlah'] = - $dbr['kredit'] ; 
         $total += $dbr['debet'] - $dbr['kredit'] ; 
         $vs['jumlah'] = string_2s($vs['jumlah']);
         $vs['total'] = string_2s($total) ; 
         $vs['username'] = $dbr['username']  ; 
         $vaa = $vs ;
         //unset($vaa['debet']) ; 
         //unset($vaa['kredit']) ; 
         $vare[]    = $vaa ;
    }

      $vare   = array("total"=>$vdb['rows']+1, "records"=>$vare ) ;
      $varpt = $vare['records'] ;
      echo(json_encode($vare)) ; 
      savesession($this, "rptkas_rpt", json_encode($varpt)) ;   
  }

  public function init(){
    savesession($this, "ssrptkas_id", "") ;    
  }

  public function showreport(){
      $data = getsession($this,"rptkas_rpt") ;  
      $data = json_decode($data,true) ;    
      unset($data[0]) ;     
      if(!empty($data)){ 
        $font = 8 ;
        $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'DaftarKas_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>LAPORAN PENERIMAAN DAN PENGELUARAN KAS</b>",$font+4,array("justification"=>"center")) ;
    $this->bospdf->ezText("") ;
    $this->bospdf->ezTable($data,"","",
                array("fontSize"=>$font,"cols"=> array(
                           "no"=>array("caption"=>"No","width"=>5,"justification"=>"right"),
                           "tgl"=>array("caption"=>"Tgl","width"=>10,"justification"=>"center"),
                           "faktur"=>array("caption"=>"Faktur","width"=>13,"justification"=>"center"),
                           "rekening"=>array("caption"=>"Rekening","width"=>10), 
                           "keterangan"=>array("caption"=>"Keterangan","wrap"=>1),
                           "jumlah"=>array("caption"=>"Jumlah","width"=>13,"justification"=>"right"),
                           "username"=>array("caption"=>"Username","width"=>10),
                           "total"=>array("caption"=>"Total","width"=>14,"justification"=>"right")))) ; 
        //print_r($data) ; 
        $this->bospdf->ezStream() ;
      }else{
         echo('data kosong') ;
      }
   }

}
?>
