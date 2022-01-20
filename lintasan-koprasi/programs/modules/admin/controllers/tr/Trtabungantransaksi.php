<?php
class Trtabungantransaksi extends Bismillah_Controller{
  protected $bdb ;
  public function __construct(){ 
    parent::__construct() ; 
    $this->load->model("tr/trtabungantransaksi_m") ;
    $this->load->model("func/tabungan_m") ; 
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
      $saldoakhir = 0 ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         ++$n ;
         $vs = $dbr;
         $vs['no'] = $n ;
         $vs['tgl'] = date_2d($vs['tgl']) ;
         $vs['datetime'] = $dbr['datetime'] . " oleh " . $dbr['username'] ;
         
         $saldoakhir += $dbr['kredit'] - $dbr['debet'] ;
         
         $vs['debet'] = string_2s($dbr['debet']) ;
         $vs['kredit'] = string_2s($dbr['kredit']) ;

         $vs['saldoakhir'] = string_2s($saldoakhir) ;
         
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
  
  public function saving(){
    $va   = $this->input->post() ;
    $id   = getsession($this, "sstrtabungantransaksi_id") ;
    $true   = true ;
    if($va['jumlah'] == 0){ 
      $true = false ;
    }
    if($true){
      $this->bdb->saving($va, $id) ;  
      echo('   
        bos.trtabungantransaksi.grid1_reloaddata();
        bos.trtabungantransaksi.init(); 
      ')  ;
    }else{
      echo('   
        alert("Maaf,Jumlah tidak boleh nol...");
      ')  ;
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
        bos.trtabungantransaksi.grid1_reloaddata();
		  ') ;
      $this->seekrekening() ;
		}
	}	

  public function seekrekening(){
    $va   = $this->input->post() ; 
    $value   = $this->bdb->seekrekening($va) ;  
    $image = '<img src=\"./uploads/no-image.png\" class=\"img-responsive\"/><br>' ; ;
    if(!empty($value['data_var'])){
      $image   = '<img height=\"40px\" src=\"'.base_url($value['data_var']).'\" class=\"img-responsive\"/><br>' ;
      $image   .= str_replace("./uploads/pelanggan/", "~/",$value['data_var']) ;
    }
    if(!empty($value)){
      echo('   
        with(bos.trtabungantransaksi.obj){
          find("#nama").val("'.$value['nama'].'") ;
          find("#alamat").val("'.$value['alamat'].'") ;
          find("#telepon").val("'.$value['telepon'].'") ;  
          bos.trtabungantransaksi.obj.find("#foto").html("'.$image.'") ;
        }      
      ')  ;
    }
  } 

  public function seekketerangan(){
    $va   = $this->input->post() ; 
    $value   = $this->bdb->seekketerangan($va) ;  
    if(!empty($value)){
      echo('   
        bos.trtabungantransaksi.obj.find("#keterangan").val("'.$value['keterangan'].'") ;      
      ')  ;
    }
  } 

}
?>
