<?php
class Mstao extends Bismillah_Controller{
	protected $bdb ;  
	public function __construct(){
		parent::__construct() ;
		$this->load->helper("bdate") ; 
		$this->load->model("mst/mstao_m") ;
		$this->bdb 	= $this->mstao_m ;
	}

	public function index(){
		$this->load->view("mst/mstao") ;

	}   
 
	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;   
         $vs['cmdedit']    = '<button type="button" onClick="bos.mstao.cmdedit(\''.$dbr['id'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
         $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

		 		 $vs['cmddelete']  = '<button type="button" onClick="bos.mstao.cmddelete(\''.$dbr['id'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
         $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

         $vare[]		= $vs ; 
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "ssmstao_id", "") ;
	}

	public function saving(){ 
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "ssmstao_id") ; 

		$this->bdb->saving($va, $id) ;
		echo(' bos.mstao.settab(0) ;  ') ;
	}

	public function deleting(){
		$va 	= $this->input->post() ; 
		$id 	= $va['id'] ;
		$this->bdb->delete("mst_ao", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.mstao.grid1_reload() ; ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "ssmstao_id", $d['id']) ;  
			echo('  
				bos.mstao.obj.find("#kode").val("'.$d['kode'].'") ;      
				bos.mstao.obj.find("#keterangan").val("'.$d['keterangan'].'") ;
				bos.mstao.settab(1) ;
			') ;
		}
	}

}
?>
