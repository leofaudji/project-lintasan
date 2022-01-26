<?php
class Mstkreditgolongan extends Bismillah_Controller{
	protected $bdb ;  
	public function __construct(){
		parent::__construct() ;
		$this->load->helper("bdate") ;
		$this->load->model("mst/mstkreditgolongan_m") ;
		$this->bdb 	= $this->mstkreditgolongan_m ;
	} 

	public function index(){
		$this->load->view("mst/mstkreditgolongan") ;

	}   
 
	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;   
         $vs['cmdedit']    = '<button type="button" onClick="bos.mstkreditgolongan.cmdedit(\''.$dbr['id'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
         $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

		 $vs['cmddelete']  = '<button type="button" onClick="bos.mstkreditgolongan.cmddelete(\''.$dbr['id'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
         $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

         $vare[]		= $vs ; 
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}
 
	public function init(){
		savesession($this, "ssmstkreditgolongan_id", "") ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "ssmstkreditgolongan_id") ; 

		$this->bdb->saving($va, $id) ;
		echo(' bos.mstkreditgolongan.settab(0) ;  ') ; 
	}

	public function deleting(){
		$va 	= $this->input->post() ; 
		$id 	= $va['id'] ;
		$this->bdb->delete("kredit_golongan", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.mstkreditgolongan.grid1_reload() ; ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "ssmstkreditgolongan_id", $d['id']) ;  
			$rekening_pokok[]   = array("id"=>$d['rekening_pokok'],"text"=>$d['rekening_pokok']);
			$rekening_bunga[]   = array("id"=>$d['rekening_bunga'],"text"=>$d['rekening_bunga']);
			$rekening_administrasi[]   = array("id"=>$d['rekening_bunga'],"text"=>$d['rekening_administrasi']);
			$rekening_materai[]   = array("id"=>$d['rekening_bunga'],"text"=>$d['rekening_materai']);
			$rekening_denda[]   = array("id"=>$d['rekening_bunga'],"text"=>$d['rekening_denda']);
			echo('  
				bos.mstkreditgolongan.obj.find("#kode").val("'.$d['kode'].'") ;      
				bos.mstkreditgolongan.obj.find("#keterangan").val("'.$d['keterangan'].'") ;
				bos.mstkreditgolongan.obj.find("#rekening_pokok").sval('.json_encode($rekening_pokok).') ;		 
				bos.mstkreditgolongan.obj.find("#rekening_bunga").sval('.json_encode($rekening_bunga).') ;		 
				bos.mstkreditgolongan.obj.find("#rekening_administrasi").sval('.json_encode($rekening_administrasi).') ;		 
				bos.mstkreditgolongan.obj.find("#rekening_materai").sval('.json_encode($rekening_materai).') ;		 
				bos.mstkreditgolongan.obj.find("#rekening_denda").sval('.json_encode($rekening_denda).') ;		 
				bos.mstkreditgolongan.settab(1) ;
			') ;
		}
	}

}
?>
