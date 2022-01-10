<?php
class So_add extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("tr/so_m") ;
      $this->load->model("func/toko_m") ;
		$this->load->helper("toko") ;
		$this->bdb 	= $this->so_m ;
	}

	public function index(){
		$this->load->view("tr/so_add") ;

	}

   public function getstok(){
      $va 	= $this->input->post() ;
      $stok = $this->toko_m->getstok($va['id']) ;
      echo('
         bos.so_add.obj.find("#text_stok").html("'.number_format($stok).'") ;
         bos.so_add.obj.find("#stok_ac").focus() ;
      ') ;
   }

   public function opname(){
      $va 	= $this->input->post() ;
      $ss   = getsession($this, "ssso_barang", "{}") ;
      $ss   = json_decode($ss, true) ;
		$lv 	= true ;
		foreach ($ss as $key => $value) {
			if($value['id_brg'] == $va['id_brg']) $lv = false ;
		}
		if($lv){
			$va['id'] = "0" ;

			$dbrg 		 = $this->toko_m->datastok($va['id_brg'], "nama, sku, stok, hp") ; ;
			$va['qty']   = $va['stok_ac'] - $dbrg['stok'];
         $va['barang']= $dbrg['sku'] . " - " . $dbrg['nama'] ;
         $va['stok']  = $dbrg['stok'] ;
			$va['harga'] = $dbrg['hp'] ;
			$va['total'] = $dbrg['hp'] * $va['qty'] ;

	      $ss[] = $va ;
	      savesession($this, "ssso_barang", json_encode($ss)) ;
	      echo('
	         bos.so_add.close() ;
	      ') ;
		}else{
			echo(' alert("Barang telah diopname") ; bos.so_add.obj.find("#id_brg").select2("open") ; ') ;
		}
   }
}
?>
