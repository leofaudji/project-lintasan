<?php
class Rptbayar extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("mst/rptbayar_m") ;
		$this->bdb 	= $this->rptbayar_m ;
	}
 
	public function index(){
		$this->load->view("mst/rptbayar") ; 
 
	}

	public function loadgrid(){
	  $va     = json_decode($this->input->post('request'), true) ; 
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      $vaisi  = array() ;
      $n = 0 ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs 	  = $dbr;
         $vs['no'] = ++$n ;
         $vs['tgl'] = date_2d($vs['tgl']) ;
         $vs['jumlah'] = $vs['pendaftaran'] + $vs['iuran'] + $vs['sewagedung'] + $vs['suplemen'] ;
         $vs['jumlah'] = string_2s($vs['jumlah']) ;
         $vare[]	  = $vs ;   
      }
      	$value = $vare ;
		$var 	= array("total"=>$vdb['rows'], "records"=>$value) ;
      	echo(json_encode($var)) ; 
    }

	public function init(){
		savesession($this, "ssrptbayar_id", "") ; 
	}

	public function seekpel(){
		$va 	= $this->input->post() ;
		echo('   
			bos.rptbayar.grid1_reloaddata();
		')  ;
	}

}
?>
