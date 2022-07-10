<?php
class Utlupdateprogram extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model("utl/Utlupdateprogram_m") ;
        $this->bdb 	= $this->Utlupdateprogram_m ;
    } 

    public function index(){
        $this->load->view("utl/utlupdateprogram") ; 

    }



    public function uploadfile(){
        savesession($this, "ssupdprogram_" . $cfg, "") ;

		$fcfg	= array("upload_path"=>"../../tmp/", "allowed_types"=>"zip", "overwrite"=>true,
						"file_name"=> $cfg ) ;
		$this->load->library('upload', $fcfg) ;

		if ( ! $this->upload->do_upload(0) ){
			echo('
				alert("'. $this->upload->display_errors('','') .'") ;
			') ;
		}else{
			$data 	= $this->upload->data() ;
			$fname 	= $cfg . $data['file_ext'] ;
			$tname 	= str_replace($data['file_ext'], "", $data['client_name']) ;
			$vimage	= array( $tname => $data['full_path']) ;
			savesession($this, "ssupdprogram_" . $cfg, json_encode($vimage) ) ;
		}
    }
}
?>

