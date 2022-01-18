<?php
class Mstkantor extends Bismillah_Controller{
	protected $bdb ;  
	public function __construct(){
		parent::__construct() ;
		$this->load->helper("bdate") ;
		$this->load->helper("toko") ; 
		$this->load->model("mst/mstkantor_m") ;
		$this->bdb 	= $this->mstkantor_m ;
	}

	public function index(){
		$this->load->view("mst/mstkantor") ;

	}   
 
	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;   
         $vs['cmdedit']    = '<button type="button" onClick="bos.mstkantor.cmdedit(\''.$dbr['id'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
         $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

		 $vs['cmddelete']  = '<button type="button" onClick="bos.mstkantor.cmddelete(\''.$dbr['id'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
         $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

         $vare[]		= $vs ;  
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "ssmstkantor_id", "") ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "ssmstkantor_id") ; 

		$this->bdb->saving($va, $id) ;
		echo(' bos.mstkantor.settab(0) ;  ') ;
	}

	public function deleting(){ 
		$va 	= $this->input->post() ; 
		$id 	= $va['id'] ;
		$this->bdb->delete("mst_kantor", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.mstkantor.grid1_reload() ; ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "ssmstkantor_id", $d['id']) ;   
			$customer[]   = array("id"=>$d['customer'],"text"=>$d['customer']); 
			echo('  
				bos.mstkantor.obj.find("#customer").sval('.json_encode($customer).') ; 
				bos.mstkantor.obj.find("#kode").val("'.$d['kode'].'") ;      
				bos.mstkantor.obj.find("#keterangan").val("'.$d['keterangan'].'") ;
				bos.mstkantor.obj.find("#alamat").val("'.$d['alamat'].'") ;
				bos.mstkantor.obj.find("#telepon").val("'.$d['telepon'].'") ;
				bos.mstkantor.settab(1) ;
			') ;
		}
	}

}
?>
