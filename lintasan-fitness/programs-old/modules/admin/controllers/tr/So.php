<?php
class so extends Bismillah_Controller{
	protected $bdb ;
	private $date ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("tr/so_m") ;
      $this->load->model("func/toko_m") ;
		$this->load->helper("toko") ;
		$this->bdb 	= $this->so_m ;
	}

	public function index(){
		$this->load->view("tr/so") ;

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
      $ss     = json_decode(getsession($this, "ssso_barang", "{}"), true) ;
      foreach ($ss as $key => $v) {
         $set  = $v ;
         $set['recid'] = $key ;
			//delete
			$set['cmdd']  = html_entity_decode('<button type="button" onClick="bos.so.cmdbrg_del(\''.$key.'\')"
                        class="btn btn-danger btn-grid"><i class="fa fa-ban"></i></button>') ;
         $vare[] = $set ;

         //total
         $total += $set['total'] ;
         $qty   += $set['qty'] ;
         $harga += $set['harga'] ;
      }
      $vare[]  = array("w2ui"=>array("summary"=>true), "total"=>$total,
                       "qty"=>$qty, "harga"=>$harga) ;
      $vare 	= array("total"=>count($ss), "records"=>$vare ) ;
      echo(json_encode($vare)) ;
   }

	public function brg_del(){
		$va 	= $this->input->post() ;
		$ss   = json_decode(getsession($this, "ssso_barang", "{}"), TRUE) ;
		unset($ss[$va['id']]) ;
		savesession($this, "ssso_barang", json_encode($ss)) ;
		echo(' bos.so.grbarang_reload() ; ') ;
	}

	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
		$tgl 	  = date("Y-m-d") ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      $total  = 0 ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;
			$vs['tgl']   		= date("d-m-Y", strtotime($vs['tgl'])) ;

         $vare[]		= $vs ;
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "ssso_id", "") ;
		savesession($this, "ssso_faktur", "") ;
      savesession($this, "ssso_barang", "{}") ;
      savesession($this, "ssbrg_jenis", "0") ;
      echo('bos.so.obj.find("#faktur").html("'.$this->bdb->getcode().'"); ') ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$this->save($va) ;
	}

	private function save($va){
		$va['ss'] 	= json_decode(getsession($this, "ssso_barang", "{}"), true) ;
		if(!empty($va['ss'])){
			if( $f 		= $this->bdb->saving($va) ){
				$this->toko_m->updstok_opname($f) ;
				echo('
					bos.so.settab(0) ;
				') ;
			}
		}else{
			echo(' alert("Barang Opname Kosong") ;') ;
		}
	}
}
