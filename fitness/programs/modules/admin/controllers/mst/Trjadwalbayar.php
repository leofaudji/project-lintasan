<?php
class Trjadwalbayar extends Bismillah_Controller{
  protected $bdb ;
  public function __construct(){
    parent::__construct() ;
    $this->load->model("mst/trjadwalbayar_m") ;
    $this->bdb   = $this->trjadwalbayar_m ;
  }  
  
  public function index(){
    $this->load->view("mst/trjadwalbayar") ; 

  } 

  public function loadgrid(){
    $va     = json_decode($this->input->post('request'), true) ; 
    $vare   = array() ;
    $vdb    = $this->bdb->loadgrid($va) ;
    $dbd    = $vdb['db'] ;
    $n = 0 ;
    $tahun = substr($va['tgl'],6) ;
    while( $dbr = $this->bdb->getrow($dbd) ){
      $vs = $dbr;
      $vs['tgl'] = date_2d($vs['tgl']) ; 
      $tgl     = substr($vs['tgl'],0,2) ;  
      $nwajib  = 0 ;
      $no      = 0 ; 
      ++$n ;
      $vs['no'] = $n ;
      $vs['wajib'] = $nwajib ;
      $vs['bayar'] = 0 ;
      $tepat = 0 ; 
      for($i=1;$i<=12;$i++){
        $bulan = str_pad($i, 2, "0", STR_PAD_LEFT)  ;
        $period = $tahun . "-" . $bulan;
        $date = join("-",array($tahun,$bulan,$tgl)); 
        $vr = $this->bdb->getbayar($vs['kode'],$period) ;    
        $vs[$i] = $vr['tgl'] ;     
        //$databayar = $this->bdb->getbonus($vs['kode'],$bulan) ;  
        //$vs[$i] = $vr['keterangan'] ;    
      }
      $vs['tunggakan'] = $vs['wajib'] - $vs['bayar'] ; 

      $vs['wajib'] = string_2s($vs['wajib']);
      $vs['bayar'] = string_2s($vs['bayar']);
      $vs['tunggakan'] = string_2s($vs['tunggakan']); 
       $vare[]    = $vs ;
    }

      $vare   = array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ; 
  }

  public function init(){
    savesession($this, "sstrjadwalbayar_id", "") ;    
  }


  public function seekpel(){
    echo('   
      bos.trjadwalbayar.grid1_reloaddata();
    ')  ;
  }

}
?>
