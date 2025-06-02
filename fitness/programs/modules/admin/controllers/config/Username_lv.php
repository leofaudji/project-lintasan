<?php
	class username_lv extends Bismillah_Controller{
      private $bdb ;
		public function __construct(){
			parent::__construct() ;
         $this->load->model('load_m') ;
         $this->bdb = $this->load_m;
		}

		public function index(){
			$this->load->view("config/username_lv.php") ;
		}

		public function loadgrid(){
			$va	 	= json_decode($this->input->post('request'), true) ;
			$vare 	= array() ;
			$limit	= $va['offset'].",".$va['limit'] ; //limit
			$dbdata = $this->bdb->select("sys_username_level", "code, name", "", "", "", "code DESC", $limit) ;
			while( $dbrow	= $this->bdb->getrow($dbdata) ){
				$vaset 		= $dbrow ;
				$vaset['recid']		= $dbrow['code'] ;

				$vaset['cmdedit'] 	= '<button type="button" onClick="bos.username_lv.cmdedit(\''.$dbrow['code'].'\')"
										class="btn btn-default btn-grid">Koreksi</button>' ;
				$vaset['cmddelete'] = '<button type="button" onClick="bos.username_lv.cmddelete(\''.$dbrow['code'].'\')"
										class="btn btn-danger btn-grid">Hapus</button>' ;
				$vaset['cmdedit']	= html_entity_decode($vaset['cmdedit']) ;
				$vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;

				$vare[]		= $vaset ;
			}

			$vare 	= array("total"=> $this->bdb->rows($dbdata), "records"=>$vare ) ;
			echo(json_encode($vare)) ;
		}

		public function loadmenu(){
			$q 		= $this->input->get('q') ;
			$vare 	= array() ;
			$arrmenu= json_decode(getsession($this, "bmenu", "{}"), true) ;
			$this->loadmenu_data($vare, $q, $arrmenu) ;
			echo json_encode($vare) ;
		}

		public function loadmenu_data(&$vare, $q, $arrmenu){
			foreach ($arrmenu as $key => $value) {
				if($value['loc'] !== ""){
					$lv 	= true;
					if($q) $lv = strpos( strtolower($value['name']), strtolower($q) ) ;
					if($lv){
						$arr 	= json_encode(array("md5"=>$value['md5'], "name"=>$value['name'])) ;
						$vare[]	= array("id"=>$arr, "text"=>$value['name']) ;
					}
				}
				if(isset($value['children'])) $this->loadmenu_data($vare, $q, $value['children']) ;
			}
		}

		public function saving(){
			$va 	= $this->input->post() ;
			$code = $va['code'] ;
         $w    = "code = " . $this->bdb->escape($code) ;
			$data = array("code"=>$code, "name"=>$va['name'], "value"=>$va['value']) ;

			$this->bdb->update("sys_username_level", $data, $w, "code") ;
			echo(' bos.username_lv.init() ; bos.username_lv.settab(0) ;') ;
		}

		public function deleting(){
			$va 	= $this->input->post() ;
         $w    = "code = " . $this->bdb->escape($va['code']) ;
			$this->bdb->delete("sys_username_level", $w) ;
			echo(' bos.username_lv.tabsaction(0) ; ') ;
		}

		public function editing(){
			$va 	= $this->input->post() ;
			$code = $va['code'] ;
         $w    = "code = " . $this->bdb->escape($code) ;
			$valmenu= "" ;
			if($data 	= $this->bdb->getval("*", $w, "sys_username_level")){
				$valmenu = $data['value'] ;
				echo('
					bos.username_lv.obj.find("#code").val("'.$code.'");
		        	bos.username_lv.obj.find("#name").val("'.$data['name'].'");
					bos.username_lv.settab(1) ;
				') ;
			}

			$arrmenu= json_decode(getsession($this, "bmenu", "{}"), true) ;
			$remenu	= array() ;
			$this->get_data_tree($remenu, $arrmenu, $valmenu) ;
			echo('

				bos.username_lv.tree 	= '.json_encode($remenu).' ;
				bos.username_lv.obj.find("#menu").dynatree("getRoot").removeChildren() ;
				bos.username_lv.obj.find("#menu").dynatree("getRoot").addChild(bos.username_lv.tree) ;

				bos.username_lv.tree_cell = bos.username_lv.obj.find("#menu").dynatree("getSelectedNodes") ;
				bos.username_lv.tree_cell = $.map(bos.username_lv.tree_cell,function(node){
					return 	node.data.key ;
				}) ;

		        bos.username_lv.obj.find("#value").val(bos.username_lv.tree_cell.join(", "));
			') ;
		}

		private function get_data_tree(&$re, $arrmenu, $val){
			$r 		= 0 ;
			foreach ($arrmenu as $key => $vav) {
				$title	= $vav['name'] ;
				$re[$r]	= array("title"=>$title,"key"=>$vav['md5']) ;
				if( strpos($val, $vav['md5']) > -1) $re[$r]["select"]	= true ;
				if(isset($vav['children'])){
					$re[$r]["isFolder"]	= true ;
					$re[$r]["expand"]		= true ;
					$re[$r]["children"]	= array() ;
					$this->get_data_tree($re[$r]["children"],$vav['children'],$val) ;
				}
				$r++ ;
			}
		}
	}
?>
