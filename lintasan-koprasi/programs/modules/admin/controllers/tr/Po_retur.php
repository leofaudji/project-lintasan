<?php
class Po_retur extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("tr/po_m") ;
		$this->load->model("func/toko_m") ;
		$this->load->helper("toko") ;
		$this->bdb 	= $this->po_m ;
	}

	public function loadgrid(){
		$vare   = array() ;
      $total  = 0 ;
      $qty    = 0 ;
      $harga  = 0 ;
      $ss     = json_decode(getsession($this, "sspo_retur_barang", "{}"), true) ;
      foreach ($ss as $key => $v) {
         $set  = $v ;
         $set["total"] = $v['qty'] * $v['harga'] ;
         $set['barang']= $this->bdb->getval("nama", "id = ".$v['id_brg'], "mst_brg") ;
         $set['recid'] = $key ;
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

	public function index(){
		$data = array() ;
		$id 	= getsession($this, "sspo_id_retur") ;
		if($r = $this->bdb->getval("faktur, tgl, id_supplier, jenis, keterangan", "id = '".$id."'", "brg_beli_total")){
			savesession($this, "sspo_retur_id", $id) ;
			savesession($this, "sspo_retur_faktur", $r['faktur']) ;
			$sup 	= $this->bdb->getval("kode, nama", "id = '".$r['id_supplier']."'", "mst_supplier") ;
			$data['faktur'] = $r['faktur'] ;
			$data['sup'] 	 = $sup ;
			$data['jenis']  = getbrg_jenis($r['jenis']) ;
			$data['keterangan'] = $r['keterangan'] ;

			$lvalid 	= true ;
			//item
			$item = array() ;
			$db 	= $this->bdb->select("brg_beli", "*", "faktur = " . $this->bdb->escape($r['faktur'])) ;
         while($dbr = $this->bdb->getrow($db)){
				//get stok
				$stok   = $this->toko_m->getstok($dbr['id_brg']) ;
				if($stok < $dbr['qty']) $lvalid = false ;
            $item[] = $dbr ;
         }
			savesession($this, "sspo_retur_barang", json_encode($item)) ;
		}
		savesession($this, "sspo_id_retur", "") ;
		$data['lvalid'] = $lvalid ;
		$this->load->view("tr/po_retur", $data) ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "sspo_retur_id") ;
		$f 	= getsession($this, "sspo_retur_faktur") ;
		$k    = "BR" . date("ymd") ;
		$fr 	= $k . $this->bdb->getincrement($k, true, 3) ;
		$fs 	= array("retur_username"=>getsession($this, "username"), "retur_faktur"=>$fr,
							"retur_tgl"=>date("Y-m-d"), "retur_keterangan"=>$va['retur_keterangan']) ;
		$this->bdb->edit("brg_beli_total", $fs, "id = " . $this->bdb->escape($id)) ;
		$this->toko_m->updstok_retur_beli($f, $fr) ;
		echo(' bos.po_retur.close() ; ') ;
	}
}
?>
