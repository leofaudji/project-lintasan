<?php
class Rptabsensi extends Bismillah_Controller{
  protected $bdb ; 
  public function __construct(){
    parent::__construct() ;
    $this->load->helper("bdate") ;
    $this->load->helper("toko") ; 
    $this->load->model("mst/rptabsensi_m") ;
    $this->bdb   = $this->rptabsensi_m ;
  }

  public function index(){
    $this->load->view("mst/rptabsensi") ;
 
  }  

  public function loadgrid(){
    $va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      $n = 0 ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;  
     $vs['kode'] = $vs['pelanggan'] ;
     $vs['status'] = $vs['statuspelanggan'] ;
     $vs['no']   = ++$n ;
     //$vs['statuspelanggan'] = statuspelanggan($vs['statuspelanggan']) ;
         /*$vs['cmdedit']    = '<button type="button" onClick="bos.rptabsensi.cmdedit(\''.$dbr['id'].'\')"
                           class="btn btn-default btn-grid">Bayar</button>' ; 
         $vs['cmdedit']     = html_entity_decode($vs['cmdedit']) ; */
         $bom = $va['tglakhir'] ;   
         $eom = $va['tglakhir'] ;   
         $vs['keterangan2'] = $vs['keterangan'] ; 
         $vs['keterangan'] = html_entity_decode($this->bdb->databayar($vs['tglbuka'],$vs['pelanggan'],$bom,$eom,$vs['statuspelanggan'])) ; 
         $vare[]    = $vs ;
         unset($vs['id']) ; 
          unset($vs['tgl']) ; 
          unset($vs['jam']) ;    
          unset($vs['tglabsen']) ;    
          unset($vs['jam']) ;    
          unset($vs['mode']) ;    
          unset($vs['pin']) ;    
          unset($vs['cabang']) ;    
          //unset($vs['keterangan']) ;    
          unset($vs['status']) ;
          unset($vs['pelanggan']) ;     
          $varpt[]  = $vs ;
      }

      $vare   = array("total"=>$vdb['rows'], "records"=>$varpt ) ;
      //$varpt = $vare['records'] ;      
      echo(json_encode($vare)) ;
      savesession($this, "rptabsensi_rpt", json_encode($varpt)) ; 
  }

  public function init(){
    savesession($this, "ssrptabsensi_id", "") ;
    $kode   = $this->bdb->getkode(false) ; 
  }

  public function saving(){
    $va   = $this->input->post() ;
    $id   = getsession($this, "ssrptabsensi_id") ;
    $this->bdb->saving($va, $id) ;   
    echo('
      bos.rptabsensi.grid1_reloaddata() ; 
    ');
  }
  
  public function editing(){
    $va   = $this->input->post() ;
    if($d = $this->bdb->editing($va['id'])){
      savesession($this, "ssrptabsensi_id", $d['id']) ; 
      $d['tgllahir']   = date("d-m-Y", strtotime($d['tgllahir'])) ;
      $d['tgl']   = date("d-m-Y", strtotime($d['tgl'])) ;
      echo('  
        bos.rptabsensi.obj.find("#kode").html("'.$d['kode'].'") ;
        bos.rptabsensi.obj.find("#kodefinger").html("'.$d['kodefinger'].'") ;
        bos.rptabsensi.obj.find("#tgl").val("'.$d['tgl'].'") ;
        bos.rptabsensi.obj.find("#nama").val("'.$d['nama'].'") ;
        bos.rptabsensi.obj.find("#alamat").val("'.$d['alamat'].'") ;
        bos.rptabsensi.obj.find("#telepon").val("'.$d['telepon'].'") ;
        bos.rptabsensi.obj.find("#email").val("'.$d['email'].'") ;
        bos.rptabsensi.obj.find("#tempatlahir").val("'.$d['tempatlahir'].'") ;
        bos.rptabsensi.obj.find("#jeniskelamin").val("'.$d['jeniskelamin'].'") ;
        bos.rptabsensi.obj.find("#tgllahir").val("'.$d['tgllahir'].'") ;
        bos.rptabsensi.obj.find("#statuspelanggan").val("'.$d['statuspelanggan'].'") ;
        bos.rptabsensi.settab(1) ;
      ') ;
    }
  }

  public function showreport(){
      $data = getsession($this,"rptabsensi_rpt") ;     
      $data = json_decode($data,true) ;   
      if(!empty($data)){ 
        foreach($data as $key=>$value){           
          $data[$key] = array("no"=>$value['no'],
                              "datetime"=>$value['datetime'],
                              "kode"=>$value['kode'],
                              "nama"=>$value['nama'],
                              "alamat"=>$value['alamat'],
                              "telepon"=>$value['telepon'],
                              "statuspelanggan"=>$value['statuspelanggan'],
                              "keterangan"=>$value['keterangan']) ;
        } 
        //print_r($data) ; 
        
        $font = 8 ;
        $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'DaftarKunjungan_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>DAFTAR KUNJUNGAN HARIAN</b>",$font+4,array("justification"=>"center")) ;
        $this->bospdf->ezText("") ;
        $this->bospdf->ezTable($data,"","",
                array("fontSize"=>$font,"cols"=> array("No"=>array("width"=>15,"wrap"=>1),
                           "no"=>array("caption"=>"No","width"=>5,"justification"=>"right"),
                           "datetime"=>array("caption"=>"DateTime","justification"=>"center","width"=>16),
                           "kode"=>array("caption"=>"Kode","width"=>10,"justification"=>"center"),
                           "nama"=>array("caption"=>"Nama","wrap"=>1), 
                           "alamat"=>array("caption"=>"Alamat","wrap"=>1), 
                           "telepon"=>array("caption"=>"Telepon","width"=>16,"wrap"=>1), 
                           "keterangan"=>array("caption"=>"Keterangan","width"=>10,"wrap"=>1), 
                            "statuspelanggan"=>array("caption"=>"Status","width"=>8)))) ; 
         
        $this->bospdf->ezStream() ; 
      }else{
         echo('data kosong') ;
      }
   }

}
?>
