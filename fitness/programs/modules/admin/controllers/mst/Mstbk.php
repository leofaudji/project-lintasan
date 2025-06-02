<?php
class Mstbk extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("mst/mstbk_m") ;
		$this->bdb 	= $this->mstbk_m ;
	}

	public function index(){
		$this->load->view("mst/mstbk") ;

	}

	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;
         $vs['cmdedit']    = '<button type="button" onClick="bos.mstbk.cmdedit(\''.$dbr['id'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
         $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

         $vare[]		= $vs ;
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "ssmstbk_id", "") ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "ssmstbk_id") ;

		$this->bdb->saving($va, $id) ;
		echo(' bos.mstbk.settab(0) ;  ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "ssmstbk_id", $d['id']) ;
			echo('
				bos.mstbk.obj.find("#kategori").val("'.$d['kategori'].'") ;
				bos.mstbk.obj.find("#keterangan").val("'.$d['keterangan'].'") ;
				bos.mstbk.settab(1) ;
			') ;
		}
	}

}
?>
