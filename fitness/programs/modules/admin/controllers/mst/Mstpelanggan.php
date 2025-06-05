<?php
class Mstpelanggan extends Bismillah_Controller{ 
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->helper("bdate") ;
		$this->load->helper("toko") ; 
		$this->load->helper("qrlib") ;  
		$this->load->model("mst/mstpelanggan_m") ;
		$this->bdb 	= $this->mstpelanggan_m ;
	} 

	public function index(){ 
		$this->load->view("mst/mstpelanggan") ;

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
				$vs['cmdedit']    = '<button type="button" onClick="bos.mstpelanggan.cmdedit(\''.$dbr['id'].'\')"
													class="btn btn-default btn-grid">Koreksi</button>' ;
				$vs['cmdedit']	   = html_entity_decode($vs['cmdedit']) ;

				$vs['cmddelete']  = '<button type="button" onClick="bos.mstpelanggan.cmddelete(\''.$dbr['id'].'\')"
													class="btn btn-danger btn-grid">Hapus</button>' ;
				$vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;

				$vs['cmdcetak']  = '<button type="button" onClick="bos.mstpelanggan.cmdcetak(\''.$dbr['id'].'\')"
													class="btn btn-primary btn-grid">Cetak</button>' ;
				$vs['cmdcetak']  = html_entity_decode($vs['cmdcetak']) ;
			
				$vs['cmdcetakqr']  = '<button type="button" onClick="bos.mstpelanggan.cmdcetakqr(\''.$dbr['id'].'\')"
													class="btn btn-success btn-grid"><b>QR<b></button>' ;
				$vs['cmdcetakqr']  = html_entity_decode($vs['cmdcetakqr']) ;
 				$vare[]		= $vs ;
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
		savesession($this, "ssmstpelanggan_id", "") ;
		$kode 	= $this->bdb->getkode(false) ;
		echo('
			bos.mstpelanggan.obj.find("#kode").html("'.$kode.'") ;
		') ;
	}

	public function saving(){
		$va 	= $this->input->post() ;
		$id 	= getsession($this, "ssmstpelanggan_id") ;
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
		echo(' bos.mstpelanggan.settab(0) ;  ') ;
	}

	public function deleting(){
		$va 	= $this->input->post() ; 
		$id 	= $va['id'] ;
		$this->bdb->delete("pelanggan", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.mstpelanggan.grid1_reload() ; ') ;
	}

	public function editing(){
		$va 	= $this->input->post() ;
		if($d = $this->bdb->editing($va['id'])){
			savesession($this, "ssmstpelanggan_id", $d['id']) ; 
			$d['tgllahir'] 	= date("d-m-Y", strtotime($d['tgllahir'])) ;
			$d['tgl'] 	= date("d-m-Y", strtotime($d['tgl'])) ;   
			$image = '<img src=\"./uploads/no-image.png\" class=\"img-responsive\"/><br>' ; ;
			if(!empty($d['data_var'])){      
				$image 	= '<img src=\"'.base_url($d['data_var']).'\" class=\"img-responsive\"/><br>' ;
				$image 	.= str_replace("./uploads/pelanggan/", "~/",$d['data_var']) ;
			}
			echo('   
				bos.mstpelanggan.obj.find("#kode").html("'.$d['kode'].'") ;
				bos.mstpelanggan.obj.find("#kodefinger").val("'.$d['kodefinger'].'") ;
				bos.mstpelanggan.obj.find("#tgl").val("'.$d['tgl'].'") ;
				bos.mstpelanggan.obj.find("#nama").val("'.$d['nama'].'") ;
				bos.mstpelanggan.obj.find("#alamat").val("'.$d['alamat'].'") ;
				bos.mstpelanggan.obj.find("#telepon").val("'.$d['telepon'].'") ;
				bos.mstpelanggan.obj.find("#email").val("'.$d['email'].'") ;
				bos.mstpelanggan.obj.find("#tempatlahir").val("'.$d['tempatlahir'].'") ;
				bos.mstpelanggan.obj.find("#jeniskelamin").val("'.$d['jeniskelamin'].'") ;
				bos.mstpelanggan.obj.find("#tgllahir").val("'.$d['tgllahir'].'") ;
				bos.mstpelanggan.obj.find("#statuspelanggan").val("'.$d['statuspelanggan'].'") ; 
				bos.mstpelanggan.obj.find("#foto").html("'.$image.'") ;
				bos.mstpelanggan.settab(1) ;
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

	 public function cetakqr(){
			extract($_GET) ;	
			$vaData = $this->bdb->getpelanggan($id) ;

			// isi qrcode yang ingin dibuat. akan muncul saat di scan
			$isi = $vaData['kode'] ;        
			ob_start("callback");
      $debugLog = ob_get_contents();
      ob_end_clean();

			$filepath = "./tmp/qrcode.png" ;
			$logopath = "./uploads/logo.png" ; 
			
			QRcode::png($isi,$filepath,QR_ECLEVEL_H, 8,2,true);     
			
			/*$QR = imagecreatefrompng($filepath);

			// START TO DRAW THE IMAGE ON THE QR CODE
			$logo = imagecreatefromstring(file_get_contents($logopath));
			$QR_width = imagesx($QR);
			$QR_height = imagesy($QR);

			$logo_width = imagesx($logo);
			$logo_height = imagesy($logo);

			// Scale logo to fit in the QR Code
			$logo_qr_width = $QR_width/3;
			$scale = $logo_width/$logo_qr_width;
			$logo_qr_height = $logo_height/$scale;

			imagecopyresampled($QR, $logo, $QR_width/3, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

			// Save QR code again, but with logo on it
			imagepng($QR,$filepath);
			// outputs image directly into browser, as PNG stream
			//readfile($filepath);*/

			$this->kartumember($vaData); 
   }


	 public function kartumember($va){
		//print_r($va);
		echo('
			
			<!DOCTYPE html>
				<html lang="en">
				<head>
				<meta charset="UTF-8" />
				<meta name="viewport" content="width=device-width, initial-scale=1" />
				<title>Member Card with QR Code</title>  
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.esm.js"></script>
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.js"></script>
				<script>
					function cetakimg(id){
						idcard = "idcard_" + id + ".png" ;
						html2canvas(document.getElementById("photo")).then(function(canvas){
									downloadImage(canvas.toDataURL(),idcard);
						});
   				}

					function downloadImage(uri, filename){
						var link = document.createElement("a");
						if(typeof link.download !== "string"){
									window.open(uri);
						}
						else{
							link.href = uri;
							link.download = filename;
							accountForFirefox(clickLink, link);
						}
						}

						function clickLink(link){
							link.click();
						}

						function accountForFirefox(click){
							var link = arguments[1];
							document.body.appendChild(link);
							click(link);
							document.body.removeChild(link);
						}
				</script>
				<style>
					@import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap");
					body {
						margin:0;
						background: linear-gradient(135deg, #667eea, #764ba2);
						font-family: Montserrat, sans-serif;
						display: flex;
						height: 100vh;
						justify-content: center;
						align-items: center;
						color: #fff;
					}

					#photo{
						background: #fff
	 				}

					.card {
						background: white;
						color: #2c2c2c;
						width: 350px;
						border-radius: 10px;
						box-shadow: 0 12px 30px rgba(0,0,0,0.3);
						overflow: hidden;
						display: flex;
						flex-direction: column;
						align-items: center;
						padding: 24px 24px 32px 24px;
					}

					.avatar {
						width: 140px;
						height: 140px;
						border-radius: 50%;
						overflow: hidden;
						margin-bottom: 16px;
						box-shadow: 0 6px 15px rgba(102,126,234,.5);
					}

					.avatar img {
						width: 100%;
						height: 100%;
						object-fit: cover;
					}

					.member-info {
						text-align: center;
						margin-bottom: 24px;
					}

					.member-name {
						font-size: 1.5rem;
						font-weight: 700;
						margin-bottom: 6px;
					}

					.member-id {
						font-size: 1rem;
						color: #666;
						margin-bottom: 8px;
					}

					.membership-type {
						font-size: 1rem;
						font-weight: 600;
						color: #444;
						padding: 6px 12px;
						border-radius: 12px;
						background: #667eea;
						display: inline-block;
						box-shadow: 0 2px 6px rgba(102,126,234,0.5);
					}

					.btn-block {
							display: block;
							width: 100%;
					}
					.btn-primary {
							color: #fff;
							background-color: #337ab7;
							border-color: #2e6da4;
					}
					.btn {
							display: inline-block;
							padding: 6px 12px;
							margin-bottom: 0;
							font-size: 14px;
							font-weight: 400;
							line-height: 1.42857143;
							text-align: center;
							white-space: nowrap;
							vertical-align: middle;
							-ms-touch-action: manipulation;
							touch-action: manipulation;
							cursor: pointer;
							-webkit-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
							background-image: none;
							border: 1px solid transparent;
							border-radius: 4px;
					}
							
					/* QR Code container */
					#qrcode {
						margin-top: 2px; 
						width: 200px;
						height: 200px;
					}
				</style>
				</head>
				<body>
					
					<div id="photo" class="card" aria-label="Member Card">
						<div>
							<b>MEMBER CARD</b>
						</div>
						<div>
							<b>SYANJAYA FITNESS</b>
						</div>
						
						<div style="margin-top:14px" class="avatar" aria-label="Member Avatar">
							<img src="../../.'.$va['data_var'].'" alt="Member photo" />
						</div>
						<div class="member-info">
							<div class="member-name" id="memberName">'.strtoupper($va['nama']).'</div>
							<div class="membership-type" id="membershipType">'.statuspelanggan($va['statuspelanggan']).'</div>
						</div>

						<div>
							<div class="member-id" id="memberId"><b>ID: '.$va['kode'].'</b></div>
						</div>

						<div aria-label="Member QR Code">
							<img  id="qrcode" src="../../../tmp/qrcode.png" alt="QRCode"> 
						</div>					

					</div>

					<div>
						<button class="cta-button" onclick="cetakimg('.$va['kode'].')">Cetak</button>
					</div>
  			</body>



				</html>


		');
	 }

   public function saving_image(){   
		$fcfg	= array("upload_path"=>"./tmp/", "allowed_types"=>"jpg|jpeg|png", "overwrite"=>true) ;

		savesession($this, "sspelanggan_image", "") ;   
		$this->load->library('upload', $fcfg) ;
		if ( ! $this->upload->do_upload(0) ){
			echo('
				alert("'. $this->upload->display_errors('','') .'") ;
				bos.mstpelanggan.obj.find("#idlimage").html("") ;
			') ;
		}else{
			$data 	= $this->upload->data() ;
			$tname 	= str_replace($data['file_ext'], "", $data['client_name']) ;
			$vimage	= array( $tname => $data['full_path']) ;
			savesession($this, "sspelanggan_image", json_encode($vimage) ) ;  

			echo('
				bos.mstpelanggan.obj.find("#idlimage").html("") ;
				bos.mstpelanggan.obj.find("#idimage").html("<img src=\"'.base_url("./tmp/" . $data['client_name'] . "?time=". time()).'\" class=\"img-responsive\" />") ;
			') ;
		}
	}

}
?>
