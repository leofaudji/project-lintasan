<?php
class dafk_retur extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("func/toko_m") ;
		$this->load->helper("toko") ;
		$this->bdb 	= $this->toko_m ;
	}

	public function loadgrid(){
		$vare   = array() ;
      $total  = 0 ;
      $qty    = 0 ;
      $harga  = 0 ;
      $ss     = json_decode(getsession($this, "ssdafk_retur_barang", "{}"), true) ;
      foreach ($ss as $key => $v) {
         $set  = $v ;
         $set["total"] = $set['retur_bayar'] ;
         $set['barang']= $this->bdb->getval("nama", "id = ".$v['id_brg'], "mst_brg") ;
         $set['recid'] = $key ;
         $vare[] = $set ;

         //total
         $total += $set['total'] ;
         $qty   += $v['qty_sisa'] ;
         $harga += $v['harga'] ;
      }
      $vare[]  = array("w2ui"=>array("summary"=>true), "retur_bayar"=>$total,
                       "qty_sisa"=>$qty, "harga"=>$harga) ;
      $vare 	= array("total"=>count($ss), "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function index(){
		$data = array() ;
		$id 	= getsession($this, "ssdafk_id_retur") ;
		if($r = $this->bdb->getval("faktur, tgl, id_supplier, jenis, keterangan", "id = '".$id."'", "brg_beli_total")){
			savesession($this, "ssdafk_retur_id", $id) ;
			savesession($this, "ssdafk_retur_faktur", $r['faktur']) ;
			$sup 	= $this->bdb->getval("kode, nama", "id = '".$r['id_supplier']."'", "mst_supplier") ;
			$data['faktur'] = $r['faktur'] ;
			$data['sup'] 	 = $sup ;
			$data['keterangan'] = $r['keterangan'] ;

			$item = array() ;
			$db 	= $this->bdb->select("brg_beli", "*", "faktur = " . $this->bdb->escape($r['faktur'])) ;
         while($dbr = $this->bdb->getrow($db)){
				//get stok
				$stok   = $this->toko_m->getstok($dbr['id_brg']) ;
				$dbr['qty_sisa'] 		= $stok ;
				$dbr['retur_bayar'] 	= ($dbr['qty'] - $stok) * $dbr['harga'] ;
            $item[] = $dbr ;
         }
			savesession($this, "ssdafk_retur_barang", json_encode($item)) ;
		}
		savesession($this, "ssdafk_id_retur", "") ;
		$this->load->view("tr/dafk_retur", $data) ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "ssdafk_retur_id") ;
		$f 	= getsession($this, "ssdafk_retur_faktur") ;
		$ss   = json_decode(getsession($this, "ssdafk_retur_barang", "{}"), true) ;
		$qty 	= 0 ;
		$bayar= 0 ;
		foreach ($ss as $key => $value) {
			$qty 	 += $value['qty_sisa'] ;
			$bayar += $value['retur_bayar'] ;

			//update juga kang
			$vae 	  = array("qty_sisa"=>$qty, "retur_bayar"=>$value['retur_bayar']) ;
			$this->bdb->edit("brg_beli", $vae, "id = " . $this->bdb->escape($value['id'])) ;
		}

		$k    = "BK" . date("ymd") ;
		$fr 	= $k . $this->bdb->getincrement($k, true, 3) ;
		$fs 	= array("retur_username"=>getsession($this, "username"), "retur_faktur"=>$fr,
							"retur_tgl"=>date("Y-m-d"), "retur_keterangan"=>$va['retur_keterangan'],
							"qty_sisa"=>$qty, "retur_bayar"=>$bayar) ;
		$this->bdb->edit("brg_beli_total", $fs, "id = " . $this->bdb->escape($id)) ;
		$this->toko_m->updstok_retur_beli_kon($f, $fr) ;
		echo(' bos.dafk_retur.close() ; ') ;
	}
}
?>
