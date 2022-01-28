<?php
class Mstkreditcaraperhitungan extends Bismillah_Controller{
	protected $bdb ;  
	public function __construct(){
		parent::__construct() ;
		$this->load->model("mst/mstkreditcaraperhitungan_m") ;
		$this->bdb 	= $this->mstkreditcaraperhitungan_m ;
	}

	public function index(){
		$this->load->view("mst/mstkreditcaraperhitungan") ;

	}  
 
	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->bdb->getrow($dbd) ){
				$vs = $dbr;   
				$vs['cmdedit']    = '<button type="button" onClick="bos.mstkreditcaraperhitungan.cmdedit(\''.$dbr['id'].'\')"
													class="btn btn-default btn-grid">Koreksi</button>' ;
				$vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

				$vs['cmddelete']  = '<button type="button" onClick="bos.mstkreditcaraperhitungan.cmddelete(\''.$dbr['id'].'\')"
													class="btn btn-danger btn-grid">Hapus</button>' ;
				$vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

				$vare[]		= $vs ; 
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "ssmstkreditcaraperhitungan_id", "") ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "ssmstkreditcaraperhitungan_id") ; 

		$this->bdb->saving($va, $id) ;
		echo(' bos.mstkreditcaraperhitungan.settab(0) ;  ') ;
	} 

	public function deleting(){
		$va 	= $this->input->post() ; 
		$id 	= $va['id'] ;
		$this->bdb->delete("kredit_cara_perhitungan", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.mstkreditcaraperhitungan.grid1_reload() ; ') ;
	}
  
	public function editing(){ 
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "ssmstkreditcaraperhitungan_id", $d['id']) ;  
			echo('  
				bos.mstkreditcaraperhitungan.obj.find("#kode").val("'.$d['kode'].'") ;      
				bos.mstkreditcaraperhitungan.obj.find("#keterangan").val("'.$d['keterangan'].'") ;
				bos.mstkreditcaraperhitungan.settab(1) ;
			') ;
		}
	}

}
?>
