<?php
class Rptkas extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("rpt/rptkas_m") ;
		$this->bdb 	= $this->rptkas_m ;
	} 

	public function index(){
		$this->load->view("rpt/rptkas") ; 

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
         $vs['tgl'] = date_2d($vs['tgl']) ;  
         if($vs['debet'] > 0) $vs['jumlah'] = $vs['debet'] ;
         if($vs['kredit'] > 0) $vs['jumlah'] = -$vs['kredit'] ; 
         $total += $vs['debet'] - $vs['kredit'] ; 
         $vs['jumlah'] = string_2s($vs['jumlah']);
         $vs['total'] = string_2s($total) ;
         $vare[]		= $vs ;
	  }

      $vare 	= array("total"=>$vdb['rows']+1, "records"=>$vare ) ;
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
