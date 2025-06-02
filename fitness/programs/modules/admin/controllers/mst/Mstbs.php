<?php
class Mstbs extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("load_m") ;
		$this->bdb 	= $this->load_m ;
	}

	public function index(){
		$this->load->view("mst/mstbs") ;

	}

	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->getconfig("brg_satuan") ;
		if($vdb !== ""){
			$vdb 	= json_decode($vdb, true) ;
			foreach ($vdb as $key => $value) {
				$vs = array("satuan"=>$value) ;
				$vs['cmdedit']    = '<button type="button" onClick="bos.mstbs.cmdedit(\''.$key.'\')"
	                           class="btn btn-default btn-grid">Koreksi</button>' ;
	         $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

	         $vare[]		= $vs ;
			}
		}

      $vare 	= array("total"=>count($vare), "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "ssmstbs_id", "") ;
		savesession($this, "ssmstbs_db", "") ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "ssmstbs_id") ;
		$vdb  = $this->bdb->getconfig("brg_satuan") ;
		if($vdb !== ""){
			$vdb 	= json_decode($vdb, true) ;
		}else{
			$vdb 	= array() ;
		}
		if($id == ''){
			$vdb[]  	= $va['satuan'] ;
		}else{
			$vdb[$id]= $va['satuan'] ;
		}

		$this->bdb->saveconfig("brg_satuan", json_encode($vdb)) ;
		echo(' bos.mstbs.settab(0) ;  ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		$vdb  = $this->bdb->getconfig("brg_satuan") ;
		$vdb 	= json_decode($vdb, true) ;
		$id 	= $va['id'] ; 
		if(isset($vdb[$id])){
			savesession($this, "ssmstbs_id", $id) ;
			echo('
				bos.mstbs.obj.find("#satuan").val("'.$vdb[$id].'") ;
				bos.mstbs.settab(1) ;
			') ;
		}
	}

}
?>
