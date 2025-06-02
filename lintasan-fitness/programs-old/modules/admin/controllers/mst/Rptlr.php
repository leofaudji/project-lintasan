<?php
class Rptlr extends Bismillah_Controller{
  protected $bdb ;
  public function __construct(){
    parent::__construct() ;
    $this->load->model("mst/rptlr_m") ;
    $this->bdb   = $this->rptlr_m ;
  }  

  public function index(){
    $this->load->view("mst/rptlr") ; 
 
  }    

  public function loadgrid(){
      $va     = json_decode($this->input->post('request'), true) ; 
      $tgl   = $va['tgl'] ; //date("d-m-Y") ;
      $tglkemarin = date("d-m-Y",strtotime($tgl)-(24*60*60)) ;
      $vare   = array() ; 
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      $n = 0 ;
      while( $dbr = $this->bdb->getrow($dbd) ){
      $vs = $dbr;  
      $vs['saldoawal'] = $this->bdb->getsaldoawal($tglkemarin,$vs['kode']) ; 
      $vs['debet'] = $this->bdb->getdebet($tgl,$vs['kode']) ;  
      $vs['kredit'] = $this->bdb->getkredit($tgl,$vs['kode']) ;  
      if(substr($vs['kode'],0,1) == "1" || substr($vs['kode'],0,1) == "5"){
        $vs['saldoakhir'] = $vs['saldoawal'] + $vs['debet'] - $vs['kredit'] ;
      }else{
        $vs['saldoakhir'] = $vs['saldoawal'] + $vs['kredit'] - $vs['debet'];
      }
      $vs['saldoawal'] = string_2s($vs['saldoawal']) ; 
      $vs['debet'] = string_2s($vs['debet']) ; 
      $vs['kredit'] = string_2s($vs['kredit']) ; 
      $vs['saldoakhir'] = string_2s($vs['saldoakhir']) ; 
      $vare[$n++]    = $vs ;
      $vs['no'] = $n ;   
    } 
      $tsaldoawal = $this->bdb->getsaldoawal($tglkemarin,"4") ;
    $tdebet = $this->bdb->getdebet($tgl,"4") ;
      $tkredit = $this->bdb->getkredit($tgl,"4") ;
      $tsaldoakhir = $tsaldoawal + $tkredit - $tdebet ;  
      $vare[$vdb['row1']] = array("kode"=>"","keterangan"=>"TOTAL PENDAPATAN",
                      "saldoawal"=>string_2s($tsaldoawal),"jenis"=>"","debet"=>string_2s($tdebet),
                      "kredit"=>string_2s($tkredit),"saldoakhir"=>string_2s($tsaldoakhir)) ;  
    $rows = $n + 1 ;     

    // PASIVA
    $vdb    = $this->bdb->loadgrid2($va) ;
      $dbd    = $vdb['db'] ;
      $n = $rows ;
      while( $dbr = $this->bdb->getrow($dbd) ){
      $vs = $dbr;  
      $vs['saldoawal'] = $this->bdb->getsaldoawal($tglkemarin,$vs['kode']) ; 
      $vs['debet'] = $this->bdb->getdebet($tgl,$vs['kode']) ;  
      $vs['kredit'] = $this->bdb->getkredit($tgl,$vs['kode']) ;  
      if(substr($vs['kode'],0,1) == "1" || substr($vs['kode'],0,1) == "5"){ 
        $vs['saldoakhir'] = $vs['saldoawal'] + $vs['debet'] - $vs['kredit'] ;
      }else{
        $vs['saldoakhir'] = $vs['saldoawal'] + $vs['kredit'] - $vs['debet'];
      }
      $vs['saldoawal'] = string_2s($vs['saldoawal']) ; 
      $vs['debet'] = string_2s($vs['debet']) ; 
      $vs['kredit'] = string_2s($vs['kredit']) ; 
      $vs['saldoakhir'] = string_2s($vs['saldoakhir']) ; 
      $vare[$n++]    = $vs ;
    } 

      $tby = $this->bdb->getsaldoawal($tglkemarin,"5");
    $debetby = $this->bdb->getdebet($tgl,"5") ;  
      $kreditby = $this->bdb->getkredit($tgl,"5") ;
      $saldoakhirby = $tby + $debetby - $kreditby ;     
    $vare[$rows+$vdb['row23']] = array("kode"=>"","keterangan"=>"TOTAL BIAYA","saldoawal"=>string_2s($tby),
                          "debet"=>string_2s($debetby),"kredit"=>string_2s($kreditby),
                          "saldoakhir"=>string_2s($saldoakhirby)) ;  
      $rows = $rows+$vdb['row23'] + 1 ;     
      $tsaldoawal = $this->bdb->getsaldoawal($tglkemarin,"4") - $this->bdb->getsaldoawal($tglkemarin,"5")  ;
    $tdebet = $this->bdb->getdebet($tgl,"5") ;
      $tkredit = $this->bdb->getkredit($tgl,"4") ;
      $tsaldoakhir = $tsaldoawal + $tkredit - $tdebet   ;   
      $vare[$rows] = array("kode"=>"","keterangan"=>"LABA RUGI","saldoawal"=>string_2s($tsaldoawal),
                "debet"=>string_2s($tdebet),"kredit"=>string_2s($tkredit),
                "saldoakhir"=>string_2s($tsaldoakhir)) ;  
    $rows += 1 ;
    $vare   = array("total"=>$rows, "records"=>$vare ) ;
      $varpt = $vare['records'] ;
    echo(json_encode($vare)) ; 
    savesession($this, "rptlabarugi_rpt", json_encode($varpt)) ; 
  }

  public function init(){
    savesession($this, "ssrptlr_id", "") ;    
  }

  public function showreport(){
      $data = getsession($this,"rptlabarugi_rpt") ;      
      $data = json_decode($data,true) ;       
      if(!empty($data)){ 
        $font = 8 ;
        $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'DaftarLabaRugi_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>LAPORAN LABA RUGI</b>",$font+4,array("justification"=>"center")) ;
    $this->bospdf->ezText("") ; 
    $this->bospdf->ezTable($data,"","",  
                array("fontSize"=>$font,"cols"=> array( 
                           "kode"=>array("caption"=>"Tgl","width"=>10),
                           "keterangan"=>array("caption"=>"Keterangan","wrap"=>1),
                           "saldoawal"=>array("caption"=>"Saldo Awal","width"=>15,"justification"=>"right"),
                          "debet"=>array("caption"=>"Debet","width"=>13,"justification"=>"right"),
                           "kredit"=>array("caption"=>"Kredit","width"=>13,"justification"=>"right"),
                           "saldoakhir"=>array("caption"=>"Saldo Akhir","width"=>15,"justification"=>"right")))) ;   
        //print_r($data) ;    
        $this->bospdf->ezStream() ; 
      }else{
         echo('data kosong') ;
      }
   }

}
?>
