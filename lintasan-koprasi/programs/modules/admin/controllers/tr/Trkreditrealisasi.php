<?php
class Trkreditrealisasi extends Bismillah_Controller{ 
	protected $bdb ;

	public function __construct(){ 
		parent::__construct() ;
		$this->load->helper("bdate") ; 
		$this->load->model("func/anggota_m") ;
		$this->load->model("func/kredit_m") ;
		$this->load->model("tr/trkreditrealisasi_m") ;
		$this->bdb 	= $this->trkreditrealisasi_m ;
	}  

	public function index(){
		$this->load->view("tr/trkreditrealisasi") ; 

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
			$vs['tgl'] = date_2d($vs['tgl']) ;
			$vs['plafond'] =  string_2s($vs['plafond']) ;
			$vs['lama'] =  $vs['lama'] . " Bulan" ;
			$vs['sukubunga'] =  $vs['sukubunga'] . " % p.a" ;
			$vs['cmdedit']    = '<button type="button" onClick="bos.trkreditrealisasi.cmdedit(\''.$dbr['id'].'\')"
												class="btn btn-default btn-grid">Koreksi</button>' ;
			$vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

			$vs['cmddelete']  = '<button type="button" onClick="bos.trkreditrealisasi.cmddelete(\''.$dbr['rekening'].'\')"
												class="btn btn-danger btn-grid">Hapus</button>' ;
			$vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

			//$vs['cmdcetak']  = '<button type="button" onClick="bos.trkreditrealisasi.cmdcetak(\''.$dbr['id'].'\')" class="btn btn-primary btn-grid">Cetak</button>' ;
			//$vs['cmdcetak']  = html_entity_decode($vs['cmdcetak']) ;
			$vare[]		= $vs ;
		} 

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "sstrkreditrealisasi_id", "") ;
		$kode 	= $this->bdb->getkode(false) ;
		echo('
			bos.trkreditrealisasi.obj.find("#kode").html("'.$kode.'") ;
		') ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "sstrkreditrealisasi_id") ;
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
		echo(' bos.trkreditrealisasi.settab(0) ;  bos.trkreditrealisasi.init() ;') ;
		$this->init_agunan() ;
	}

	public function deleting(){ 
		$va 	= $this->input->post() ; 
		$id 	= $va['id'] ;
		$this->bdb->delete("kredit_agunan_tmp", "rekening = " . $this->bdb->escape($id)) ;
		$this->bdb->delete("kredit_agunan", "rekening = " . $this->bdb->escape($id)) ;
		$this->bdb->delete("kredit_rekening", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.trkreditrealisasi.grid1_reload() ; ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "sstrkreditrealisasi_id", $d['id']) ; 
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
			$no_spk = $d['no_spk'] ; 
			$golongan_kredit[]   = array("id"=>$d['golongan_kredit'],"text"=>$d['golongan_kredit']);  
			$cp[]   = array("id"=>$d['caraperhitungan'],"text"=>$d['caraperhitungan']);  
			$ao[]   = array("id"=>$d['ao'],"text"=>$d['ao']);  
			
			$data_agunan = $this->bdb->get_agunan($d['id_kantor'],$d['rekening']) ;
			if(!empty($data_agunan)){
				$this->init_agunan() ;
				$this->load_agunan($data_agunan) ;      
			}

			$this->getangsuran($d['tgl'],$d['lama'],$d['plafond'],$d['sukubunga'],$d['caraperhitungan']) ;
			
			echo('   
				with(bos.trkreditrealisasi.obj){
					find("#tgl").val("'.$d['tgl'].'") ;
					find("#kode_anggota").val("'.$d['kode_anggota'].'") ;   
					find("#s_rekening").val("'.$d['rekening'].'") ;
					find("#nama").val("'.$nama.'") ;
					find("#alamat").val("'.$alamat.'") ;
					find("#telepon").val("'.$telepon.'") ;
					find("#no_spk").val("'.$d['no_spk'].'") ;
					find("#golongan_kredit").sval('.json_encode($golongan_kredit).') ;  
					find("#plafond").val("'.$d['plafond'].'") ;
					find("#sukubunga").val("'.$d['sukubunga'].'") ;
					find("#lama").val("'.$d['lama'].'") ;
					find("#caraperhitungan").sval('.json_encode($cp).') ;  
					find("#administrasi").val("'.$d['administrasi'].'") ;
					find("#provisi").val("'.$d['provisi'].'") ;
					find("#materai").val("'.$d['materai'].'") ;
					find("#ao").sval('.json_encode($ao).') ;  
					find("#tujuan_pembukaan").val("'.$d['tujuan_pembukaan'].'") ;
					find("#ahli_waris").val("'.$d['ahli_waris'].'") ;
					find("#foto").html("'.$image.'") ;
				}
				bos.trkreditrealisasi.settab(1) ;
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
				bos.trkreditrealisasi.obj.find("#idlimage").html("") ;
			') ;
		}else{
			$data 	= $this->upload->data() ;
			$tname 	= str_replace($data['file_ext'], "", $data['client_name']) ;
			$vimage	= array( $tname => $data['full_path']) ;
			savesession($this, "sspelanggan_image", json_encode($vimage) ) ;  

			echo('
				bos.trkreditrealisasi.obj.find("#idlimage").html("") ;
				bos.trkreditrealisasi.obj.find("#idimage").html("<img src=\"'.base_url("./tmp/" . $data['client_name'] . "?time=". time()).'\" class=\"img-responsive\" />") ;
			') ;
		}
	}

	public function loadgrid3(){
		$va     = json_decode($this->input->post('request'), true) ;
		$vare   = array() ;
		$vdb    = $this->anggota_m->loadgrid($va) ;
		$dbd    = $vdb['db'] ;
		while( $dbr = $this->trkreditrealisasi_m->getrow($dbd) ){
				$vaset   = $dbr ;
				$vaset['cmdpilih']    = '<button type="button" onClick="bos.trkreditrealisasi.cmdpilih(\''.$dbr['kode'].'\')"
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
				with(bos.trkreditrealisasi.obj){
					 find("#kode_anggota").val("'.$data['kode'].'") ; 
					 find("#nama").val("'.$data['nama'].'");
					 find("#alamat").val("'.$data['alamat'].'");
					 find("#telepon").val("'.$data['telepon'].'");
					 find("#no_spk").focus() ;     
				}
				bos.trkreditrealisasi.loadmodelstock("hide");

		 ') ; 
		}
	}

	public function seekjenisagunan(){
		$va   = $this->input->post() ;
		$kode   = $va['jenis_agunan'] ;
		$data = $this->trkreditrealisasi_m->getdata_jenisagunan($kode) ;
		if(!empty($data) and !empty($data['data_kategori'])){ 
				$data_kategori = explode("~~",$data['data_kategori']) ;
				$f = "" ;
				foreach($data_kategori as $key=>$value){
					$f .= $value . " : \\n" ;
				}
				echo('
				with(bos.trkreditrealisasi.obj){
					 find("#data_agunan").val("'.$f.'") ;  
					 find("#nilai_agunan").focus() ;  
				}
		 ') ;
		}
	}

	public function addagunan(){
		$va = $this->input->post() ; 
		$id = md5($va['kode_anggota'] . $va['jenis_agunan'] . $va['nilai_agunan'] . $va['data_agunan']) ;
		$data_agunan[$id] = array("kode_anggota"=>$va['kode_anggota'], 
													 "jenis_agunan"=>$va['jenis_agunan'], 
													 "nilai_agunan"=>$va['nilai_agunan'], 
													 "data_agunan"=>$va['data_agunan']
		) ; 
		$this->bdb->addagunan($data_agunan) ;  
		$this->load_agunan($data_agunan) ;  
	}

	public function load_agunan($data){ 
		$html_header = "<table style='width:100%;border-bottom:1px solid #bbc1c9;border-collapse:collapse;font-weight:bold'><tr><td style='text-align:center;width:120px'>Kode Anggota</td><td style='text-align:center;width:120px'>Jenis Agunan</td><td style='text-align:right;width:150px'>Nilai Agunan</td><td style='text-align:left;padding-left:15px'>Keterangan</td><td></td></tr></table>" ;	 
		
		echo('  bos.trkreditrealisasi.obj.find("#data_agunan_tmp_header").html("'.$html_header.'") ; ');  
 
		$n = 0 ;
		foreach($data as $key=>$value){ 
			$onclick = "onclick=bos.trkreditrealisasi.cmdremove('$key')" ;  
			$data_agunan = substr(str_replace("\n"," , ",$value['data_agunan']),0,100) ;
			$nilai_agunan = string_2s($value['nilai_agunan']) ;
			$html_content = "<table id='".$key."' style='width:100%;border:0px solid;' cellspacing='2' cellpadding='10'><tr><td style='text-align:center;width:120px'>". $value['kode_anggota'] ."</td><td style='text-align:center;width:120px'>". $value['jenis_agunan'] ."</td><td style='text-align:right;width:150px'>". $nilai_agunan ."</td><td style='text-align:left;padding-left:15px'>". $data_agunan ."</td><td style='width:10px' ".$onclick."> x </td></tr></table>" ;
			$html_contents = "<table id='".$key."' style='width:100%;border:0px solid;' cellspacing='2' cellpadding='10'><tr><td style='text-align:center;width:20px'>". ++$n ."</td><td style='text-align:center;width:50px'>". $value['jenis_agunan'] ."</td><td style='text-align:right;width:120px'>". $nilai_agunan ."</td><td style='text-align:left;padding-left:15px'>". $data_agunan ."</td><td style='width:10px' ".$onclick."> x </td></tr></table>" ;
			echo('bos.trkreditrealisasi.obj.find("#data_agunan_tmp_data").append("'.$html_content.'") ;') ; 
			echo('bos.trkreditrealisasi.obj.find("#s_data_agunan").append("'.$html_contents.'") ;') ;  
		}
	}



	public function removeagunan(){  
		$va = $this->input->post() ;    
		$this->bdb->removeagunan($va['key']) ;   
		echo('bos.trkreditrealisasi.obj.find("#'.$va['key'].'").remove() ;') ;   
		//$this->load_agunan() ;    
	}

	public function init_agunan(){
		echo('
			with(bos.trkreditrealisasi.obj){
				find("#data_agunan_tmp_header").html("") ;
				find("#data_agunan_tmp_data").html("") ;
				find("#s_data_agunan").html("") ;
				find("#s_data_angsuran").html("") ;
			}
		') ;  
	}

	public function getangsuran($tgl,$lama,$plafond,$sukubunga,$caraperhitungan){  
		$angsuran = $this->kredit_m->getangsuran($tgl,$lama,$plafond,$sukubunga,$caraperhitungan) ;
		$html = "" ;
		for($i=1;$i<=$lama;$i++){
			$periode = date("d-m-Y",date_nextmonth(strtotime($tgl),$i)) ;
			$pokok = $angsuran[$i]['pokok'] ; 
			$bunga = $angsuran[$i]['bunga'] ; 
			$total = $pokok + $bunga ;  
			$html .= "<table><tr><td align='center' width='30px'>".$i."</td><td>" . $periode . "</td><td align='right' width='120px'>".string_2s($pokok)."</td><td align='right' width='120px'>".string_2s($bunga)."</td><td align='right' width='150px'>".string_2s($total)."</td></tr></table>" ;
		} 
		echo('bos.trkreditrealisasi.obj.find("#s_data_angsuran").append("'.$html.'")') ; 
	}

	public function getsimulasi(){  
		$va 	= $this->input->post() ;
		echo('  
			with(bos.trkreditrealisasi.obj){
				find("#s_nama").html(find("#nama").val()) ;  
				find("#s_alamat").html(find("#alamat").val()) ;  
				find("#s_golongan_kredit").html(find("#golongan_kredit").val()) ;  
				find("#s_tujuan_pembukaan").html(find("#tujuan_pembukaan").val()) ;  
				find("#s_ahli_waris").html(find("#ahli_waris").val()) ;  
				find("#s_tgl").html(find("#tgl").val()) ;  
				find("#s_plafond").html(find("#plafond").val()) ;  
				find("#s_sukubunga").html(find("#sukubunga").val()  + " % per Tahun") ;  
				find("#s_lama").html(find("#lama").val() + " Bulan") ;  
				find("#s_tgl_jthtmp").html(find("#tgl").val()) ;  
			}			
		');

	}

}
?>
