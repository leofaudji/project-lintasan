<?php
class Tabungangolongan extends Bismillah_Controller{
	protected $bdb ;  
	public function __construct(){
		parent::__construct() ;
		$this->load->helper("bdate") ;
		$this->load->helper("toko") ; 
		$this->load->model("mst/tabungangolongan_m") ;
		$this->bdb 	= $this->tabungangolongan_m ;
	} 

	public function index(){
		$this->load->view("mst/tabungangolongan") ;

	}   
 
	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;   
         $vs['cmdedit']    = '<button type="button" onClick="bos.tabungangolongan.cmdedit(\''.$dbr['id'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
         $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

		 $vs['cmddelete']  = '<button type="button" onClick="bos.tabungangolongan.cmddelete(\''.$dbr['id'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
         $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

         $vare[]		= $vs ; 
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}
 
	public function init(){
		savesession($this, "sstabungangolongan_id", "") ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "sstabungangolongan_id") ; 

		$this->bdb->saving($va, $id) ;
		echo(' bos.tabungangolongan.settab(0) ;  ') ;
	}

	public function deleting(){
		$va 	= $this->input->post() ; 
		$id 	= $va['id'] ;
		$this->bdb->delete("tabungan_golongan", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.tabungangolongan.grid1_reload() ; ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "sstabungangolongan_id", $d['id']) ;  
			$rekening[]   = array("id"=>$d['rekening'],"text"=>$d['rekening']);
			$rekening_bunga[]   = array("id"=>$d['rekening_bunga'],"text"=>$d['rekening_bunga']);
			$rate[]   = array("id"=>$d['rate'],"text"=>$d['rate']);
			echo('  
				bos.tabungangolongan.obj.find("#kode").val("'.$d['kode'].'") ;      
				bos.tabungangolongan.obj.find("#keterangan").val("'.$d['keterangan'].'") ;
				bos.tabungangolongan.obj.find("#rekening").sval('.json_encode($rekening).') ;		 
				bos.tabungangolongan.obj.find("#rekening_bunga").sval('.json_encode($rekening_bunga).') ;		 
				bos.tabungangolongan.obj.find("#saldo_minimum").val("'.$d['saldo_minimum'].'") ; 
				bos.tabungangolongan.obj.find("#saldo_minimum_bunga").val("'.$d['saldo_minimum_bunga'].'") ; 
				bos.tabungangolongan.obj.find("#rate").sval('.json_encode($rate).') ;		 
				bos.tabungangolongan.settab(1) ;
			') ;
		}
	}

}
?>
