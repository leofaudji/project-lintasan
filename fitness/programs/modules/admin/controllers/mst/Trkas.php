<?php
class Trkas extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("mst/trkas_m") ;
		$this->bdb 	= $this->trkas_m ; 
	}

	public function index(){
		$this->load->view("mst/trkas") ; 

	} 

	public function init(){
		savesession($this, "sstrkas_id", "") ; 
	}

	
	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "sstrkas_id") ;
		$this->bdb->saving($va, $id) ;  
		echo('
			bos.trkas.obj.find("#jumlah").val("") ;
			bos.trkas.obj.find("#keterangan").val("") ;
			alert("Transaksi Berhasil Disimpan...") ;
		');
	}

}
?>
