<?php
class D extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
      $this->load->helper("toko") ;
      $this->load->model("load_m") ;
		$this->bdb 	= $this->load_m ;
	}

	public function index(){
		$this->load->view("dash/d") ;
	}

	public function loadd(){
		$va 	= $this->input->post() ;
		//load penjualan
		$tglaw= date_2s($va['tgl_awal']) ;
		$tglak= date_2s($va['tgl_akhir']) ;
		$w 	= "tgl >= " . $this->bdb->escape($tglaw) . " AND tgl <= " . $this->bdb->escape($tglak) . " AND retur_faktur = ''";
		$f 	= "SUM(total_sub) pend, COUNT(id) pend_jml, SUM(hp) hp ,SUM(total_sub - hp) lk" ;
		$db 	= $this->bdb->select("v_rpt_laba_kotor", $f, $w) ;
		if($r = $this->bdb->getrow($db)){
			$lkm = $r['lk'] / $r['pend'] * 100 ;
			echo('
				bos.d.obj.find("#text_jual").html("'.number_format($r['pend']).'") ;
				bos.d.obj.find("#text_jualn").html("'.number_format($r['pend_jml']).'") ;
				bos.d.obj.find("#text_lk").html("'.number_format($r['lk']).'") ;
				bos.d.obj.find("#text_lk_margin").html("'.number_format($lkm,2).'%") ;
			') ;
		}

		$w 	= "tgl_aktif >= " . $this->bdb->escape($tglaw) . " AND tgl_aktif <= " . $this->bdb->escape($tglak) .
					" AND retur_faktur = ''";
		$f 	= "SUM(total) beli, COUNT(id) beli_jml" ;
		$db 	= $this->bdb->select("v_rpt_beli", $f, $w) ;
		if($r = $this->bdb->getrow($db)){
			echo('
				bos.d.obj.find("#text_beli").html("'.number_format($r['beli']).'") ;
				bos.d.obj.find("#text_belin").html("'.number_format($r['beli_jml']).'");
				bos.d.loadc() ;
			') ;
		}
	}

	public function loadc(){
		$va 	= $this->input->post() ;
		//load penjualan
		$d  	= array("labels"=>array(),
							"datasets"=>array(
								array("label"=>"Penjualan", "data"=>array(), "fill"=>"start",
										"backgroundColor"=>"rgba(69, 198, 255, .4)", "borderColor"=>"#45C6FF"))
							) ;
		$tglaw= date_2s($va['tgl_awal']) ;
		$tglaw= date("Y-m-01", strtotime($tglaw)) ;
		$tglak= date("Y-m-t", strtotime($tglaw)) ;
		$w 	= "tgl >= " . $this->bdb->escape($tglaw) . " AND tgl <= " . $this->bdb->escape($tglak) . " AND retur_faktur = ''";
		$f 	= "SUM(total_sub) pend, tgl" ;
		$db 	= $this->bdb->select("v_rpt_laba_kotor", $f, $w, "", "tgl", "tgl ASC") ;
		while($r = $this->bdb->getrow($db)){
			$d["labels"][] = date("d-m-Y", strtotime($r['tgl'])) ;
			$d["datasets"][0]["data"][] = intval($r['pend']) ;
		}

		echo(' bos.d.setc('.json_encode($d).') ; ') ;
	}

	public function loadt(){
		$va 	= $this->input->post() ;
		$tglaw= date_2s($va['tgl_awal']) ;
		$tglaw= date("Y-m-01", strtotime($tglaw)) ;
		$tglak= date("Y-m-t", strtotime($tglaw)) ;
		$w 	= "tgl >= " . $this->bdb->escape($tglaw) . " AND tgl <= " . $this->bdb->escape($tglak) . " AND retur_faktur = ''";
		$f 	= "SUM(qty) jml, brg_nama" ;
		$db 	= $this->bdb->select("v_rpt_laba_kotor", $f, $w, "", "id_brg", "SUM(id) DESC", "0,10") ;
		while($r = $this->bdb->getrow($db)){
			$html = '<div class=\"col-sm-2\"><div class=\"countbox black\"><h6 class=\"fw-300\">'.
						$r['brg_nama'].'</h6><h5 id=\"text_jual\">'.number_format($r['jml']).'</h5></div></div>' ;
			echo(' bos.d.obj.find("#text_bt").append("'.bostext($html).'") ; ') ;
		}
	}

}
?>
