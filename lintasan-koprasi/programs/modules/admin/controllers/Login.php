<?php
class Login extends CI_Controller{
	public function __construct(){  
		parent::__construct() ;
		$this->load->model('loginm') ; 
		$this->load->helper("bhttp") ;
	}

	public function index(){
		$data 	= array('app_title'=> $this->loginm->getconfig('app_title'),
						'app_logo'=>base_url($this->loginm->getconfig('app_logo')),
						'app_login_image'=>base_url($this->loginm->getconfig('app_login_image')) ) ;
		$this->load->view("login", $data) ;
	}

	public function checklogin(){
		$data = array(
			"token" => '12345',
			"data" => array("username"=>"iniad","password"=>"bismillah"),
			"log"=>  array("log"=>"faudji"));  
	
	  //$data = "hehe" ;
		$api = api_login($data) ;         
		echo(' console.log("'. $api.'") ; ') ; 

		$va	= $this->input->post() ;
		$data = $this->loginm->getdata_login($va['cusername'], $va['cpassword']) ;
		if(!empty($data)){
			//saving data username
			$data['app_title']	= $this->loginm->getconfig('app_title') ;
			$data['app_logo']		= $this->loginm->getconfig('app_logo') ;
			$data['city']			= $this->loginm->getconfig('city') ;
 			//get photo
			$data['data_var']		= $data['data_var'] !== "" ? json_decode($data['data_var'], true) : array("ava"=>"") ;
			if($data['data_var']['ava'] == "")
				$data['data_var']['ava'] = "./uploads/ava.jpg" ;
			//get level menu
			$level 					= substr($data['password'], -4) ;
			$data['level_code']	= $level ;
			$data['level_value'] = "" ;
			if($dbl = $this->loginm->getval("value, dashboard", "code = '$level'", "sys_username_level")){
				$data['level_value'] = $dbl['value'] ;
				$data['dash']			= json_decode($dbl['dashboard'], true) ;
				$data['dash']			= $data['dash']['md5'] ;
			}

			//tgl tgl_transaksi
			$data['tgl_transaksi'] 	= $this->loginm->getconfig('tgl_transaksi') ;

			foreach ($data as $key => $value) {
				savesession($this, $key, $value) ;
			}

			//update last login
			$this->loginm->updlogin_last($va['cusername']) ;
			echo('window.location.href = "'.base_url().'" ;') ;
		}else{
			echo(' alert("User or Password not found") ; $("#cusername").focus(); ') ;
		} 
	}
}
?>
