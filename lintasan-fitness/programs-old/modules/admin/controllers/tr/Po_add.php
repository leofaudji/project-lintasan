<?php
class Po_add extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("tr/po_m") ;
      $this->load->model("func/toko_m") ;
		$this->load->helper("toko") ;
		$this->bdb 	= $this->po_m ;
	}

	public function index(){
		$this->load->view("tr/po_add") ;

	}

   public function getstok(){
      $va 	= $this->input->post() ;
      $stok = $this->toko_m->getstok($va['id']) ;
      echo('
         bos.po_add.obj.find("#text_stok").html("'.number_format($stok).'") ;
         bos.po_add.obj.find("#qty").focus() ;
      ') ;
   }

   public function tambah(){
      $va 	= $this->input->post() ;
      $ss   = getsession($this, "sspo_barang", "{}") ;
      $ss   = json_decode($ss, true) ;
		$lv 	= true ;
		foreach ($ss as $key => $value) {
			if($value['id_brg'] == $va['id_brg']) $lv = false ;
		}
		if($lv){
			$va['id'] = "0" ;
	      $ss[] = $va ;
	      savesession($this, "sspo_barang", json_encode($ss)) ;
	      echo('
	         bos.po_add.close() ;
	      ') ;
		}else{
			echo(' alert("Barang telah dibeli") ; bos.po_add.obj.find("#id_brg").select2("open") ; ') ;
		}
   }
}
?>
