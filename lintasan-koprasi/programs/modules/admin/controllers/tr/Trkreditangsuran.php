<?php
class Trkreditangsuran extends Bismillah_Controller{ 
	protected $bdb ;
	var $ltrue = true ; 

	public function __construct(){   
		parent::__construct() ;
		$this->load->helper("bdate") ; 
		$this->load->model("func/anggota_m") ;
		$this->load->model("func/kredit_m") ;
		$this->load->model("tr/trkreditangsuran_m") ;
		$this->bdb 	= $this->trkreditangsuran_m ;
	}   
 
	public function index(){
		$this->load->view("tr/trkreditangsuran") ; 

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
			$vs['datetime'] = $dbr['datetime'] . " oleh " . $dbr['username'] ;
			$vs['tgl'] = date_2d($vs['tgl']) ;
			$vs['dpokok'] = string_2s($dbr['dpokok'],2) ;
			$vs['kpokok'] = string_2s($dbr['kpokok'],2) ;
			$vs['dbunga'] = string_2s($dbr['dbunga'],2) ;
			$vs['kbunga'] = string_2s($dbr['kbunga'],2) ;
			$vs['denda'] = string_2s($dbr['denda'],2) ;
			$vs['dtitipan'] = string_2s($dbr['dtitipan'],2) ;
			$vs['ktitipan'] = string_2s($dbr['ktitipan'],2) ;
			$vare[]		= $vs ;
		} 

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "sstrkreditangsuran_id", "") ;
	}  

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "sstrkreditangsuran_id") ;
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
		echo(' bos.trkreditangsuran.settab(0) ;  bos.trkreditangsuran.init() ;') ;
	}

	public function deleting(){
		$va 	= $this->input->post() ; 
		$id 	= $va['id'] ;
		$this->bdb->delete("kredit_rekening", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.trkreditangsuran.grid1_reload() ; ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "sstrkreditangsuran_id", $d['id']) ; 
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
			
			$datakredit = $this->kredit_m->getdata_kredit($d['rekening']) ; 
			$datakredit['lama'] .= " Bulan" ; 
			$keterangan = "Angsuran ke 1 " . " [".$d['rekening']."] an. " . $nama ;
			$total_angsuran = $datakredit['kpokok'] + $datakredit['kbunga'] ; 

			echo('   
				with(bos.trkreditangsuran.obj){
					find("#tgl").val("'.$d['tgl'].'") ;
					find("#rekening").val("'.$d['rekening'].'") ;   
					find("#s_rekening").val("'.$d['rekening'].'") ;
					find("#nama").val("'.$nama.'") ;
					find("#alamat").val("'.$alamat.'") ;
					find("#telepon").val("'.$telepon.'") ;
					find("#tgl_realisasi").val("'.$datakredit['tgl'].'") ;
					find("#lama").val("   '.$datakredit['lama'].'") ;
					find("#jthtmp").val("'.$datakredit['jthtmp'].'") ;
					find("#bakidebet_awal").val("'.string_2s($datakredit['bakidebet']).'") ;
					find("#kpokok").val("'.string_2s($datakredit['kpokok']).'") ;
					find("#kbunga").val("'.string_2s($datakredit['kbunga']).'") ;
					find("#total_angsuran").val("'.string_2s($total_angsuran).'") ;		
					find("#keterangan").val("'.$keterangan.'") ;

					find("#foto").html("'.$image.'") ;
				}
				bos.trkreditangsuran.grid1_reloaddata() ;
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
				bos.trkreditangsuran.obj.find("#idlimage").html("") ;
			') ;
		}else{
			$data 	= $this->upload->data() ;
			$tname 	= str_replace($data['file_ext'], "", $data['client_name']) ;
			$vimage	= array( $tname => $data['full_path']) ;
			savesession($this, "sspelanggan_image", json_encode($vimage) ) ;  

			echo('
				bos.trkreditangsuran.obj.find("#idlimage").html("") ;
				bos.trkreditangsuran.obj.find("#idimage").html("<img src=\"'.base_url("./tmp/" . $data['client_name'] . "?time=". time()).'\" class=\"img-responsive\" />") ;
			') ;
		}
	}

	public function loadgrid3(){
		$va     = json_decode($this->input->post('request'), true) ;
		$vare   = array() ; 
		$vdb    = $this->kredit_m->loadgrid_rekening($va) ; 
		$dbd    = $vdb['db'] ;
		while( $dbr = $this->trkreditangsuran_m->getrow($dbd) ){
				$vaset   = $dbr ;
				$vaset['cmdpilih']    = '<button type="button" onClick="bos.trkreditangsuran.cmdpilih(\''.$dbr['rekening'].'\')"
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
		$data = $this->kredit_m->getdata_rekening($kode) ; 
		if(!empty($data)){
			$this->ltrue = false ;
			echo(' 
				bjs.ajax(bos.trkreditangsuran.url + "/editing", "id=" + ' . $data['id'] . '); 
				with(bos.trkreditangsuran.obj){
					find("#rekening").val("'.$data['rekening'].'") ; 
					find("#keterangan").focus() ;     
				}
				bos.trkreditangsuran.loadmodelstock("hide");
			') ;
		}
	}

}
?>
