<?php
class Mstpel extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->helper("bdate") ;
		$this->load->model("mst/mstpel_m") ;
		$this->bdb 	= $this->mstpel_m ;
	}

	public function index(){
		$this->load->view("mst/mstpel") ;

	}

	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;
			$vs['tgl_daftar'] = date("d-m-Y", strtotime($vs['tgl_daftar'])) ;
         $vs['cmdedit']    = '<button type="button" onClick="bos.mstpel.cmdedit(\''.$dbr['id'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
         $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

			$vs['cmddelete']  = '<button type="button" onClick="bos.mstpel.cmddelete(\''.$dbr['id'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
         $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

         $vare[]		= $vs ;
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "ssmstpel_id", "") ;
		$kode 	= $this->bdb->getkode(false) ;
		echo('
			bos.mstpel.obj.find("#kode").html("'.$kode.'") ;
		') ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "ssmstpel_id") ;

		$this->bdb->saving($va, $id) ;
		echo(' bos.mstpel.settab(0) ;  ') ;
	}

	public function deleting(){
		$va 	= $this->input->post() ;
		$id 	= $va['id'] ;
		$this->bdb->delete("mst_pelanggan", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.mstpel.grid1_reload() ; ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "ssmstpel_id", $d['id']) ;
			$d['tgl_lahir'] 	= date("d-m-Y", strtotime($d['tgl_lahir'])) ;
			$d['tgl_daftar'] 	= date("d-m-Y", strtotime($d['tgl_daftar'])) ;
			echo('
				bos.mstpel.obj.find("#kode").html("'.$d['kode'].'") ;
				bos.mstpel.obj.find("#tgl_lahir").val("'.$d['tgl_lahir'].'") ;
				bos.mstpel.obj.find("#nama").val("'.$d['nama'].'") ;
				bos.mstpel.obj.find("#alamat").val("'.$d['alamat'].'") ;
				bos.mstpel.obj.find("#hp").val("'.$d['hp'].'") ;
				bos.mstpel.obj.find("#email").val("'.$d['email'].'") ;
				bos.mstpel.obj.find("#tempat_lahir").val("'.$d['tempat_lahir'].'") ;
				bos.mstpel.obj.find("#tgl_lahir").val("'.$d['tgl_lahir'].'") ;
				bos.mstpel.settab(1) ;
			') ;
		}
	}

}
?>
