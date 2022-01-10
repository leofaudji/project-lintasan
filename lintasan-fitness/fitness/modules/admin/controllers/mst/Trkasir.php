<?php
class Trkasir extends Bismillah_Controller{
  protected $bdb ;
  public function __construct(){ 
    parent::__construct() ;
    $this->load->model("mst/trkasir_m") ;
    $this->bdb   = $this->trkasir_m ;
  }
 
  public function index(){
    $this->load->view("mst/trkasir") ; 

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
         $vs['cmdedit']    = '<button type="button" onClick="bos.trkasir.cmdedit(\''.$dbr['id'].'\')"
                           class="btn btn-default btn-grid">Koreksi</button>' ;
         $vs['cmdedit']     = html_entity_decode($vs['cmdedit']) ;

         $vare[]    = $vs ;
      }

      $vare   = array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ; 
  }

  public function init(){
    savesession($this, "sstrkasir_id", "") ; 
    $kode   = $this->bdb->getfaktur(false) ; 
    echo('
      bos.trkasir.obj.find("#faktur").html("'.$kode.'") ;
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
      bos.trkasir.obj.find("#kode").html("'.$value['kode'].'") ;
      bos.trkasir.obj.find("#nama").html("'.$value['nama'].'") ;
      bos.trkasir.obj.find("#alamat").html("'.$value['alamat'].'") ;
      bos.trkasir.obj.find("#telepon").html("'.$value['telepon'].'") ;
      bos.trkasir.obj.find("#email").html("'.$value['email'].'") ;
      bos.trkasir.obj.find("#status").html("'.$value['statuspelanggan'].'") ;
      bos.trkasir.obj.find("#pendaftaran").val("'.$tarif['pendaftaran'].'") ;
      bos.trkasir.obj.find("#iuran").val("'.$tarif['iuran'].'") ;  
      bos.trkasir.obj.find("#foto").html("'.$image.'") ;
      bos.trkasir.grid1_reloaddata();
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
        bos.trkasir.obj.find("#kode").html("'.$value['kode'].'") ;
        bos.trkasir.obj.find("#nama").html("'.$value['nama'].'") ;
        bos.trkasir.obj.find("#alamat").html("'.$value['alamat'].'") ;
        bos.trkasir.obj.find("#telepon").html("'.$value['telepon'].'") ;
        bos.trkasir.obj.find("#email").html("'.$value['email'].'") ;
        bos.trkasir.obj.find("#status").html("'.$value['statuspelanggan'].'") ;
        bos.trkasir.obj.find("#foto").html("'.$image.'") ; 
        bos.trkasir.obj.find("#pelanggan2").val("'.$value['pelanggan'].'") ;             
        bos.trkasir.grid1_reloaddata(); 
      ')  ;
    }else{
      echo('
        bos.trkasir.obj.find("#pelanggan2").val("") ; 
      ');
        
    }
  }

  
  public function saving(){
    $va   = $this->input->post() ;
    $id   = getsession($this, "sstrkasir_id") ;
    $true   = true ;
    if($va['pendaftaran'] == 0 and $va['iuran'] == 0 and $va['sewagedung'] == 0 
        and $va['suplemen'] == 0 and $va['lainnya'] == 0){
      $true = false ;
    }
    if($true){
      $this->bdb->saving($va, $id) ;  
      echo('   
        bos.trkasir.grid1_reloaddata();
        bos.trkasir.init();
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
      savesession($this, "sstrkasir_id", $d['id']) ;
      echo('
        bos.trkasir.obj.find("#kode").val("'.$d['kode'].'") ; 
        bos.trkasir.obj.find("#keterangan").val("'.$d['keterangan'].'") ;
        bos.trkasir.obj.find("#tgl").val("'.date_2d($d['tgl']).'") ;
        bos.trkasir.obj.find("#jumlah").val("'.$d['jumlah'].'") ;
        bos.trkasir.settab(1) ;
      ') ;
    }
  } 

}
?>
