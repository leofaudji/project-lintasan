<?php
class Rptakuntansikas extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("rpt/rptakuntansikas_m") ;
		$this->bdb 	= $this->rptakuntansikas_m ;
	} 

	public function index(){
		$this->load->view("rpt/rptakuntansikas") ;  

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
         $vs = $dbr;
         $vs['no'] = ++$n ;
         if($va['offset'] > 0) $vs['no'] += $va['offset'] ; 
         $vs['tgl'] = date_2d($vs['tgl']) ;  
         if($vs['debet'] > 0) $vs['jumlah'] = $vs['debet'] ;
         if($vs['kredit'] > 0) $vs['jumlah'] = -$vs['kredit'] ; 
         $total += $vs['debet'] - $vs['kredit'] ; 
         $vs['jumlah'] = string_2s($vs['jumlah']);
         $vs['total'] = string_2s($total) ;
         unset($vs['debet']);
         unset($vs['kredit']);
         $vare[]		= $vs ;
      }

     $vare 	= array("total"=>$vdb['rows']+1, "records"=>$vare ) ;
     $varpt = $vare['records'] ;
     echo(json_encode($vare)) ; 
     savesession($this, "rptakuntansikas_rpt", json_encode($varpt)) ;   
	}

	public function init(){
		savesession($this, "ssrptakuntansikas_id", "") ;    
	}

	public function showreport(){
      $data = getsession($this,"rptakuntansikas_rpt") ;      
      $data = json_decode($data,true) ;   
      //print_r($data) ; 
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
			                     "faktur"=>array("caption"=>"Faktur","width"=>14,"justification"=>"center"),
			                     "rekening"=>array("caption"=>"Rekening","width"=>10), 
			                     "keterangan"=>array("caption"=>"Keterangan","wrap"=>1),
			                     "jumlah"=>array("caption"=>"Jumlah","width"=>14,"justification"=>"right"),
			                     "total"=>array("caption"=>"Total","width"=>16,"justification"=>"right"),
			                 	   "username"=>array("caption"=>"Username","width"=>8)))) ; 
         //print_r($data) ; 
         $this->bospdf->ezStream() ;
      }else{
         echo('data kosong') ;
      }
   }

}
?>
