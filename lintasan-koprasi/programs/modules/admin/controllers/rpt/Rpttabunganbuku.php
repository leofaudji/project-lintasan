<?php
class Rpttabunganbuku extends Bismillah_Controller{ 
  protected $bdb ; 
  public function __construct(){ 
    parent::__construct() ;
    $this->load->model("rpt/rpttabunganbuku_m") ;
    $this->load->model("func/tabungan_m") ; 
    $this->bdb   = $this->rpttabunganbuku_m ;
  }  
 
  public function index(){
    $this->load->view("rpt/rpttabunganbuku") ; 

  }  

  public function loadgrid(){
    $va     = json_decode($this->input->post('request'), true) ; 
    $vare   = array() ; 
    $varpt  = array() ;
    $vdb    = $this->bdb->loadgrid($va) ;
    $dbd    = $vdb['db'] ; 
    $n = 0 ;
    $saldoakhir = 0 ;
    while( $dbr = $this->bdb->getrow($dbd) ){ 
      $vs = $dbr ;
      $vs['tgl'] = date_2d($vs['tgl']);
      $vs['datetime']  = $dbr['datetime'] . " oleh " . $dbr['username'] ;
      $saldoakhir += $dbr['kredit'] - $dbr['debet'] ; 
      $vs['saldoakhir'] = string_2s($saldoakhir) ;
      $vs['debet'] = string_2s($vs['debet']) ;
      $vs['kredit'] = string_2s($vs['kredit']) ;
      $vs['no'] = ++$n ;
      unset($vs['id']) ;  
      $vare[]    = $vs ;
      unset($vs['cmdcetak']) ;       
      $varpt[]  = $vs ;
      
    }

      $vare   = array("total"=>$vdb['rows'], "records"=>$vare ) ;
      //$varpt = $vare['records'] ;
      echo(json_encode($vare)) ; 
      savesession($this, "rpttabunganbuku_rpt", json_encode($varpt)) ;   
  }

  public function init(){
    savesession($this, "ssrpttabunganbuku_id", "") ;     
  } 

