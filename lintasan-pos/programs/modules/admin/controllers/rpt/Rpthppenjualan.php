<?php
class Rpthppenjualan extends Bismillah_Controller{
  protected $bdb ;
  public function __construct(){
    parent::__construct() ;
    $this->load->model("rpt/rpthppenjualan_m") ;
        $this->load->model("func/perhitungan_m") ;
    $this->bdb   = $this->rpthppenjualan_m ;
        $this->ss  = "ssrpthppenjualan_" ;
  }  

  public function index(){ 

        $data['rekhppbjawal']= $this->bdb->getconfig("rekhppbjawal") ;
        $data['ketrekhppbjawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekhppbjawal']}'", "keuangan_rekening");
        $data['rekhppbjakhir']= $this->bdb->getconfig("rekhppbjakhir") ;
        $data['ketrekhppbjakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekhppbjakhir']}'", "keuangan_rekening");
        

    $this->load->view("rpt/rpthppenjualan",$data) ; 

  }

    public function saving(){
    $va   = $this->input->post() ;
        $this->bdb->saveconfig("rekhppbjawal", $va['rekhppbjawal']) ;
        $this->bdb->saveconfig("rekhppbjakhir", $va['rekhppbjakhir']) ;


    echo('bos.rpthppenjualan.settab(0) ') ;
  }

    public function seekrekening(){
        $search     = $this->input->get('q');
        $vdb    = $this->bdb->seekrekening($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->bdb->getrow($dbd) ){
            $vare[]   = array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ".$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
    
    public function loadgrid(){ 

      $va     = json_decode($this->input->post('request'), true) ; 
      $tglawal   = $va['tglawal'] ; //date("d-m-Y") ;
        $tglakhir   = $va['tglakhir'] ; //date("d-m-Y") ;
      $tglkemarin = date("d-m-Y",strtotime($tglawal)-(24*60*60)) ;

        $vare   = array() ;

        //persd barang dalam proses awal
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: Persediaan Barang Jadi ".$tglkemarin."</b>","1"=>"","2"=>"","3"=>"");
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbjawal"),$this->bdb->getconfig("rekhppbjakhir")) ;
        $jumlah = 0;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldoakhir = $this->perhitungan_m->getsaldo($tglkemarin,$dbr['kode']);
            $jumlah += $saldoakhir;
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>$saldoakhir,"2"=>"","3"=>""); 
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>Jumlah Persediaan Barang Jadi ".$tglkemarin."</b>","1"=>"","2"=>$jumlah,"3"=>"");
        //mengaambil harga pokok produksi
        $jumlahproduksi = 0;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbjawal"),$this->bdb->getconfig("rekhppbjakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $debet = $this->perhitungan_m->getdebet($tglawal,$tglakhir,$dbr['kode']);
            $jumlahproduksi += $debet;
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>Harga Pokok Produksi</b>","1"=>"","2"=>$jumlahproduksi,"3"=>"");

        $jmlsiapjual = $jumlahproduksi + $jumlah;
        $vare[] = array("kode"=>"","keterangan"=>"<b>Barang Tersedia Untuk dijual</b>","1"=>"","2"=>"","3"=>$jmlsiapjual);
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: Persediaan Barang Jadi ".$tglakhir."</b>","1"=>"","2"=>"","3"=>"");
        $jumlahsa = 0;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbjawal"),$this->bdb->getconfig("rekhppbjakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldoakhir = $this->perhitungan_m->getsaldo($tglakhir,$dbr['kode']);
            $jumlahsa += $saldoakhir;
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>$saldoakhir,"2"=>"","3"=>""); 
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>Jumlah Persediaan Barang Jadi ".$tglakhir."</b>","1"=>"","2"=>$jumlahsa,"3"=>"");
        $vare[] = array("kode"=>"","keterangan"=>"","1"=>"","2"=>"","3"=>$jumlahsa);
        $jmlhpp = $jmlsiapjual - $jumlahsa;
        $vare[] = array("kode"=>"","keterangan"=>"<b>Harga Pokok Penjualan</b>","1"=>"","2"=>"","3"=>$jmlhpp);

        $vare   = array("total"=>count($vare), "records"=>$vare ) ; 
        echo(json_encode($vare)) ; 
    }

    public function initreport(){
        $n=0;
        $va     = $this->input->post() ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;

      $tglawal   = $va['tglawal'] ; //date("d-m-Y") ;
        $tglakhir   = $va['tglakhir'] ; //date("d-m-Y") ;
      $tglkemarin = date("d-m-Y",strtotime($tglawal)-(24*60*60)) ;

        $vare   = array() ;

        //persd barang dalam proses awal
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: Persediaan Barang Jadi ".$tglkemarin."</b>","1"=>"","2"=>"","3"=>"");
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbjawal"),$this->bdb->getconfig("rekhppbjakhir")) ;
        $jumlah = 0;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldoakhir = $this->perhitungan_m->getsaldo($tglkemarin,$dbr['kode']);
            $jumlah += $saldoakhir;
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>$saldoakhir,"2"=>"","3"=>""); 
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>Jumlah Persediaan Barang Jadi ".$tglkemarin,"1"=>"","2"=>$jumlah,"3"=>"</b>");
        //mengaambil harga pokok produksi
        $jumlahproduksi = 0;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbjawal"),$this->bdb->getconfig("rekhppbjakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $debet = $this->perhitungan_m->getdebet($tglawal,$tglakhir,$dbr['kode']);
            $jumlahproduksi += $debet;
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>Harga Pokok Produksi","1"=>"","2"=>$jumlahproduksi,"3"=>"</b>");

        $jmlsiapjual = $jumlahproduksi + $jumlah;
        $vare[] = array("kode"=>"","keterangan"=>"<b>Barang Tersedia Untuk dijual","1"=>"","2"=>"","3"=>$jmlsiapjual."</b>");
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: Persediaan Barang Jadi ".$tglakhir,"1"=>"","2"=>"","3"=>"</b>");
        $jumlahsa = 0;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbjawal"),$this->bdb->getconfig("rekhppbjakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldoakhir = $this->perhitungan_m->getsaldo($tglakhir,$dbr['kode']);
            $jumlahsa += $saldoakhir;
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>$saldoakhir,"2"=>"","3"=>""); 
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>Jumlah Persediaan Barang Jadi ".$tglakhir,"1"=>"","2"=>$jumlahsa,"3"=>"</b>");
        $vare[] = array("kode"=>"<b>","keterangan"=>"","1"=>"","2"=>"","3"=>$jumlahsa."</b>");
        $jmlhpp = $jmlsiapjual - $jumlahsa;
        $vare[] = array("kode"=>"","keterangan"=>"<b>Harga Pokok Penjualan","1"=>"","2"=>"","3"=>$jmlhpp."</b>");

        savesession($this, "rpthppj_rpt", json_encode($vare)) ; 
        echo(' bos.rpthppenjualan.openreport() ; ') ;
    }
                            
    public function showreport(){
      $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
      $data = getsession($this,"rpthppj_rpt") ;      
      $data = json_decode($data,true) ;       
      if(!empty($data)){ 
        $font = 10 ;
        $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'DaftarNeraca_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>LAPORAN HARGA POKOK PENJUALAN</b>",$font+4,array("justification"=>"center")) ;
        $this->bospdf->ezText("Periode : ".$va['tglawal']." sd ". $va['tglakhir'],$font+2,array("justification"=>"center")) ;
    $this->bospdf->ezText("") ; 
    $this->bospdf->ezTable($data,"","",  
                array("showHeadings"=>"","showLines"=>"0","fontSize"=>$font,"cols"=> array( 
                           "kode"=>array("caption"=>"Tgl","width"=>10),
                           "keterangan"=>array("caption"=>"Keterangan","wrap"=>1),
                           "1"=>array("caption"=>"","width"=>15,"justification"=>"right"),
                          "2"=>array("caption"=>"","width"=>13,"justification"=>"right"),
                           "3"=>array("caption"=>"","width"=>13,"justification"=>"right")))) ;   
        //print_r($data) ;    
        $this->bospdf->ezStream() ; 
      }else{
         echo('data kosong') ;
      }
   }
}
?>
