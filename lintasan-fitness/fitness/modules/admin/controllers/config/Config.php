<?php
class Config extends Bismillah_Controller{
	private $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model('load_m') ;
		$this->bdb 	= $this->load_m ;
	}

	public function index(){
		$data 		= array("app_title"=> getsession($this, "app_title") , "app_logo"=>"", "app_login_image"=>"",
								 "kota"=>"", "ttd"=>array() ) ;
		$app_logo	= $this->bdb->getconfig("app_logo") ;
		if($app_logo !== ""){
			$data['app_logo']	= '<img src="'.$app_logo.'" class="img-responsive" style="margin: 0 auto; max-height:200px"/>' ;
		}
		$app_login_image= $this->bdb->getconfig("app_login_image") ;
		if($app_login_image !== ""){
			$data['app_login_image']= '<img src="'.$app_login_image.'" class="img-responsive" style="margin: 0 auto; max-height:200px"/>' ;
		}
		$data['kota']= $this->bdb->getconfig("kota") ;
		$data['ttd'] = json_decode($this->bdb->getconfig("ttd"), true) ;

		//remove session
		savesession($this, "ssconfig_app_logo", "" ) ;
		savesession($this, "ssconfig_app_login_image", "" ) ;
		//$this->load->view("config/config", $data) ;
	}

	public function saving_image($cfg){
		savesession($this, "ssconfig_" . $cfg, "") ;

		$fcfg	= array("upload_path"=>"./tmp/", "allowed_types"=>"jpg|jpeg|png", "overwrite"=>true,
						"file_name"=> $cfg ) ;
		$this->load->library('upload', $fcfg) ;

		if ( ! $this->upload->do_upload(0) ){
			echo('
				alert("'. $this->upload->display_errors('','') .'") ;
				bos.config.obj.find("#idl'.$cfg.'").html("") ;
			') ;
		}else{
			$data 	= $this->upload->data() ;
			$fname 	= $cfg . $data['file_ext'] ;
			$tname 	= str_replace($data['file_ext'], "", $data['client_name']) ;
			$vimage	= array( $tname => $data['full_path']) ;
			savesession($this, "ssconfig_" . $cfg, json_encode($vimage) ) ;

			echo('
				bos.config.obj.find("#idl'.$cfg.'").html("") ;
				bos.config.obj.find("#id'.$cfg.'").html("<img src=\"'.base_url("./tmp/" . $fname . "?time=". time()).'\" class=\"img-responsive\" style=\"margin:0 auto;max-height:200px\"/>") ;
			') ;
		}
	}

	public function saving(){
		$va 	= $this->input->post() ;

		//app
		$this->bdb->saveconfig("app_title", $va['app_title']) ;

		//kota
		$this->bdb->saveconfig("kota", $va['kota']) ;

		//ttd
		$vttd 	= array() ;
		$vttd[] 	= array("pos"=>$va['vttd_0_pos'], "nama"=>$va['vttd_0_nama'], "jab"=>$va['vttd_0_jab'],
								"nip"=>$va['vttd_0_nip']) ;
		$vttd[] 	= array("pos"=>$va['vttd_1_pos'], "nama"=>$va['vttd_1_nama'], "jab"=>$va['vttd_1_jab'],
								"nip"=>$va['vttd_1_nip']) ;
		$this->bdb->saveconfig("ttd", json_encode($vttd))  ;

		//save image
		$adir 	= $this->config->item('bcore_uploads') ;
		$upload = array("app_logo"=>getsession($this, "ssconfig_app_logo"),
						"app_login_image"=>getsession($this, "ssconfig_app_login_image")) ;
 		foreach ($upload as $key => $value) {
 			if($value !== ""){
 				$value 	= json_decode($value, true) ;
 				foreach ($value as $tkey => $img) {
 					$vi		= pathinfo($img) ;
 					$dir 	= $adir ;
					$dir   .=  $tkey . "." . $vi['extension'] ;
					if(is_file($dir)) @unlink($dir) ;
					if(@copy($img,$dir)){
						@unlink($img) ;
						@unlink($this->bdb->getconfig($key)) ;
						$this->bdb->saveconfig($key, $dir) ;
					}
 				}
 			}
 		}
		echo('alert("Data Configuration Saved"); ') ;
	}
}
?>
