<?php
class Rptkreditmutasi extends Bismillah_Controller{ 
  protected $bdb ; 
  public function __construct(){ 
    parent::__construct() ;
    $this->load->model("rpt/rptkreditmutasi_m") ; 
    $this->bdb   = $this->rptkreditmutasi_m ;
  }  
 
  public function index(){
    $this->load->view("rpt/rptkreditmutasi") ; 

  }  

  public function loadgrid(){
    $va     = json_decode($this->input->post('request'), true) ; 
    $vare   = array() ; 
    $varpt  = array() ;
    $vdb    = $this->bdb->loadgrid($va) ;
    $dbd    = $vdb['db'] ; 
    $n = 0 ;
    while( $dbr = $this->bdb->getrow($dbd) ){ 
      $vs = $dbr ;
      $vs['no'] = ++$n ;
      if($va['offset'] > 0) $vs['no'] += $va['offset'] ;
      $vs['tgl'] = date_2d($vs['tgl']);
      $vs['dpokok'] = string_2s($vs['dpokok']);
      $vs['kpokok'] = string_2s($vs['kpokok']);
      $vs['kbunga'] = string_2s($vs['kbunga']);
      $vs['denda'] = string_2s($vs['denda']);
      $vs['dtitipan'] = string_2s($vs['dtitipan']);
      $vs['ktitipan'] = string_2s($vs['ktitipan']);
      unset($vs['id']) ;  
      $vare[]    = $vs ;
      unset($vs['cmdcetak']) ;       
      $varpt[]  = $vs ;
      
    }

    $vare   = array("total"=>$vdb['rows'], "records"=>$vare ) ;
    //$varpt = $vare['records'] ; 
    echo(json_encode($vare)) ; 
    savesession($this, "rptkreditmutasi_rpt", json_encode($varpt)) ;   
  }

  public function init(){
    savesession($this, "ssrptkreditmutasi_id", "") ;     
  } 

  public function showreport(){
      $data = getsession($this,"rptkreditmutasi_rpt") ;     
      $data = json_decode($data,true) ;    
      
      foreach($data as $key=>$value){
        $data[$key]['no'] = $value['no'] ;
      }

      if(!empty($data)){ 
        $font = 8 ;
        $o    = array('paper'=>'A4', 'orientation'=>'landscape', 'export'=>"",
                        'opt'=>array('export_name'=>'LaporanRealisasi_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>LAPORAN REALISASI KREDIT</b>",$font+4,array("justification"=>"center")) ;
        $this->bospdf->ezText("") ;
        $this->bospdf->ezTable($data,"","",
                array("fontSize"=>$font,"cols"=> array("No"=>array("width"=>15,"wrap"=>1),
                           "no"=>array("caption"=>"No","width"=>5,"justification"=>"right"),
                           "rekening"=>array("caption"=>"Rekening","width"=>10,"justification"=>"center"),
                           "nama"=>array("caption"=>"Nama","wrap"=>1), 
                           "alamat"=>array("caption"=>"Alamat","wrap"=>1),
                           "telepon"=>array("caption"=>"Telepon","width"=>10,"justification"=>"left"),
                           "tgl"=>array("caption"=>"Waktu Kredit;Tgl Realisasi","width"=>9,"justification"=>"center"),
                           "lama"=>array("caption"=>"Waktu Kredit;Lama","width"=>8,"justification"=>"right"),
                           "jthtmp"=>array("caption"=>"Waktu Kredit;JthTmp","width"=>9,"justification"=>"center"),
                           "saldoakhir"=>array("caption"=>"BakiDebet","width"=>12,"justification"=>"right")))) ; 
        //print_r($data) ; 
        $this->bospdf->ezStream() ;
      }else{
         echo('data kosong') ;
      }
   }

}
?>
