<?php
class Mstkreditagunan extends Bismillah_Controller{
	protected $bdb ;  
	public function __construct(){
		parent::__construct() ;
		$this->load->helper("bdate") ;
		$this->load->model("mst/mstkreditagunan_m") ;
		$this->bdb 	= $this->mstkreditagunan_m ;
	}

	public function index(){
		$this->load->view("mst/mstkreditagunan") ;

	}   
 
	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;   
         $vs['cmdedit']    = '<button type="button" onClick="bos.mstkreditagunan.cmdedit(\''.$dbr['id'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
         $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

		 $vs['cmddelete']  = '<button type="button" onClick="bos.mstkreditagunan.cmddelete(\''.$dbr['id'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
         $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

         $vare[]		= $vs ; 
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}
 
	public function init(){
		savesession($this, "ssmstkreditagunan_id", "") ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "ssmstkreditagunan_id") ; 

		$this->bdb->saving($va, $id) ;
		echo(' bos.mstkreditagunan.settab(0) ;  ') ;
	}

	public function deleting(){
		$va 	= $this->input->post() ;  
		$id 	= $va['id'] ;
		$this->bdb->delete("mst_jenis_agunan", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.mstkreditagunan.grid1_reload() ; ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "ssmstkreditagunan_id", $d['id']) ;  
			echo('  
				bos.mstkreditagunan.obj.find("#kode").val("'.$d['kode'].'") ;       
				bos.mstkreditagunan.obj.find("#keterangan").val("'.$d['keterangan'].'") ;
				bos.mstkreditagunan.obj.find("#data_kategori").val("'.$d['data_kategori'].'") ;
				bos.mstkreditagunan.settab(1) ;
			') ;
		}
	}

}
?>
