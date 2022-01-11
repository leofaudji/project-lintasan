<?php
class Tabungankodetransaksi extends Bismillah_Controller{
	protected $bdb ;  
	public function __construct(){
		parent::__construct() ;
		$this->load->helper("bdate") ;
		$this->load->helper("toko") ; 
		$this->load->model("mst/tabungankodetransaksi_m") ;
		$this->bdb 	= $this->tabungankodetransaksi_m ;
	} 

	public function index(){
		$this->load->view("mst/tabungankodetransaksi") ;

	}   
 
	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;   
         $vs['cmdedit']    = '<button type="button" onClick="bos.tabungankodetransaksi.cmdedit(\''.$dbr['id'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
         $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

		 $vs['cmddelete']  = '<button type="button" onClick="bos.tabungankodetransaksi.cmddelete(\''.$dbr['id'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
         $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

         $vare[]		= $vs ; 
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}
 
	public function init(){
		savesession($this, "sstabungankodetransaksi_id", "") ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "sstabungankodetransaksi_id") ; 

		$this->bdb->saving($va, $id) ;
		echo(' bos.tabungankodetransaksi.settab(0) ;  ') ;
	}

	public function deleting(){
		$va 	= $this->input->post() ; 
		$id 	= $va['id'] ;
		$this->bdb->delete("tabungan_kodetransaksi", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.tabungankodetransaksi.grid1_reload() ; ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "sstabungankodetransaksi_id", $d['id']) ;  
			$rekening[]   = array("id"=>$d['rekening'],"text"=>$d['rekening']); 
			echo('  
				bos.tabungankodetransaksi.obj.find("#kode").val("'.$d['kode'].'") ;      
				bos.tabungankodetransaksi.obj.find("#keterangan").val("'.$d['keterangan'].'") ;
				bos.tabungankodetransaksi.obj.find("#rekening").sval('.json_encode($rekening).') ;		 
				bjs.setopt(bos.tabungankodetransaksi.obj, "dk", "'.$d['dk'].'") ; 
				bos.tabungankodetransaksi.settab(1) ;
			') ;
		}
	}

}
?>