  public function loadgrid3(){
		$va     = json_decode($this->input->post('request'), true) ;
		$vare   = array() ;
		$vdb    = $this->tabungan_m->loadgrid_rekening($va) ;
		$dbd    = $vdb['db'] ;
		while( $dbr = $this->rpttabunganbuku_m->getrow($dbd) ){
				$vaset   = $dbr ;
				$vaset['cmdpilih']    = '<button type="button" onClick="bos.rpttabunganbuku.cmdpilih(\''.$dbr['rekening'].'\')"
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
		$data = $this->tabungan_m->getdata_rekening($rekening) ;
		if(!empty($data)){
		  echo('
				with(bos.rpttabunganbuku.obj){
					find("#rekening").val("'.$data['rekening'].'") ; 
					find("#kode_transaksi").focus() ; 
				}
				bos.rpttabunganbuku.loadmodelstock("hide");
        bos.rpttabunganbuku.grid1_reloaddata();
		  ') ;
    }
	}	


  public function showreport(){
      $data = getsession($this,"rpttabunganbuku_rpt") ;     
      $data = json_decode($data,true) ;    
      if(!empty($data)){ 
        $font = 8 ;
        $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'DaftarKunjungan_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>DAFTAR KUNJUNGAN HARIAN</b>",$font+4,array("justification"=>"center")) ;
    $this->bospdf->ezText("") ;
    $this->bospdf->ezTable($data,"","",
                array("fontSize"=>$font,"cols"=> array("No"=>array("width"=>15,"wrap"=>1),
                           "no"=>array("caption"=>"No","width"=>5,"justification"=>"right"),
                           "kode"=>array("caption"=>"Kode","width"=>10),
                           "tgl"=>array("caption"=>"Tgl","width"=>10,"justification"=>"center"),
                           "nama"=>array("caption"=>"Nama","width"=>16,"wrap"=>1), 
                           "pendaftaran"=>array("caption"=>"Nominal;Pendaftaran","width"=>12,"wrap"=>1,"justification"=>"right"),
                           "iuran"=>array("caption"=>"Nominal;Iuran","width"=>12,"justification"=>"right"),
                           "sewagedung"=>array("caption"=>"Nominal;Sewa Gedung","width"=>12,"justification"=>"right"),
                           "suplemen"=>array("caption"=>"Nominal;Suplemen","width"=>12,"justification"=>"right"),
                          "username"=>array("caption"=>"Username","width"=>8)))) ; 
        //print_r($data) ; 
        $this->bospdf->ezStream() ;
      }else{
         echo('data kosong') ;
      }
   }

   public function printreport(){
    extract($_GET) ;  
        $font = 8 ;
        $username = getsession($this,"username") ; 
        $vaData = $this->bdb->getmutasi($faktur) ;
        $nNominal = $vaData['pendaftaran'] + $vaData['iuran'] + $vaData['sewagedung'] + $vaData['suplemen'] ;  
        $data[0] = array("kode"=>"Nomor : " . $vaData['faktur']) ;
        $data1[1] = array("kode"=>"Sudah Terima Dari","aa"=>":","keterangan"=>$vaData['nama']) ;
        $data1[2] = array("kode"=>"Banyaknya Uang ","aa"=>":","keterangan"=>terbilang($nNominal)) ;
        $data1[3] = array("kode"=>"Untuk Pembayaran","aa"=>":","keterangan"=>$vaData['keterangan']) ;
        
        $data2[1] = array("kode"=>"","aa"=>"","keterangan"=>"Pare," . date_2d($vaData['tgl'])) ;
        $data2[2] = array("kode"=>"","aa"=>"","keterangan"=>"Penerima,") ;
        $data2[3] = array("kode"=>"","aa"=>"","keterangan"=>"") ;
        $data2[4] = array("kode"=>"","aa"=>"","keterangan"=>"") ;
        $data2[5] = array("kode"=>"","aa"=>"","keterangan"=>"") ; 
        $data2[6] = array("kode"=>"<i><b>Terbilang</b></i> : Rp. " . string_2s($nNominal),"aa"=>"","keterangan"=>$username) ;
        
        $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'DaftarBukuBesar_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>KUITANSI PEMBAYARAN</b>",$font+4) ; 
        $this->bospdf->ezText("FITNESS SYANJAYA",$font+3) ;
    $this->bospdf->ezText("_______________________________________________________________________") ; 
    $this->bospdf->ezText("") ;
    $this->bospdf->ezTable($data,"","",
                array("fontSize"=>$font,'showLines'=>1,'showHeadings'=>0,"cols"=> array( "kode"=>array("caption"=>"Keterangan","width"=>25,"wrap"=>1)))) ;  
    $this->bospdf->ezText("") ;
    $this->bospdf->ezTable($data1,"","",
                array("fontSize"=>$font,'showLines'=>0,'showHeadings'=>0,"cols"=> array( "kode"=>array("caption"=>"Keterangan","width"=>15,"wrap"=>1),
               "aa"=>array("caption"=>"Keterangan","width"=>2,"wrap"=>1),
               "keterangan"=>array("caption"=>"Keterangan","wrap"=>1),
              ))) ;  
    $this->bospdf->ezText("") ;
    $this->bospdf->ezText("") ;
    $this->bospdf->ezTable($data2,"","",
                array("fontSize"=>$font,'showLines'=>0,'showHeadings'=>0,"cols"=> array( "kode"=>array("caption"=>"Keterangan","width"=>55,"wrap"=>1),
               "aa"=>array("caption"=>"Keterangan","width"=>4,"wrap"=>1),
               "keterangan"=>array("caption"=>"Keterangan","wrap"=>1),
              ))) ;  
    

        $this->bospdf->ezStream() ; 
   }

}
?>
