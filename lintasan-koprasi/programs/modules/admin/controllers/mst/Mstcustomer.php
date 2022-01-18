<?php
class Mstcustomer extends Bismillah_Controller{ 
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->helper("bdate") ;
		$this->load->helper("toko") ; 
		$this->load->model("mst/mstcustomer_m") ;
		$this->bdb 	= $this->mstcustomer_m ;
	}  

	public function index(){
		$this->load->view("mst/mstcustomer") ;

	}   

	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
		$vare   = array() ;
		$vdb    = $this->bdb->loadgrid($va) ;
		$dbd    = $vdb['db'] ;
		while( $dbr = $this->bdb->getrow($dbd) ){
			$vs = $dbr;  
			$vs['tgl'] = date("d-m-Y", strtotime($vs['tgl'])) ;
			//$vs['statuspelanggan'] = statuspelanggan($vs['statuspelanggan']) ;
			$vs['cmdedit']    = '<button type="button" onClick="bos.mstcustomer.cmdedit(\''.$dbr['id'].'\')"
												class="btn btn-default btn-grid">Koreksi</button>' ;
			$vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

			$vs['cmddelete']  = '<button type="button" onClick="bos.mstcustomer.cmddelete(\''.$dbr['id'].'\')"
												class="btn btn-danger btn-grid">Hapus</button>' ;
			$vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

			//$vs['cmdcetak']  = '<button type="button" onClick="bos.mstcustomer.cmdcetak(\''.$dbr['id'].'\')" class="btn btn-primary btn-grid">Cetak</button>' ;
			//$vs['cmdcetak']  = html_entity_decode($vs['cmdcetak']) ;
			$vare[]		= $vs ;
		}

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "ssmstcustomer_id", "") ;
		$kode 	= $this->bdb->getkode(false) ;
		echo('
			bos.mstcustomer.obj.find("#kode").html("'.$kode.'") ;
		') ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "ssmstcustomer_id") ;
		$url    = "" ;
		$vimage 		= json_decode(getsession($this, "sspelanggan_image", "{}"), true) ;
		if(!empty($vimage)){
			$adir 	= $this->config->item('bcore_uploads') . "pelanggan/" ;   
         @mkdir($adir, 0777, true) ;
			foreach ($vimage as $key => $img) { 
				$vi	= pathinfo($img) ;
				$dir 	= $adir ; 
				$dir .= $id . "." . $vi['extension'] ;        
				if(is_file($dir)) @unlink($dir) ;
				if(@copy($img,$dir)){
					@unlink($img) ;
					@unlink($url) ;  
					$url	= $dir;
				} 
			}
		}  
		unset($va['image']) ;           
		if($url <> "") $va['data_var']	= $url ;   

		$this->bdb->saving($va, $id) ;
		echo(' bos.mstcustomer.settab(0) ;  ') ;
	}

	public function deleting(){
		$va 	= $this->input->post() ; 
		$id 	= $va['id'] ;
		$this->bdb->delete("pelanggan", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.mstcustomer.grid1_reload() ; ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "ssmstcustomer_id", $d['id']) ; 
			$d['tgl_lahir'] 	= date("d-m-Y", strtotime($d['tgl_lahir'])) ;
			$d['tgl'] 	= date("d-m-Y", strtotime($d['tgl'])) ;   
			$image = '<img src=\"./uploads/no-image.png\" class=\"img-responsive\"/><br>' ; ;
			if(!empty($d['data_var'])){      
				$image 	= '<img src=\"'.base_url($d['data_var']).'\" class=\"img-responsive\"/><br>' ;
				$image 	.= str_replace("./uploads/pelanggan/", "~/",$d['data_var']) ;
			}

			$provinsi[]   = array("id"=>$d['provinsi'],"text"=>$d['provinsi']); 
			$kota[]   = array("id"=>$d['kota'],"text"=>$d['kota']); 
			$kecamatan[]   = array("id"=>$d['kecamatan'],"text"=>$d['kecamatan']); 
			$agama[]   = array("id"=>$d['agama'],"text"=>$d['agama']); 
			
			echo('   
				bos.mstcustomer.obj.find("#kode").html("'.$d['kode'].'") ;
				bos.mstcustomer.obj.find("#tgl").val("'.$d['tgl'].'") ;
				bos.mstcustomer.obj.find("#nama").val("'.$d['nama'].'") ;
				bos.mstcustomer.obj.find("#provinsi").sval('.json_encode($provinsi).') ; 
				bos.mstcustomer.obj.find("#kota").sval('.json_encode($kota).') ; 
				bos.mstcustomer.obj.find("#kecamatan").sval('.json_encode($kecamatan).') ; 
				bos.mstcustomer.obj.find("#alamat").val("'.$d['alamat'].'") ;
				bos.mstcustomer.obj.find("#telepon").val("'.$d['telepon'].'") ; 
				bos.mstcustomer.obj.find("#email").val("'.$d['email'].'") ;
				bos.mstcustomer.obj.find("#tempat_lahir").val("'.$d['tempat_lahir'].'") ;
				bjs.setopt(bos.mstcustomer.obj, "jenis_kelamin", "'.$d['jenis_kelamin'].'") ;
				bos.mstcustomer.obj.find("#tgl_lahir").val("'.$d['tgl_lahir'].'") ;				
				bos.mstcustomer.obj.find("#agama").sval('.json_encode($agama).') ; 
				bos.mstcustomer.obj.find("#foto").html("'.$image.'") ;
				bos.mstcustomer.settab(1) ;
			') ;
		}
	} 

	public function showreport(){
		extract($_GET) ;	
      	$font = 8 ;
      	$vaData = $this->bdb->getpelanggan($id) ;

      	$data[0] = array("kode"=>"Kode Member","aa"=>":","keterangan"=>$vaData['kode']) ;
      	$data[1] = array("kode"=>"Kode Finger","aa"=>":","keterangan"=>$vaData['kodefinger']) ;
      	$data[2] = array("kode"=>"Nama Anggota ","aa"=>":","keterangan"=>$vaData['nama']) ;
      	$data[3] = array("kode"=>"Alamat","aa"=>":","keterangan"=>$vaData['alamat']) ;
      	$data[4] = array("kode"=>"Telepon","aa"=>":","keterangan"=>$vaData['telepon']) ;
      	$data[5] = array("kode"=>"Email","aa"=>":","keterangan"=>$vaData['email']) ;
      	$data[6] = array("kode"=>"","aa"=>":","keterangan"=>"") ;
      	$data[7] = array("kode"=>"Tanggal Daftar","aa"=>":","keterangan"=>date_2d($vaData['tgl'])) ;

        $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'DaftarBukuBesar_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>TANDA BUKTI PENDAFTARAN</b>",$font+4) ; 
        $this->bospdf->ezText("FITNESS SYANJAYA",$font+3) ;
		$this->bospdf->ezText("____________________________________________________") ; 
		$this->bospdf->ezText("") ;
		$this->bospdf->ezTable($data,"","",  
								array("fontSize"=>$font,'showLines'=>0,'showHeadings'=>0,"cols"=> array( "kode"=>array("caption"=>"Keterangan","width"=>16,"wrap"=>1),
									"aa"=>array("caption"=>"Keterangan","align"=>"center","wrap"=>1,"width"=>2),
			                     "keterangan"=>array("caption"=>"Username")))) ;  
		$this->bospdf->ezText("") ;
		$this->bospdf->ezText("____________________________________________________") ; 
		$this->bospdf->ezText("* Persyaratan : ",$font) ;
		

        $this->bospdf->ezStream() ; 
   }

   public function saving_image(){   
		$fcfg	= array("upload_path"=>"./tmp/", "allowed_types"=>"jpg|jpeg|png", "overwrite"=>true) ;

		savesession($this, "sspelanggan_image", "") ;   
		$this->load->library('upload', $fcfg) ;
		if ( ! $this->upload->do_upload(0) ){
			echo('
				alert("'. $this->upload->display_errors('','') .'") ;
				bos.mstcustomer.obj.find("#idlimage").html("") ;
			') ;
		}else{
			$data 	= $this->upload->data() ;
			$tname 	= str_replace($data['file_ext'], "", $data['client_name']) ;
			$vimage	= array( $tname => $data['full_path']) ;
			savesession($this, "sspelanggan_image", json_encode($vimage) ) ;  

			echo('
				bos.mstcustomer.obj.find("#idlimage").html("") ;
				bos.mstcustomer.obj.find("#idimage").html("<img src=\"'.base_url("./tmp/" . $data['client_name'] . "?time=". time()).'\" class=\"img-responsive\" />") ;
			') ;
		}
	}

}
?>
