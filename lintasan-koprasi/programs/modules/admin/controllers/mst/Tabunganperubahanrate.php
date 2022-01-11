<?php
class Tabunganperubahanrate extends Bismillah_Controller{
	protected $bdb ;  
	public function __construct(){
		parent::__construct() ;
		$this->load->helper("bdate") ;
		$this->load->helper("toko") ; 
		$this->load->model("mst/tabunganperubahanrate_m") ;
		$this->bdb 	= $this->tabunganperubahanrate_m ;
	} 

	public function index(){
		$this->load->view("mst/tabunganperubahanrate") ;

	}   
 
	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->bdb->getrow($dbd) ){
				 $vs = $dbr;   
				 $vs['tgl'] = date_2d($vs['tgl']) ;  
				 $vs['sukubunga'] .= " %" ;
         $vs['cmdedit']    = '<button type="button" onClick="bos.tabunganperubahanrate.cmdedit(\''.$dbr['id'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
         $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

		 $vs['cmddelete']  = '<button type="button" onClick="bos.tabunganperubahanrate.cmddelete(\''.$dbr['id'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
         $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

         $vare[]		= $vs ; 
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}
 
	public function init(){
		savesession($this, "sstabunganperubahanrate_id", "") ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "sstabunganperubahanrate_id") ; 

		$this->bdb->saving($va, $id) ;
		echo(' bos.tabunganperubahanrate.settab(0) ;  ') ;
	}

	public function deleting(){
		$va 	= $this->input->post() ; 
		$id 	= $va['id'] ;
		$this->bdb->delete("tabungan_rate", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.tabunganperubahanrate.grid1_reload() ; ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "sstabunganperubahanrate_id", $d['id']) ;  
			$golongan_tabungan[]   = array("id"=>$d['golongan_tabungan'],"text"=>$d['golongan_tabungan']);
			echo('  
				bos.tabunganperubahanrate.obj.find("#tgl").val("'.date_2s($d['tgl']).'") ;         
				bos.tabunganperubahanrate.obj.find("#golongan_tabungan").sval('.json_encode($golongan_tabungan).') ;		 
				bos.tabunganperubahanrate.obj.find("#keterangan").val("'.$d['keterangan'].'") ; 
				bos.tabunganperubahanrate.obj.find("#sukubunga").val('.$d['sukubunga'].') ;		 
				bos.tabunganperubahanrate.settab(1) ;  
			') ;
		}
	}

}
?>
