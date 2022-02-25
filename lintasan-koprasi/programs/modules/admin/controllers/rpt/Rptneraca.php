<?php
class Rptneraca extends Bismillah_Controller{
  protected $bdb ;
  public function __construct(){
    parent::__construct() ;
    $this->load->model("rpt/rptneraca_m") ;
    $this->load->model("func/akuntansi_m") ;
    $this->bdb   = $this->rptneraca_m ; 
  }  

  public function index(){ 
    $this->load->view("rpt/rptneraca") ; 

  }   

  public function loadgrid(){ 
      // AKTIVA
      $va         = json_decode($this->input->post('request'), true) ; 
      $tgl        = $va['tgl'] ;
      $tglkemarin = date("d-m-Y",strtotime($tgl)-(24*60*60)) ;
      $vare       = array() ; 
      $vdb        = $this->bdb->loadgrid($va) ;
      $dbd        = $vdb['db'] ;
      $n          = 0 ;
      while( $dbr = $this->bdb->getrow($dbd) ){
        $vs               = $dbr;  
        $vs['saldoawal']  = $this->akuntansi_m->getsaldoawal($tglkemarin,$vs['kode']) ; 
        $vs['debet']      = $this->akuntansi_m->getdebet($tgl,$vs['kode']) ;  
        $vs['kredit']     = $this->akuntansi_m->getkredit($tgl,$vs['kode']) ;  
        if(substr($vs['kode'],0,1) == "1"){
          $vs['saldoakhir'] = $vs['saldoawal'] + $vs['debet'] - $vs['kredit'] ;
        }else{
          $vs['saldoakhir'] = $vs['saldoawal'] + $vs['kredit'] - $vs['debet'];
        }
        $vs['saldoawal']  = string_2s($vs['saldoawal']) ; 
        $vs['debet']      = string_2s($vs['debet']) ; 
        $vs['kredit']     = string_2s($vs['kredit']) ; 
        $vs['saldoakhir'] = string_2s($vs['saldoakhir']) ; 
        $vare[$n++]       = $vs ;
        $vs['no']         = $n ;   
      } 
      $tsaldoawal   = $this->akuntansi_m->getsaldoawal($tglkemarin,"1") ;
      $tdebet       = $this->akuntansi_m->getdebet($tgl,"1") ;
      $tkredit      = $this->akuntansi_m->getkredit($tgl,"1") ;
      $tsaldoakhir  = $tsaldoawal + $tdebet - $tkredit ;  
      $vare[$vdb['row1']] = array("kode"=>"","keterangan"=>"TOTAL AKTIVA",
                  "saldoawal"=>string_2s($tsaldoawal),"debet"=>string_2s($tdebet),
                  "kredit"=>string_2s($tkredit),"saldoakhir"=>string_2s($tsaldoakhir)) ;  
      $rows         = $n + 1 ;     

      // PASIVA
      $vdb    = $this->bdb->loadgrid2($va) ;
      $dbd    = $vdb['db'] ;
      $n      = $rows ;
      while( $dbr = $this->bdb->getrow($dbd) ){
        $vs               = $dbr;  
        $vs['saldoawal']  = $this->akuntansi_m->getsaldoawal($tglkemarin,$vs['kode']) ; 
        $vs['debet']      = $this->akuntansi_m->getdebet($tgl,$vs['kode']) ;  
        $vs['kredit']     = $this->akuntansi_m->getkredit($tgl,$vs['kode']) ;  
        if(substr($vs['kode'],0,1) == "1"){ 
          $vs['saldoakhir'] = $vs['saldoawal'] + $vs['debet'] - $vs['kredit'] ;
        }else{
          $vs['saldoakhir'] = $vs['saldoawal'] + $vs['kredit'] - $vs['debet'];
        }
        $vs['saldoawal']    = string_2s($vs['saldoawal']) ; 
        $vs['debet']        = string_2s($vs['debet']) ; 
        $vs['kredit']       = string_2s($vs['kredit']) ; 
        $vs['saldoakhir']   = string_2s($vs['saldoakhir']) ; 
        $vare[$n++]         = $vs ;
      } 

      $tlr          = $this->akuntansi_m->getsaldoawal($tglkemarin,"4") - $this->akuntansi_m->getsaldoawal($tglkemarin,"5");
      $debetlr      = $this->akuntansi_m->getdebet($tgl,"5") ;  
      $kreditlr     = $this->akuntansi_m->getkredit($tgl,"4") ;  
      $saldoakhirlr = $tlr + $kreditlr - $debetlr ;    
      $vare[$n]     = array("kode"=>"","keterangan"=>"LABA/RUGI",
                            "saldoawal"=>string_2s($tlr),"debet"=>string_2s($debetlr),
                            "kredit"=>string_2s($kreditlr),"saldoakhir"=>string_2s($saldoakhirlr)) ;  
      $rows         = $n  ;     
      $tsaldoawal   = $this->akuntansi_m->getsaldoawal($tglkemarin,"2") + $this->akuntansi_m->getsaldoawal($tglkemarin,"3") + $tlr  ;
      $tdebet       = $this->akuntansi_m->getdebet($tgl,"2") + $this->akuntansi_m->getdebet($tgl,"3") + $debetlr ;
      $tkredit      = $this->akuntansi_m->getkredit($tgl,"2") + $this->akuntansi_m->getkredit($tgl,"3") + $kreditlr ;
      $tsaldoakhir  = $tsaldoawal - $tdebet + $tkredit   ;   
      $vare[$rows+1] = array("kode"=>"","keterangan"=>"TOTAL PASIVA",
                 "saldoawal"=>string_2s($tsaldoawal),"debet"=>string_2s($tdebet),
                 "kredit"=>string_2s($tkredit),"saldoakhir"=>string_2s($tsaldoakhir)) ;  
      $rows   += 2 ;   
      $vare   = array("total"=>$rows, "records"=>$vare ) ; 
      $varpt  = $vare['records'] ;
      echo(json_encode($vare)) ; 
      savesession($this, "rptneraca_rpt", json_encode($varpt)) ;  
  }

  public function init(){
    savesession($this, "ssrptneraca_id", "") ;    
  }


  public function showreport(){
      $data = getsession($this,"rptneraca_rpt") ;      
      $data = json_decode($data,true) ;       
      if(!empty($data)){ 
        $font = 8 ;
        $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'DaftarNeraca_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>LAPORAN NERACA</b>",$font+4,array("justification"=>"center")) ;
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
