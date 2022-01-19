<?php
class Trtabungantransaksi extends Bismillah_Controller{
  protected $bdb ;
  public function __construct(){ 
    parent::__construct() ; 
    $this->load->model("tr/trtabungantransaksi_m") ;
    $this->bdb   = $this->trtabungantransaksi_m ;
  }
 
  public function index(){
    $this->load->view("tr/trtabungantransaksi") ;  

  }   

  public function loadgrid(){
    $va     = json_decode($this->input->post('request'), true) ; 
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      $n = 0 ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         ++$n ;
         $vs = $dbr;
         $vs['no'] = $n ;
         $vs['tgl'] = date_2d($vs['tgl']) ;
         $vs['jumlah'] = $vs['pendaftaran'] + $vs['iuran'] + $vs['sewagedung'] + $vs['suplemen'] + $vs['lainnya'] ;
         $vs['jumlah'] = string_2s($vs['jumlah']) ; 
         $vs['cmdedit']    = '<button type="button" onClick="bos.trtabungantransaksi.cmdedit(\''.$dbr['id'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
         $vs['cmdedit']     = html_entity_decode($vs['cmdedit']) ;

         $vare[]    = $vs ;
      }

      $vare   = array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ; 
  }

  public function init(){
    savesession($this, "sstrtabungantransaksi_id", "") ; 
    $kode   = $this->bdb->getfaktur(false) ; 
    echo('
      bos.trtabungantransaksi.obj.find("#faktur").html("'.$kode.'") ;
    ') ;
  }

  public function seekpel(){
    $va   = $this->input->post() ;
    $value   = $this->bdb->stpelanggan($va) ;  
    $tarif  = $this->bdb->seektarif($value['statuspelanggan']) ;  
    if($value['total'] > 0) $tarif['pendaftaran'] = 0 ;
    $image = '<img src=\"./uploads/no-image.png\" class=\"img-responsive\"/><br>' ; ;
    if(!empty($value['data_var'])){
      $image   = '<img height=\"40px\" src=\"'.base_url($value['data_var']).'\" class=\"img-responsive\"/><br>' ;
      $image   .= str_replace("./uploads/pelanggan/", "~/",$value['data_var']) ;
    }
    echo('   
      bos.trtabungantransaksi.obj.find("#kode").html("'.$value['kode'].'") ;
      bos.trtabungantransaksi.obj.find("#nama").html("'.$value['nama'].'") ;
      bos.trtabungantransaksi.obj.find("#alamat").html("'.$value['alamat'].'") ;
      bos.trtabungantransaksi.obj.find("#telepon").html("'.$value['telepon'].'") ;
      bos.trtabungantransaksi.obj.find("#email").html("'.$value['email'].'") ;
      bos.trtabungantransaksi.obj.find("#status").html("'.$value['statuspelanggan'].'") ;
      bos.trtabungantransaksi.obj.find("#pendaftaran").val("'.$tarif['pendaftaran'].'") ;
      bos.trtabungantransaksi.obj.find("#iuran").val("'.$tarif['iuran'].'") ;  
      bos.trtabungantransaksi.obj.find("#foto").html("'.$image.'") ;
      bos.trtabungantransaksi.grid1_reloaddata();
    ')  ;
  }

  public function seekpelauto(){
    $va   = $this->input->post() ;
    $value   = $this->bdb->seekauto($va) ;       
    $image = '<img src=\"./uploads/no-image.png\" class=\"img-responsive\"/><br>' ; ;
    if(!empty($value['data_var'])){ 
      $image   = '<img src=\"'.base_url($value['data_var']).'\" class=\"img-responsive\"/><br>' ;
      $image   .= str_replace("./uploads/pelanggan/", "~/",$value['data_var']) ;
    }

    if($value['true'] == 1){
      echo('   
        bos.trtabungantransaksi.obj.find("#kode").html("'.$value['kode'].'") ;
        bos.trtabungantransaksi.obj.find("#nama").html("'.$value['nama'].'") ;
        bos.trtabungantransaksi.obj.find("#alamat").html("'.$value['alamat'].'") ;
        bos.trtabungantransaksi.obj.find("#telepon").html("'.$value['telepon'].'") ;
        bos.trtabungantransaksi.obj.find("#email").html("'.$value['email'].'") ;
        bos.trtabungantransaksi.obj.find("#status").html("'.$value['statuspelanggan'].'") ;
        bos.trtabungantransaksi.obj.find("#foto").html("'.$image.'") ; 
        bos.trtabungantransaksi.obj.find("#pelanggan2").val("'.$value['pelanggan'].'") ;             
        bos.trtabungantransaksi.grid1_reloaddata(); 
      ')  ;
    }else{
      echo('
        bos.trtabungantransaksi.obj.find("#pelanggan2").val("") ; 
      ');
        
    }
  }

  
  public function saving(){
    $va   = $this->input->post() ;
    $id   = getsession($this, "sstrtabungantransaksi_id") ;
    $true   = true ;
    if($va['pendaftaran'] == 0 and $va['iuran'] == 0 and $va['sewagedung'] == 0 
        and $va['suplemen'] == 0 and $va['lainnya'] == 0){
      $true = false ;
    }
    if($true){
      $this->bdb->saving($va, $id) ;  
      echo('   
        bos.trtabungantransaksi.grid1_reloaddata();
        bos.trtabungantransaksi.init();
        alert("Transaksi Berhasil Disimpan...") ;  
      ')  ;
    }else{
      echo('   
        alert("Maaf,Nominal tidak boleh nol...");
      ')  ;
    }
  }

  public function editing(){
    $va   = $this->input->post() ;
    if($d = $this->bdb->editing($va['id'])){
      savesession($this, "sstrtabungantransaksi_id", $d['id']) ;
      echo('
        bos.trtabungantransaksi.obj.find("#kode").val("'.$d['kode'].'") ; 
        bos.trtabungantransaksi.obj.find("#keterangan").val("'.$d['keterangan'].'") ;
        bos.trtabungantransaksi.obj.find("#tgl").val("'.date_2d($d['tgl']).'") ;
        bos.trtabungantransaksi.obj.find("#jumlah").val("'.$d['jumlah'].'") ;
        bos.trtabungantransaksi.settab(1) ;
      ') ;
    }
  } 

	public function loadgrid3(){
		$va     = json_decode($this->input->post('request'), true) ;
		$vare   = array() ;
		$vdb    = $this->trtabungantransaksi_m->loadgrid3($va) ;
		$dbd    = $vdb['db'] ;
		while( $dbr = $this->trtabungantransaksi_m->getrow($dbd) ){
				$vaset   = $dbr ;
				$vaset['cmdpilih']    = '<button type="button" onClick="bos.trtabungantransaksi.cmdpilih(\''.$dbr['rekening'].'\')"
											 class="btn btn-success btn-grid">Pilih</button>' ;
				$vaset['cmdpilih']     = html_entity_decode($vaset['cmdpilih']) ;
				$vare[]    = $vaset ; 
		}

		$vare   = array("total"=>$vdb['rows'], "records"=>$vare ) ;
		echo(json_encode($vare)) ;
	}

	public function pilih(){
		$va   = $this->input->post() ;
		$rekening   = $va['rekening'] ; 
		$data = $this->trtabungantransaksi_m->getdata($rekening) ;
		if(!empty($data)){
				echo('
				with(bos.trtabungantransaksi.obj){
					find("#rekening").val("'.$data['rekening'].'") ; 
					find("#kode_transaksi").focus() ; 
				}
				bos.trtabungantransaksi.loadmodelstock("hide");
		 ') ;
		}
	}	

}
?>
