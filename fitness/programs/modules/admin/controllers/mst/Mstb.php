<?php
class Mstb extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("mst/mstb_m") ;
		$this->load->helper("toko") ;
		$this->bdb 	= $this->mstb_m ;
	}

	public function index(){
		$this->load->view("mst/mstb") ;

	}

	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;
			$vs['jenis'] 		= getbrg_jenis($vs['jenis']) ;
			$vs['kategori']   = $this->bdb->getval("kategori", "id = '".$vs['id_kat']."'", "mst_brg_kat") ;
         $vs['cmdedit']    = '<button type="button" onClick="bos.mstb.cmdedit(\''.$dbr['id'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
         $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

         $vare[]		= $vs ;
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "ssmstb_id", "") ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "ssmstb_id") ;

		$this->bdb->saving($va, $id) ;
		echo('
			bos.mstb.grid1_reload() ;
			bos.mstb.init() ;
		') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "ssmstb_id", $d['id']) ;
			$id_kat 	= $this->bdb->getval("kategori", "id = '".$d['id_kat']."'", "mst_brg_kat") ;
			$id_kat  = array(array("id"=>$d['id_kat'], "text"=>$id_kat)) ;

			$satuan 	= array(array("id"=>$d['satuan'], "text"=>$d['satuan'])) ;
			echo('
				bos.mstb.obj.find("#sku").val("'.$d['sku'].'") ;
				bos.mstb.obj.find("#nama").val("'.$d['nama'].'") ;
				bos.mstb.obj.find("#min").val("'.$d['min'].'") ;
				bos.mstb.obj.find("#harga").val("'.$d['harga'].'") ;
				bjs.setopt(bos.mstb.obj, "jenis", "'.$d['jenis'].'") ;
				bos.mstb.obj.find("#id_kat").sval('.json_encode($id_kat).') ;
				bos.mstb.obj.find("#satuan").sval('.json_encode($satuan).') ;
			') ;
		}
	}

	public function looksku(){
		$va 	= $this->input->post() ;
		$sku 	= $va['sku'] ;
		if(getsession($this, "ssmstb_id") == ""){
			$id= $this->bdb->getval("id", "sku = '".$sku."'", "mst_brg") ;
			if($id !== ""){
				echo('
					alert("SKU Sudah digunakan") ;
					bos.mstb.obj.find("#sku").val("").focus() ;
				') ;
			}
		}
	}

}
?>
