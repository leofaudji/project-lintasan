<?php
class Username extends Bismillah_Controller{
   private $bdb;
	public function __construct(){
		parent::__construct() ;
      $this->load->model("config/username_m") ;
      $this->bdb = $this->username_m;
	} 

	public function index(){
		$this->load->view("config/username") ;
	}

	public function loadgrid(){
		$va	 	= json_decode($this->input->post('request'), true) ;
		$db      = $this->bdb->loadgrid($va) ;
		while( $dbrow	= $this->bdb->getrow($db['db']) ){
			$vaset 		= $dbrow ;
			$vaset['recid']		= $dbrow['username'] ;

			$vaset['cmdedit'] 	= '<button type="button" onClick="bos.username.cmdedit(\''.$dbrow['username'].'\')"
									class="btn btn-default btn-grid">Koreksi</button>' ;
			$vaset['cmddelete'] = '<button type="button" onClick="bos.username.cmddelete(\''.$dbrow['username'].'\')"
									class="btn btn-danger btn-grid">Hapus</button>' ;
			$vaset['cmdedit']	= html_entity_decode($vaset['cmdedit']) ;
			$vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;

			$vare[]		= $vaset ;
		}

		$vare 	= array("total"=> $db['rows'], "records"=>$vare ) ;
		echo(json_encode($vare)) ;
	}

	public function init(){
      savesession($this, "ssusername_image", "") ;
	}

	public function seekusername(){
		$va 	= $this->input->post() ;
      $w    = "username = ".$this->bdb->escape($va['username']) ;
      if(getsession($this, "ssusername_username") == ""){
         if($data= $this->bdb->getval("username",$w , "sys_username")){
   			echo(' bos.username.obj.find("#username").val("").focus() ;  ') ;
   		}
      }
	}

	public function saving(){
		$va 		= $this->input->post() ;
		$username 	= $va['username'] ;
      $w    = "username = ".$this->bdb->escape($va['username']) ;
		if( $dblast = $this->bdb->getval("*", $w, "sys_username") ){
			$dblast['data_var']	= ($dblast['data_var'] !== "") ? json_decode($dblast['data_var'], true) : array() ;
		}
		if(empty($dblast)){
			$dblast = array("password"=>"", "data_var"=>array('ava'=>"")) ;
		}

		$data 		= array("username"=>$va['username'], "fullname"=>$va['fullname']) ;
		$data['data_var']	= array("ava"=>$dblast['data_var']['ava']) ;

		if($va['password'] !== ""){
			$data['password']	= pass_crypt($va['password']) . $va['level'] ;
		}else{
			$data['password']	= substr($dblast['password'], 0, strlen($dblast['password'])-4) . $va['level'];
		}

		$vimage 		= json_decode(getsession($this, "ssusername_image", "{}"), true) ;
		if(!empty($vimage)){
			$adir 	= $this->config->item('bcore_uploads') . "users/";
         @mkdir($adir, 0777, true) ;
			foreach ($vimage as $key => $img) {
				$vi	= pathinfo($img) ;
				$dir 	= $adir ;
				$dir .= $va['username'] . "." . $vi['extension'] ;
				if(is_file($dir)) @unlink($dir) ;
				if(@copy($img,$dir)){
					@unlink($img) ;
					@unlink($dblast['data_var']['ava']) ;
					$data['data_var']['ava']	= $dir;
				}
			}
		}
		$data['data_var']	= json_encode($data['data_var']) ;

		$this->bdb->update("sys_username", $data, $w, "username") ;
		echo(' bos.username.init() ; bos.username.settab(0) ; ') ;
	}

	public function saving_image(){
		$fcfg	= array("upload_path"=>"./tmp/", "allowed_types"=>"jpg|jpeg|png", "overwrite"=>true) ;

		savesession($this, "ssusername_image", "") ;
		$this->load->library('upload', $fcfg) ;
		if ( ! $this->upload->do_upload(0) ){
			echo('
				alert("'. $this->upload->display_errors('','') .'") ;
				bos.username.obj.find("#idlimage").html("") ;
			') ;
		}else{
			$data 	= $this->upload->data() ;
			$tname 	= str_replace($data['file_ext'], "", $data['client_name']) ;
			$vimage	= array( $tname => $data['full_path']) ;
			savesession($this, "ssusername_image", json_encode($vimage) ) ;

			echo('
				bos.username.obj.find("#idlimage").html("") ;
				bos.username.obj.find("#idimage").html("<img src=\"'.base_url("./tmp/" . $data['client_name'] . "?time=". time()).'\" class=\"img-responsive\" />") ;
			') ;
		}
	}

	public function editing(){
		$va 	= $this->input->post() ;
      $w    = "username = ".$this->bdb->escape($va['username']) ;
		$data = $this->bdb->getval("*", $w, "sys_username") ;
		if(!empty($data)){
         savesession($this, "ssusername_username", $va['username']) ;
			$image 		= "" ;
			$slevel 	= array() ;
			$data_var	= ($data['data_var'] !== "") ? json_decode($data['data_var'], true) : array() ;
			if(isset($data_var['ava'])){
				$image 	= '<img src=\"'.base_url($data_var['ava']).'\" class=\"img-responsive\"/>' ;
			}
			$level 		= substr($data['password'], -4) ;
			$slevel[] 	= array("id"=>$level, "text"=> $level . " - " . $this->bdb->getval("name", "code = '{$level}'", "sys_username_level")) ;

				echo('
				with(bos.username.obj){
					find("#username").val("'.$data['username'].'").attr("readonly", true) ;
					find("#fullname").val("'.$data['fullname'].'").focus() ;
					find("#level").sval('.json_encode($slevel).') ;
					find("#idimage").html("'.$image.'")
				}
            bos.username.settab(1) ;
			') ;
		}
	}

	public function deleting(){
		$va 	= $this->input->post() ;
      $w    = "username = ".$this->bdb->escape($va['username']) ;
		$this->bdb->delete("sys_username", $w ) ;
		echo(' bos.username.tabsaction(0) ; ') ;
	}
}
?>
