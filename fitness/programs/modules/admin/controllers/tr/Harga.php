<?php
class Harga extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("tr/harga_m") ;
		$this->load->model("func/toko_m") ;
		$this->load->helper("toko") ;
		$this->bdb 	= $this->harga_m ;
	}

   public function loadgrid(){
      $va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      $total  = 0 ;
      while($r= $this->bdb->getrow($dbd) ){
         $r['recid'] = $r['id'] ;
         $r['jenis'] = getbrg_jenis($r['jenis']) ;
			if($r['tgl_ex'] == "0000-00-00"){
				$r['tgl_ex'] = date("d-m-Y") ;
			} else{
				$r['tgl_ex'] = date("m/d/Y", strtotime($r['tgl_ex'])) ;
			}
         $vare[]		= $r ;
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
   }

	public function index(){
		$this->load->view("tr/harga") ;

	}

   public function saving(){
      $va 		  = $this->input->post() ;
		$va['qty'] = $this->toko_m->getstok($va['id']) ;
		$n 	= $va['n'] ;
		if($va['col'] == 6){
			$vd= explode("/", $va['n']) ;
			$va['n'] = $vd[2] . "-" . $vd[0] . "-" . $vd[1] ;
			$n = date("m/d/Y", strtotime($va['n'])) ;
		}
		$this->bdb->saving($va) ;
		echo(' bos.harga.grid1_frow('.$va['id'].', '.$va['col'].', "'.$n.'") ') ;
   }
}
?>
