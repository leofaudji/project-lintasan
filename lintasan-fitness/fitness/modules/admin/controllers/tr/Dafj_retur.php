<?php
class Dafj_retur extends Bismillah_Controller{
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
      $ss     = json_decode(getsession($this, "ssdafj_retur_barang", "{}"), true) ;
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
		$id 	= getsession($this, "ssdafj_id_retur") ;
		if($r = $this->bdb->getval("*", "id = '".$id."'", "brg_jual_total")){
			savesession($this, "ssdafj_retur_id", $id) ;
			savesession($this, "ssdafj_retur_faktur", $r['faktur']) ;
			$pel 	= $this->bdb->getval("kode, nama", "id = '".$r['id_pelanggan']."'", "mst_pelanggan") ;
			$data['faktur'] = $r['faktur'] ;
			$data['pel'] 	 = $pel ;
			$data['total']  = $r['total'] ;
			$data['qty']    = 0 ;

			$lvalid 	= true ;
			//item
			$item = array() ;
			$db 	= $this->bdb->select("brg_jual", "*", "faktur = " . $this->bdb->escape($r['faktur'])) ;
         while($dbr = $this->bdb->getrow($db)){
				$data['qty'] += $dbr['qty'] ;
            $item[] = $dbr ;
         }
			savesession($this, "ssdafj_retur_barang", json_encode($item)) ;
		}
		savesession($this, "sspo_id_retur", "") ;
		$this->load->view("tr/dafj_retur", $data) ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "ssdafj_retur_id") ;
		$f 	= getsession($this, "ssdafj_retur_faktur") ;
		$k    = "JR" . date("ymd") ;
		$fr 	= $k . $this->bdb->getincrement($k, true, 3) ;
		$fs 	= array("retur_username"=>getsession($this, "username"), "retur_faktur"=>$fr,
							"retur_tgl"=>date("Y-m-d"), "retur_keterangan"=>$va['retur_keterangan']) ;
		$this->bdb->edit("brg_jual_total", $fs, "id = " . $this->bdb->escape($id)) ;
		$this->toko_m->updstok_retur_jual($f, $fr) ;
		echo(' bos.dafj_retur.close() ; ') ;
	}
}
?>
