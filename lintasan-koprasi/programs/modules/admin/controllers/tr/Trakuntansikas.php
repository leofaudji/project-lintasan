<?php
class Trakuntansikas extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("tr/trakuntansikas_m") ;
		$this->load->model("func/akuntansi_m") ;
		$this->bdb 	= $this->trakuntansikas_m ; 
	}

	public function index(){
		$this->load->view("tr/trakuntansikas") ; 

	} 

	public function init(){
		savesession($this, "sstrakuntansikas_id", "") ; 
	}

	
	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "sstrakuntansikas_id") ;
		$this->bdb->saving($va, $id) ;  
		echo('
			bos.trakuntansikas.obj.find("#jumlah").val("") ;
			bos.trakuntansikas.obj.find("#keterangan").val("") ;
			alert("Transaksi Berhasil Disimpan...") ;
		');
	}

}
?>
