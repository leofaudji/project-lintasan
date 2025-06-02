<?php
class Po extends Bismillah_Controller{
	protected $bdb ;
	private $date ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("tr/po_m") ;
      $this->load->model("func/toko_m") ;
		$this->load->helper("toko") ;
		$this->bdb 	= $this->po_m ;
	}

	public function index(){
		$this->load->view("tr/po") ;

	}

   public function setjenis(){
      $va 	= $this->input->post() ;
      savesession($this, "ssbrg_jenis", $va['jenis']) ;
   }

   public function loadgrid_barang($value=''){
      $va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $total  = 0 ;
      $qty    = 0 ;
      $harga  = 0 ;
      $ss     = json_decode(getsession($this, "sspo_barang", "{}"), true) ;
      foreach ($ss as $key => $v) {
         $set  = $v ;
         $set["total"] = $v['qty'] * $v['harga'] ;
         $set['barang']= $this->bdb->getval("nama", "id = ".$v['id_brg'], "mst_brg") ;
         $set['stok']  = $this->toko_m->getstok($v['id_brg']) ;
         $set['recid'] = $key ;
			//delete
			$set['cmdd']  = html_entity_decode('<button type="button" onClick="bos.po.cmdbrg_del(\''.$key.'\')"
                        class="btn btn-danger btn-grid"><i class="fa fa-ban"></i></button>') ;
         $vare[] = $set ;

         //total
         $total += $set['total'] ;
         $qty   += $v['qty'] ;
         $harga += $v['harga'] ;
      }
      $vare[]  = array("w2ui"=>array("summary"=>true), "total"=>$total,
                       "qty"=>$qty, "harga"=>$harga) ;
      $vare 	= array("total"=>count($ss), "records"=>$vare ) ;
      echo(json_encode($vare)) ;
   }

	public function brg_del(){
		$va 	= $this->input->post() ;
		$ss   = json_decode(getsession($this, "sspo_barang", "{}"), TRUE) ;
		unset($ss[$va['id']]) ;
		savesession($this, "sspo_barang", json_encode($ss)) ;
		echo(' bos.po.grbarang_reload() ; ') ;
	}

	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
		$tgl 	  = date("Y-m-d") ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      $total  = 0 ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $total  += $dbr['total'] ;
         $vs = $dbr;
			$vs['tgl']   		= date("d-m-Y", strtotime($vs['tgl'])) ;
			$vs['tgl_aktif']  = date("d-m-Y", strtotime($vs['tgl_aktif'])) ;
         $vs['id_supplier']= $this->bdb->getval("nama", "id = '".$vs['id_supplier']."'", "mst_supplier") ;
			$vs['jenis'] 		= getbrg_jenis($vs['jenis']) ;

			//edit hanya boleh sebelum ada tgl_aktif
			if($dbr['tgl_aktif'] == '0000-00-00'){
				$vs['cmdedit']    = '<button type="button" onClick="bos.po.cmdedit(\''.$dbr['recid'].'\')"
	                           class="btn btn-default btn-grid">Koreksi</button>' ;
	         $vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;
			}

         //delete harus opname kas
         if($dbr['tgl_aktif'] !== '0000-00-00' && $dbr['retur_faktur'] == "" && $dbr['tgl_aktif'] == $tgl){
            $vs['cmdretur']    = '<button type="button" onClick="bos.po.cmdretur(\''.$dbr['recid'].'\')"
                                 class="btn btn-danger btn-grid">Retur</button>' ;
            $vs['cmdretur']	 = html_entity_decode($vs['cmdretur']) ;
         }else if($dbr['retur_faktur'] !== ""){
				$vs['cmdretur']    = $dbr['retur_faktur'] ;
			}

         $vare[]		= $vs ;
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "sspo_id", "") ;
		savesession($this, "sspo_faktur", "") ;
      savesession($this, "sspo_barang", "{}") ;
      savesession($this, "ssbrg_jenis", "0") ;
      echo('bos.po.obj.find("#faktur").html("'.$this->bdb->getcode().'"); ') ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$this->save($va) ;
	}

	private function save($va){
		$fill = isset($va['fill']) ? TRUE : FALSE;
		$id 	= getsession($this, "sspo_id") ;
		$f 	= getsession($this, "sspo_faktur") ;
		$va['ss'] 	= json_decode(getsession($this, "sspo_barang", "{}"), true) ;
		if(!empty($va['ss'])){
			if( $f 		= $this->bdb->saving($va, $id, $f, $fill) ){
				if($fill){ //upd
					$this->toko_m->updstok_beli($f) ;
				}
				echo('
					bos.po.settab(0) ;
				') ;
			}
		}else{
			echo(' alert("Barang Pembelian Kosong") ;') ;
		}
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "sspo_id", $va['id']) ;
			savesession($this, "sspo_faktur", $d['faktur']) ;
			$ids 	= $this->bdb->getval("kode, nama", "id = '".$d['id_supplier']."'", "mst_supplier") ;
			$ids 	= array(array("id"=>$d['id_supplier'], "text"=>$ids['kode'] . " - " . $ids['nama'])) ;
			savesession($this, "sspo_barang", json_encode($d['item'])) ;
			echo('
				bos.po.obj.find("#faktur").html("'.$d['faktur'].'") ;
				bos.po.obj.find("#id_supplier").sval('.json_encode($ids).') ;
				bos.po.obj.find("#keterangan").val("'.$d['keterangan'].'") ;
				bjs.setopt(bos.po.obj, "jenis", "'.$d['jenis'].'") ;
				bos.po.settab(1) ;
			') ;
		}
	}

	public function retur(){
		$va 	= $this->input->post() ;
		savesession($this, "sspo_id_retur", $va['id']) ;
		echo(' bos.po.openretur() ; ') ;
	}

}
