<?php
class Kasir extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("func/toko_m") ;
		$this->load->helper("toko") ;
		$this->bdb 	= $this->toko_m ;
	}

   public function loadgrid(){
		$brg 	= json_decode(getsession($this, "sskasir_barang", "{}"), true) ;
		$re 	= array() ;
		$tot  = array("qty"=>0, "tot"=>0) ;
		foreach ($brg as $key => $r) {
			$r['cmddel'] = html_entity_decode('<button type="button" onClick="bos.kasir.cmddel(\''.$key.'\')"
                        class="btn btn-danger btn-grid"><i class="fa fa-ban"></i></button>') ;
			$r['recid']  = $key ;
			$re[] 		 = $r ;

			$tot['qty'] += $r['qty'] ;
			$tot['tot'] += $r['total'] ;
		}

		$re[] = array("w2ui"=>array("summary"=>true), "total"=>$tot['tot'], "qty"=>$tot['qty']) ;
      $re 	= array("total"=>count($brg), "records"=>$re) ;
      echo(json_encode($re)) ;
   }

	public function index(){
		$data 	= array() ;
		$this->load->view("tr/kasir") ;
	}

	public function init(){
		savesession($this, "sskasir_id", "") ;
		savesession($this, "sskasir_barang", "{}") ;
		//getsaldo kas
		$kas 	= $this->bdb->getkas(date("Y-m-d")) ;
		echo('
			bos.kasir.obj.find("#faktur").html("'.$this->getfaktur(false).'") ;
			bos.kasir.obj.find("#kas").html("Saldo Kas: Rp.'.number_format($kas).'") ;
		') ;
	}

	public function savepel(){
		$va 	= $this->input->post() ;
		savesession($this, "sskasir_id_pel", $va['id']) ;
		echo(' bos.kasir.obj.find("#id_brg").select2("open") ;') ;
	}

	public function addbarang(){
		$va 	= $this->input->post() ;
		$brg 	= json_decode(getsession($this, "sskasir_barang", "{}"), true) ;
		$id 	= $va['id_brg'] ;
		$ibr  = $this->bdb->datastok($id, "sku, nama,harga") ;
		$harga= $ibr['harga'] ;
		$brg[$id] = array("id_brg"=>$id, "nama"=>$ibr['sku']. " - " . $ibr['nama'],"qty"=>$va['qty'],
								"harga"=>$harga, "total"=>$harga*$va['qty']) ;
		savesession($this, "sskasir_barang", json_encode($brg)) ;

		$tot 	= 0 ;
		foreach ($brg as $key => $value) {
			$tot += $value['total'] ;
		}

		echo(' bos.kasir.brgdone() ; bos.kasir.settotal('.$tot.') ; ') ;
	}

	public function cmdel(){
		$va 	= $this->input->post() ;
		$brg 	= json_decode(getsession($this, "sskasir_barang", "{}"), true) ;
		unset($brg[$va['id']]) ;

		savesession($this, "sskasir_barang", json_encode($brg)) ;

		$tot 	= 0 ;
		foreach ($brg as $key => $value) {
			$tot += $value['total'] ;
		}

		echo(' bos.kasir.brgdone() ; bos.kasir.settotal('.$tot.') ; ') ;
	}

	public function setharga(){
		$va 	= $this->input->post() ;
		$id 	= $va['id'] ;
		$brg  = $this->bdb->datastok($id, "stok, harga") ;
		if($brg['stok'] > 0){
			$stok  = $brg['stok'];
			$harga = $brg['harga'];
			echo('
				bos.kasir.brg_stok 	= '.$stok.' ;
				bos.kasir.brg_harga  = '.$harga.' ;
				bos.kasir.obj.find("#brg_harga").html("'.number_format($harga).'") ;
				bos.kasir.obj.find("#brg_total").html("'.number_format($harga).'") ;
				bos.kasir.obj.find("#brg_stok").html("'.number_format($stok).'") ;
				bos.kasir.obj.find("#qty").focus() ;
			') ;
		}else{
			echo('
				alert("Stok Kosong") ;
				bos.kasir.brgdone() ;
			') ;
		}
	}

	public function getfaktur($l=true){
		$k 	  = "J" . date("ymd") ;
		return $k . $this->bdb->getincrement($k, $l, 4) ;
	}

   public function saving(){
		$va 	  = $this->input->post() ;
		$tgl 	  = date("Y-m-d") ;
		$id_pel = getsession($this, "sskasir_id_pel") ;
		$f 	  = $this->getfaktur() ;
		$brg 	  = json_decode(getsession($this, "sskasir_barang", "{}"), true) ;
		$total  = 0 ;
		//brg_jual
		foreach ($brg as $key => $r) {
			$tot 		= $r['harga'] * $r['qty'] ;
			$total  += $tot ;
			$save 	= array("faktur"=>$f, "tgl"=>$tgl, "id_brg"=>$r['id_brg'], "qty"=>$r['qty'],
									"harga"=>$r['harga'], "total_sub"=>$tot, "total"=>$tot) ;
			$this->bdb->insert("brg_jual", $save) ;
		}

		$save 	= array("faktur"=>$f, "tgl"=>$tgl, "id_pelanggan"=>$id_pel, "total_sub"=>$total,
								"total"=>$total, "bayar"=>$va['bayar'], "sisa"=>$va['bayar']-$total,
								"username"=>getsession($this, "username")) ;
		$this->bdb->insert("brg_jual_total", $save) ;
		$this->bdb->updstok_jual($f) ;
		echo('
			alert("Data Penjualan sudah Disimpan") ;
			bos.kasir.init();
		') ;
   }
}
?>
