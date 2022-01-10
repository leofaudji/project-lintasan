<?php
class Frame extends Bismillah_Controller{
	private $bdb ;
	private $vakor 		= array() ;
	private $id_daerah 	= array() ;
	public function __construct(){
		parent::__construct() ;
		$this->load->helper('bmenu') ;
		$this->load->model('frame_m') ;
		$this->bdb = $this->frame_m ;
	}

	public function index(){
		$data 	= array("app_title"	=> getsession($this, "app_title"),
								"fullname"	=> getsession($this, "fullname"),
								"data_var"	=> getsession($this, "data_var"),
								"city"		=> getsession($this, "city")) ;
		$this->load->view("frame", $data) ;
	}

	public function menu_angular(){
		$arrmenu= menu_get($this, APPPATH . "../modules/admin/menu.php", "bmenu", "Administrator") ;
		$vm  	  = array() ;
		$this->menu_generate($vm,$arrmenu) ;
		echo json_encode($vm) ;
	}

	//private function for menu adminlte
	private function menu_generate(&$vm, $arrmenu){
		$level_code 	= getsession($this, "level_code") ;
		$level_value 	= getsession($this, "level_value") ;
		$level_input 	= getsession($this, "level_input") ;

		foreach ($arrmenu as $key => $value) {
			$v 	= true ;
			if($level_code !== "0000"){
				$v 	= false;
				if( strpos($level_value, $value['md5']) > -1){
					$v = true;
					if( strpos($value['name'], ".") > -1 ){
						//simpan ke input
						$li 	= explode(",", $level_input) ;
						$li[] = $value['md5'] ;
						savesession($this, "level_input", implode(",", $li)) ;
					}
				}
			}
			if( strpos($value['obj'], ".") > -1 ) $v = false ;
			if($v){
				$s	 = array("name"=>$value['name'], "icon"=>$value['icon'], "parent"=>"", "o"=>array()) ;
	        	if($value['loc'] !== ""){
            	$s['o']  	= $value ;
            }else{
            	$s['parent']= "parent" ;
            }

	        	$vm[] = $s ;
		    	if(isset($value['children'])){
		    		$this->menu_generate($vm, $value['children']) ;
		    	}
			}
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		echo('window.location.href = "'.base_url().'" ;') ;
	}

	public function ping(){
		$vd 	= date_2b(date("Y-m-d")) ;
		echo(' $("#osx #texttime").html("'.$vd['day']. ", " . $vd['d'] . " " . $vd['m'] . " "  . $vd['y'] .'") ; ') ;
	}

   public function ceknotif(){
		$this->ceknotif_barangmin() ;
		$this->ceknotif_barangkon() ;
   }

	private function ceknotif_barangmin(){
		$w 	= "stok <= min" ;
		$db 	= $this->bdb->select("v_brg", "COUNT(id) id", $w) ;
		if($r = $this->bdb->getrow($db)){
			if($r['id'] > 0)
				setnotif("Barang Stok Kurang", "Terdapat " . $r['id'] . " barang dengan stok kurang, Mohon diperiksa!", "ion-cube") ;
		}
	}

	private function ceknotif_barangkon(){
		$w 	= "retur_faktur = ''" ;
		$db 	= $this->bdb->select("v_rpt_konsiyasi", "COUNT(id) id", $w) ;
		if($r = $this->bdb->getrow($db)){
			if($r['id'] > 0)
				setnotif("Barang Konsiyasi", "Terdapat " . $r['id'] . " barang konsiyasi yang belum dibayar", "ion-cube") ;
		}
	}
}
?>
