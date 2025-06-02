<?php
class Mstkasir extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){ 
		parent::__construct() ;
		$this->load->helper("bdate") ;
		$this->load->model("mst/mstkasir_m") ;
		$this->bdb 	= $this->mstkasir_m ;
	}

	public function index(){
		$this->load->view("mst/mstkasir") ;

	}

	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;  
         $vs['cmdedit']    = '<button type="button" onClick="bos.mstkasir.cmdedit(\''.$dbr['id'].'\')"
                           class="btn btn-default btn-grid">Bayar</button>' ; 
         $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

			$vs['cmddelete']  = '<button type="button" onClick="bos.mstkasir.cmddelete(\''.$dbr['id'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
         $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

         $vare[]		= $vs ;
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "ssmstkasir_id", "") ;
		$kode 	= $this->bdb->getkode(false) ;
		echo('
			bos.mstkasir.obj.find("#kode").html("'.$kode.'") ;
		') ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "ssmstkasir_id") ;

		$this->bdb->saving($va, $id) ;
		echo(' bos.mstkasir.settab(0) ;  ') ;
	}

	public function deleting(){
		$va 	= $this->input->post() ; 
		$id 	= $va['id'] ;
		$this->bdb->delete("pelanggan", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.mstkasir.grid1_reload() ; ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "ssmstkasir_id", $d['id']) ; 
			$d['tgllahir'] 	= date("d-m-Y", strtotime($d['tgllahir'])) ;
			$d['tgl'] 	= date("d-m-Y", strtotime($d['tgl'])) ;
			echo('  
				bos.mstkasir.obj.find("#kode").html("'.$d['kode'].'") ;
				bos.mstkasir.obj.find("#kodefinger").html("'.$d['kodefinger'].'") ;
				bos.mstkasir.obj.find("#tgl").val("'.$d['tgl'].'") ;
				bos.mstkasir.obj.find("#nama").val("'.$d['nama'].'") ;
				bos.mstkasir.obj.find("#alamat").val("'.$d['alamat'].'") ;
				bos.mstkasir.obj.find("#telepon").val("'.$d['telepon'].'") ;
				bos.mstkasir.obj.find("#email").val("'.$d['email'].'") ;
				bos.mstkasir.obj.find("#tempatlahir").val("'.$d['tempatlahir'].'") ;
				bos.mstkasir.obj.find("#jeniskelamin").val("'.$d['jeniskelamin'].'") ;
				bos.mstkasir.obj.find("#tgllahir").val("'.$d['tgllahir'].'") ;
				bos.mstkasir.obj.find("#statuspelanggan").val("'.$d['statuspelanggan'].'") ;
				bos.mstkasir.settab(1) ;
			') ;
		}
	}

}
?>
