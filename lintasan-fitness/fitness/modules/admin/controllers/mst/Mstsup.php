<?php
class Mstsup extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->helper("bdate") ;
		$this->load->model("mst/mstsup_m") ;
		$this->bdb 	= $this->mstsup_m ;
	}

	public function index(){
		$this->load->view("mst/mstsup") ;

	}

	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;
         $vs['cmdedit']    = '<button type="button" onClick="bos.mstsup.cmdedit(\''.$dbr['id'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
         $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

			$vs['cmddelete']  = '<button type="button" onClick="bos.mstsup.cmddelete(\''.$dbr['id'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
         $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

         $vare[]		= $vs ;
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "ssmstsup_id", "") ;
		$kode 	= $this->bdb->getkode(false) ;
		echo('
			bos.mstsup.obj.find("#kode").html("'.$kode.'") ;
		') ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "ssmstsup_id") ;

		$this->bdb->saving($va, $id) ;
		echo(' bos.mstsup.settab(0) ;  ') ;
	}

	public function deleting(){
		$va 	= $this->input->post() ;
		$id 	= $va['id'] ;
		$this->bdb->delete("mst_supplier", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.mstsup.grid1_reload() ; ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "ssmstsup_id", $d['id']) ;
			echo('
				bos.mstsup.obj.find("#kode").html("'.$d['kode'].'") ;
				bos.mstsup.obj.find("#nama").val("'.$d['nama'].'") ;
				bos.mstsup.obj.find("#alamat").val("'.$d['alamat'].'") ;
				bos.mstsup.obj.find("#hp").val("'.$d['hp'].'") ;
				bos.mstsup.obj.find("#email").val("'.$d['email'].'") ;
				bos.mstsup.settab(1) ;
			') ;
		}
	}

}
?>
