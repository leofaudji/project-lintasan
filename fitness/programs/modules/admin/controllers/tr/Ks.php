<?php
class Ks extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("load_m") ;
      $this->load->model("func/toko_m") ;
		$this->bdb 	= $this->load_m ;
	}

   public function index(){
		$this->load->view("tr/ks") ;
	}

   public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $w 	  = array() ;
		$l      = $va['offset'].",".$va['limit'] ;
      $s  	  = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $s 	  = $this->bdb->escape_like_str($s) ;
      if($s !== "") $w[]	= "(nama_brg LIKE '{$s}%' OR nama_brg_tujuan LIKE '%{$s}%')" ;
      $w      = implode(" AND ", $w) ;
		$nrow   = 0 ;
      $dbd    = $this->bdb->select("v_gr_konversi", "*", $w, "", "", "id DESC",$l) ;
      while($r= $this->bdb->getrow($dbd) ){
         $r['recid'] = $r['faktur'] ;
         $vare[]		= $r ;
      }

		if($r   = $this->bdb->getrow($this->bdb->select("v_gr_konversi", "COUNT(id) id", $w))){
			$nrow= $r['id'] ;
		}

      $vare 	= array("total"=>$nrow, "records"=>$vare ) ;
      echo(json_encode($vare)) ;
   }

   private function getkode($l=false){
      $k    = "K" . date("ymd") ;
      return $k . $this->bdb->getincrement($k, $l, 4) ;
   }

   public function init(){
      savesession($this, "ssks_id", "") ;
      savesession($this, "ssks_id_brg", "") ;
      echo('
         bos.ks.obj.find("#faktur").html("'.$this->getkode().'");
      ') ;
   }

   public function saving(){
      $va 	= $this->input->post() ;
      $id   = getsession($this, "ssks_id", "") ;
      $tgl  = date("Y-m-d") ;
      $f    = array("tgl"=>$tgl, "id_brg"=>$va['id_brg'], "id_brg_tujuan"=>$va['id_brg_tujuan'],
                     "qty"=>$va['qty'], "qty_tujuan"=>$va['qty_tujuan'], "harga"=>$va['harga'],
                     "total"=>$va['harga'] * $va['qty'],
							"faktur"=>$this->getkode(true), "keterangan"=>$va['keterangan']) ;
      $this->bdb->insert("brg_konversi", $f) ;
      //upd
      $this->toko_m->updstok_konversi($f) ;

		echo(' bos.ks.settab(0) ;  ') ;
   }

   public function getstok(){
      $va 	= $this->input->post() ;
      $id   = $va['id'] ;
      $tuju = "" ;
      $lv   = true;
      if(!isset($va['tujuan'])){
         savesession($this, "ssks_id_brg", $id) ;
      }else{
         $tuju = $va['tujuan'] ;
         if($id == getsession($this, "ssks_id_brg") && $id !== ""){
            $lv = false ;
         }
      }
      if($lv){
         $v    = $this->toko_m->datastok($id, "stok, hp") ;
         $n    = $v['stok'] ;
			if($n > 0 || $tuju !== ""){
				$sat  = $this->bdb->getval("satuan", "id = " . $this->bdb->escape($id), "v_brg") ;
	         echo('
	            bos.ks.obj.find("#satuan'.$tuju.'").html("'.$sat.'");
	            bos.ks.obj.find("#stok'.$tuju.'").html("'.$n.'");
	         ') ;
	         if($tuju == ""){
	            echo('
	               bos.ks.harga = '.$v['hp'].' ;
	               bos.ks.obj.find("#harga").val("'.$v['hp'].'");
	            ') ;
	         }else{
	            echo(' bos.ks.obj.find("#qty_tujuan").focus() ; ') ;
	         }
			}else{
				echo('
	            alert("Stok Kosong") ;
	            bos.ks.obj.find("#id_brg").sval("") ;
	            bos.ks.obj.find("#id_brg").select2("open") ;
	         ') ;
			}
      }else{
         echo('
            alert("Barang sama") ;
            bos.ks.obj.find("#id_brg_tujuan").sval("") ;
            bos.ks.obj.find("#id_brg_tujuan").select2("open") ;
         ') ;
      }
   }
}
?>
