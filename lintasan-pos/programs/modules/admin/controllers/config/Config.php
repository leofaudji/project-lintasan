<?php
class Config extends Bismillah_Controller{
	private $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model('config/config_m') ;
		$this->bdb 	= $this->config_m ;
	}

	public function index(){
		$data 		= array("app_title"=> getsession($this, "app_title") , "app_logo"=>"", "app_login_image"=>"") ;
		$app_logo	= $this->bdb->getconfig("app_logo") ;
		if($app_logo !== ""){
			$data['app_logo']	= '<img src="'.$app_logo.'" class="img-responsive" style="margin: 0 auto; max-height:200px"/>' ;
		}
		$app_login_image= $this->bdb->getconfig("app_login_image") ;
		if($app_login_image !== ""){
			$data['app_login_image']= '<img src="'.$app_login_image.'" class="img-responsive" style="margin: 0 auto; max-height:200px"/>' ;
		}
		$data['kota']= $this->bdb->getconfig("kota") ;

        //akt
        $data['reklrthlalu']= $this->bdb->getconfig("reklrthlalu") ;
        $data['ketreklrthlalu'] = $this->bdb->getval("keterangan", "kode = '{$data['reklrthlalu']}'", "keuangan_rekening");
        $data['reklrthberjalan']= $this->bdb->getconfig("reklrthberjalan") ;
        $data['ketreklrthberjalan'] = $this->bdb->getval("keterangan", "kode = '{$data['reklrthberjalan']}'", "keuangan_rekening");
        $data['reklrblnberjalan']= $this->bdb->getconfig("reklrblnberjalan") ;
        $data['ketreklrblnberjalan'] = $this->bdb->getval("keterangan", "kode = '{$data['reklrblnberjalan']}'", "keuangan_rekening");
        
        $data['rekpendoprawal']= $this->bdb->getconfig("rekpendoprawal") ;
        $data['ketrekpendoprawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpendoprawal']}'", "keuangan_rekening");
        $data['rekpendoprakhir']= $this->bdb->getconfig("rekpendoprakhir") ;
        $data['ketrekpendoprakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpendoprakhir']}'", "keuangan_rekening");
        
        $data['rekhppawal']= $this->bdb->getconfig("rekhppawal") ;
        $data['ketrekhppawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekhppawal']}'", "keuangan_rekening");
        $data['rekhppakhir']= $this->bdb->getconfig("rekhppakhir") ;
        $data['ketrekhppakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekhppakhir']}'", "keuangan_rekening");

        $data['rekbyoprawal']= $this->bdb->getconfig("rekbyoprawal") ;
        $data['ketrekbyoprawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekbyoprawal']}'", "keuangan_rekening");
        $data['rekbyoprakhir']= $this->bdb->getconfig("rekbyoprakhir") ;
        $data['ketrekbyoprakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekbyoprakhir']}'", "keuangan_rekening");

        $data['rekpendnonoprawal']= $this->bdb->getconfig("rekpendnonoprawal") ;
        $data['ketrekpendnonoprawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpendnonoprawal']}'", "keuangan_rekening");
        $data['rekpendnonoprakhir']= $this->bdb->getconfig("rekpendnonoprakhir") ;
        $data['ketrekpendnonoprakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpendnonoprakhir']}'", "keuangan_rekening");

        $data['rekbynonoprawal']= $this->bdb->getconfig("rekbynonoprawal") ;
        $data['ketrekbynonoprawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekbynonoprawal']}'", "keuangan_rekening");
        $data['rekbynonoprakhir']= $this->bdb->getconfig("rekbynonoprakhir") ;
        $data['ketrekbynonoprakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekbynonoprakhir']}'", "keuangan_rekening");
        
        $data['rekpajakawal']= $this->bdb->getconfig("rekpajakawal") ;
        $data['ketrekpajakawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpajakawal']}'", "keuangan_rekening");
        $data['rekpajakakhir']= $this->bdb->getconfig("rekpajakakhir") ;
        $data['ketrekpajakakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpajakakhir']}'", "keuangan_rekening");
        
        $data['rekselisih']= $this->bdb->getconfig("rekselisih") ;
        $data['ketrekselisih'] = $this->bdb->getval("keterangan", "kode = '{$data['rekselisih']}'", "keuangan_rekening");
        $data['rekselisihopname']= $this->bdb->getconfig("rekselisihopname") ;
        $data['ketrekselisihopname'] = $this->bdb->getval("keterangan", "kode = '{$data['rekselisihopname']}'", "keuangan_rekening");

        //pb
        $data['rekpbdisc']= $this->bdb->getconfig("rekpbdisc") ;
        $data['ketrekpbdisc'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpbdisc']}'", "keuangan_rekening");
        $data['rekpbppn']= $this->bdb->getconfig("rekpbppn") ;
        $data['ketrekpbppn'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpbppn']}'", "keuangan_rekening");
        $data['rekpbhut']= $this->bdb->getconfig("rekpbhut") ;
        $data['ketrekpbhut'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpbhut']}'", "keuangan_rekening");
        $data['rekpbhutdisc']= $this->bdb->getconfig("rekpbhutdisc") ;
        $data['ketrekpbhutdisc'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpbhutdisc']}'", "keuangan_rekening");
        $data['rekpbhutpembulatan']= $this->bdb->getconfig("rekpbhutpembulatan") ;
        $data['ketrekpbhutpembulatan'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpbhutpembulatan']}'", "keuangan_rekening");
        $data['rekpbuangmuka']= $this->bdb->getconfig("rekpbuangmuka") ;
        $data['ketrekpbuangmuka'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpbuangmuka']}'", "keuangan_rekening");

        //pj
        $data['pjgudang']= $this->bdb->getconfig("pjgudang") ;
        $data['ketpjgudang'] = $this->bdb->getval("keterangan", "kode = '{$data['pjgudang']}'", "gudang");
        $data['rekpjpiutang']= $this->bdb->getconfig("rekpjpiutang") ;
        $data['ketrekpjpiutang'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpjpiutang']}'", "keuangan_rekening");
        $data['rekpjppn']= $this->bdb->getconfig("rekpjppn") ;
        $data['ketrekpjppn'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpjppn']}'", "keuangan_rekening");
        $data['rekpjpiutangdisc']= $this->bdb->getconfig("rekpjpiutangdisc") ;
        $data['ketrekpjpiutangdisc'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpjpiutangdisc']}'", "keuangan_rekening");
        $data['rekpjpiutangpembulatan']= $this->bdb->getconfig("rekpjpiutangpembulatan") ;
        $data['ketrekpjpiutangpembulatan'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpjpiutangpembulatan']}'", "keuangan_rekening");
        $data['rekpjuangmuka']= $this->bdb->getconfig("rekpjuangmuka") ;
        $data['ketrekpjuangmuka'] = $this->bdb->getval("keterangan", "kode = '{$data['rekpjuangmuka']}'", "keuangan_rekening");
        
        //cs
        $data['cfgkasirprinth1']= $this->bdb->getconfig("cfgkasirprinth1") ;
        $data['cfgkasirprinth2']= $this->bdb->getconfig("cfgkasirprinth2") ;
        $data['cfgkasirprinth3']= $this->bdb->getconfig("cfgkasirprinth3") ;
        $data['cfgkasirprinth4']= $this->bdb->getconfig("cfgkasirprinth4") ;
        $data['cfgkasirprinth5']= $this->bdb->getconfig("cfgkasirprinth5") ;
        $data['cfgkasirprinth6']= $this->bdb->getconfig("cfgkasirprinth6") ;
        
        $data['cfgkasirprintf1']= $this->bdb->getconfig("cfgkasirprintf1") ;
        $data['cfgkasirprintf2']= $this->bdb->getconfig("cfgkasirprintf2") ;
        $data['cfgkasirprintf3']= $this->bdb->getconfig("cfgkasirprintf3") ;
        $data['cfgkasirprintf4']= $this->bdb->getconfig("cfgkasirprintf4") ;
        $data['cfgkasirprintf5']= $this->bdb->getconfig("cfgkasirprintf5") ;
        $data['cfgkasirprintf6']= $this->bdb->getconfig("cfgkasirprintf6") ;

        $data['cfgipconnectionprinter']= $this->bdb->getconfig("cfgipconnectionprinter") ;
        $data['cfgospctoprinter']= $this->bdb->getconfig("cfgospctoprinter") ;
        

        //remove session
		savesession($this, "ssconfig_app_logo", "" ) ;
		savesession($this, "ssconfig_app_login_image", "" ) ;
		$this->load->view("config/config", $data) ;
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
        $this->bdb->saveconfig("kota", $va['kota']) ;

        //akt
        $this->bdb->saveconfig("reklrthlalu", $va['reklrthlalu']) ;
        $this->bdb->saveconfig("reklrthberjalan", $va['reklrthberjalan']) ;
        $this->bdb->saveconfig("reklrblnberjalan", $va['reklrblnberjalan']) ;
        $this->bdb->saveconfig("rekpendoprawal", $va['rekpendoprawal']) ;
        $this->bdb->saveconfig("rekpendoprakhir", $va['rekpendoprakhir']) ;
        $this->bdb->saveconfig("rekhppawal", $va['rekhppawal']) ;
        $this->bdb->saveconfig("rekhppakhir", $va['rekhppakhir']) ;
        $this->bdb->saveconfig("rekbyoprawal", $va['rekbyoprawal']) ;
        $this->bdb->saveconfig("rekbyoprakhir", $va['rekbyoprakhir']) ;
        $this->bdb->saveconfig("rekpendnonoprawal", $va['rekpendnonoprawal']) ;
        $this->bdb->saveconfig("rekpendnonoprakhir", $va['rekpendnonoprakhir']) ;
        $this->bdb->saveconfig("rekbynonoprawal", $va['rekbynonoprawal']) ;
        $this->bdb->saveconfig("rekbynonoprakhir", $va['rekbynonoprakhir']) ;
        $this->bdb->saveconfig("rekpajakawal", $va['rekpajakawal']) ;
        $this->bdb->saveconfig("rekpajakakhir", $va['rekpajakakhir']) ;
        $this->bdb->saveconfig("rekselisih", $va['rekselisih']) ;
        $this->bdb->saveconfig("rekselisihopname", $va['rekselisihopname']) ;


        //pb
        $this->bdb->saveconfig("rekpbdisc", $va['rekpbdisc']) ;
        $this->bdb->saveconfig("rekpbppn", $va['rekpbppn']) ;
        $this->bdb->saveconfig("rekpbhut", $va['rekpbhut']) ;
        $this->bdb->saveconfig("rekpbhutdisc", $va['rekpbhutdisc']) ;
        $this->bdb->saveconfig("rekpbhutpembulatan", $va['rekpbhutpembulatan']) ;
        $this->bdb->saveconfig("rekpbuangmuka", $va['rekpbuangmuka']) ;

        //pj
        $this->bdb->saveconfig("pjgudang", $va['pjgudang']) ;
        $this->bdb->saveconfig("rekpjpiutang", $va['rekpjpiutang']) ;
        $this->bdb->saveconfig("rekpjppn", $va['rekpjppn']) ;
        $this->bdb->saveconfig("rekpjpiutangdisc", $va['rekpjpiutangdisc']) ;
        $this->bdb->saveconfig("rekpjpiutangpembulatan", $va['rekpjpiutangpembulatan']) ;
        $this->bdb->saveconfig("rekpjuangmuka", $va['rekpjuangmuka']) ;

        //cs
        $this->bdb->saveconfig("cfgkasirprinth1", $va['cfgkasirprinth1']) ;
        $this->bdb->saveconfig("cfgkasirprinth2", $va['cfgkasirprinth2']) ;
        $this->bdb->saveconfig("cfgkasirprinth3", $va['cfgkasirprinth3']) ;
        $this->bdb->saveconfig("cfgkasirprinth4", $va['cfgkasirprinth4']) ;
        $this->bdb->saveconfig("cfgkasirprinth5", $va['cfgkasirprinth5']) ;
        $this->bdb->saveconfig("cfgkasirprinth6", $va['cfgkasirprinth6']) ;
        
        $this->bdb->saveconfig("cfgkasirprintf1", $va['cfgkasirprintf1']) ;
        $this->bdb->saveconfig("cfgkasirprintf2", $va['cfgkasirprintf2']) ;
        $this->bdb->saveconfig("cfgkasirprintf3", $va['cfgkasirprintf3']) ;
        $this->bdb->saveconfig("cfgkasirprintf4", $va['cfgkasirprintf4']) ;
        $this->bdb->saveconfig("cfgkasirprintf5", $va['cfgkasirprintf5']) ;
        $this->bdb->saveconfig("cfgkasirprintf6", $va['cfgkasirprintf6']) ;
        
        $this->bdb->saveconfig("cfgipconnectionprinter", $va['cfgipconnectionprinter']) ;
        $this->bdb->saveconfig("cfgospctoprinter", $va['cfgospctoprinter']) ;



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

    public function seekrekening(){
        $search     = $this->input->get('q');
        $vdb    = $this->config_m->seekrekening($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->config_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ".$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function seekgudang(){
        $search     = $this->input->get('q');
        $vdb    = $this->config_m->seekgudang($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->config_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ".$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
}
?>
