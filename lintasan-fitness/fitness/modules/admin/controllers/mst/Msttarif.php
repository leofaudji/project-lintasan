<?php
class Msttarif extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("mst/msttarif_m") ;
		$this->bdb 	= $this->msttarif_m ;
	} 

	public function index(){
		$this->load->view("mst/msttarif") ;

	}

	public function loadgrid(){   
		$va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;
         $vs['tgl'] = date_2d($vs['tgl']) ;
         $vs['jumlah'] = string_2s($vs['jumlah']);
         $vs['cmdedit']    = '<button type="button" onClick="bos.msttarif.cmdedit(\''.$dbr['id'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
         $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

         $vare[]		= $vs ;
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "ssmsttarif_id", "") ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "ssmsttarif_id") ;
		$va['tgl'] = date_2d($va['tgl']) ;
		$this->bdb->saving($va, $id) ;
		echo(' bos.msttarif.settab(0) ;  ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "ssmsttarif_id", $d['id']) ;
			echo('
				bos.msttarif.obj.find("#kode").val("'.$d['kode'].'") ; 
				bos.msttarif.obj.find("#keterangan").val("'.$d['keterangan'].'") ;
				bos.msttarif.obj.find("#tgl").val("'.date_2d($d['tgl']).'") ;
				bos.msttarif.obj.find("#jumlah").val("'.$d['jumlah'].'") ;
				bos.msttarif.obj.find("#rekening").val("'.$d['rekening'].'") ;
				bos.msttarif.settab(1) ;
			') ;
		}
	}

}
?>
