<?php
class Trtabunganpembukaan extends Bismillah_Controller{ 
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->helper("bdate") ;
		$this->load->model("func/anggota_m") ;
		$this->load->model("tr/trtabunganpembukaan_m") ;
		$this->bdb 	= $this->trtabunganpembukaan_m ;
	}  

	public function index(){
		$this->load->view("tr/trtabunganpembukaan") ; 

	}   

	public function loadgrid(){
		$va     = json_decode($this->input->post('request'), true) ;
		$vare   = array() ;
		$vdb    = $this->bdb->loadgrid($va) ;
		$dbd    = $vdb['db'] ;
		$n = 0 ;
		while( $dbr = $this->bdb->getrow($dbd) ){
			$vs = $dbr;  
			++$n ;
			$vs['no'] = $n ;
			$vs['tgl'] = date("d-m-Y", strtotime($vs['tgl'])) ;
			//$vs['statuspelanggan'] = statuspelanggan($vs['statuspelanggan']) ;
			$vs['cmdedit']    = '<button type="button" onClick="bos.trtabunganpembukaan.cmdedit(\''.$dbr['id'].'\')"
												class="btn btn-default btn-grid">Koreksi</button>' ;
			$vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

			$vs['cmddelete']  = '<button type="button" onClick="bos.trtabunganpembukaan.cmddelete(\''.$dbr['id'].'\')"
												class="btn btn-danger btn-grid">Hapus</button>' ;
			$vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

			//$vs['cmdcetak']  = '<button type="button" onClick="bos.trtabunganpembukaan.cmdcetak(\''.$dbr['id'].'\')" class="btn btn-primary btn-grid">Cetak</button>' ;
			//$vs['cmdcetak']  = html_entity_decode($vs['cmdcetak']) ;
			$vare[]		= $vs ;
		} 

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "sstrtabunganpembukaan_id", "") ;
		$kode 	= $this->bdb->getkode(false) ;
		echo('
			bos.trtabunganpembukaan.obj.find("#kode").html("'.$kode.'") ;
		') ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "sstrtabunganpembukaan_id") ;
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
		echo(' bos.trtabunganpembukaan.settab(0) ;  ') ;
	}

	public function deleting(){
		$va 	= $this->input->post() ; 
		$id 	= $va['id'] ;
		$this->bdb->delete("tabungan_rekening", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.trtabunganpembukaan.grid1_reload() ; ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "sstrtabunganpembukaan_id", $d['id']) ; 
			$d['tgl'] 	= date_2d($d['tgl']) ;   
			$image = '<img src=\"./uploads/no-image.png\" class=\"img-responsive\"/><br>' ; ;
			if(!empty($d['data_var'])){      
				$image 	= '<img src=\"'.base_url($d['data_var']).'\" class=\"img-responsive\"/><br>' ;
				$image 	.= str_replace("./uploads/pelanggan/", "~/",$d['data_var']) ;
			}

			$w =  "id_kantor = '{$d['id_kantor']}' and kode = '{$d['kode_anggota']}'" ; 
			$nama = $this->bdb->getval("nama",$w, "mst_anggota") ;
			$alamat = $this->bdb->getval("alamat",$w, "mst_anggota") ;
			$telepon = $this->bdb->getval("telepon",$w, "mst_anggota") ; 
			$golongan_tabungan[]   = array("id"=>$d['golongan_tabungan'],"text"=>$d['golongan_tabungan']);  
			
			echo('   
				with(bos.trtabunganpembukaan.obj){
					find("#tgl").val("'.$d['tgl'].'") ;
					find("#kode_anggota").val("'.$d['kode_anggota'].'") ;
					find("#nama").val("'.$nama.'") ;
					find("#alamat").val("'.$alamat.'") ;
					find("#telepon").val("'.$telepon.'") ;
					find("#golongan_tabungan").sval('.json_encode($golongan_tabungan).') ;  
					find("#tujuan_pembukaan").val("'.$d['tujuan_pembukaan'].'") ;
					find("#ahli_waris").val("'.$d['ahli_waris'].'") ;
					find("#foto").html("'.$image.'") ;
				}
				bos.trtabunganpembukaan.settab(1) ;
			') ;
		} 
	} 

	
   public function saving_image(){   
		$fcfg	= array("upload_path"=>"./tmp/", "allowed_types"=>"jpg|jpeg|png", "overwrite"=>true) ;

		savesession($this, "sspelanggan_image", "") ;   
		$this->load->library('upload', $fcfg) ;
		if ( ! $this->upload->do_upload(0) ){
			echo('
				alert("'. $this->upload->display_errors('','') .'") ;
				bos.trtabunganpembukaan.obj.find("#idlimage").html("") ;
			') ;
		}else{
			$data 	= $this->upload->data() ;
			$tname 	= str_replace($data['file_ext'], "", $data['client_name']) ;
			$vimage	= array( $tname => $data['full_path']) ;
			savesession($this, "sspelanggan_image", json_encode($vimage) ) ;  

			echo('
				bos.trtabunganpembukaan.obj.find("#idlimage").html("") ;
				bos.trtabunganpembukaan.obj.find("#idimage").html("<img src=\"'.base_url("./tmp/" . $data['client_name'] . "?time=". time()).'\" class=\"img-responsive\" />") ;
			') ;
		}
	}

	public function loadgrid3(){
		$va     = json_decode($this->input->post('request'), true) ;
		$vare   = array() ;
		$vdb    = $this->trtabunganpembukaan_m->loadgrid3($va) ;
		$dbd    = $vdb['db'] ;
		while( $dbr = $this->trtabunganpembukaan_m->getrow($dbd) ){
				$vaset   = $dbr ;
				$vaset['cmdpilih']    = '<button type="button" onClick="bos.trtabunganpembukaan.cmdpilih(\''.$dbr['kode'].'\')"
											 class="btn btn-success btn-grid">Pilih</button>' ;
				$vaset['cmdpilih']     = html_entity_decode($vaset['cmdpilih']) ;
				$vare[]    = $vaset ;
		}

		$vare   = array("total"=>$vdb['rows'], "records"=>$vare ) ;
		echo(json_encode($vare)) ;
	}

	public function pilih(){
		$va   = $this->input->post() ;
		$kode   = $va['kode'] ;
		$data = $this->anggota_m->getdata($kode) ;
		if(!empty($data)){
				echo('
				with(bos.trtabunganpembukaan.obj){
					 find("#kode_anggota").val("'.$data['kode'].'") ; 
					 find("#nama").val("'.$data['nama'].'");
					 find("#alamat").val("'.$data['alamat'].'");
					 find("#telepon").val("'.$data['telepon'].'");
					 find("#golongan_tabungan").focus() ; 
					 bos.trtabunganpembukaan.loadmodelstock("hide");
				}

		 ') ;
		}
}

}
?>
