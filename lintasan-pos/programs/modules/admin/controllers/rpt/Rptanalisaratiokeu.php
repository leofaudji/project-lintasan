<?php
class Rptanalisaratiokeu extends Bismillah_Controller{
  protected $bdb ;
  public function __construct(){
    parent::__construct() ;
    $this->load->model("rpt/rptanalisaratiokeu_m") ;
        $this->load->model("func/perhitungan_m") ;
    $this->bdb   = $this->rptanalisaratiokeu_m ;
        $this->ss  = "ssrptanalisaratiokeu_" ;
  }  

  public function index(){ 

        $data['rekarkpjawal']= $this->bdb->getconfig("rekarkpjawal") ;
        $data['ketrekarkpjawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkpjawal']}'", "keuangan_rekening");
        $data['rekarkpjakhir']= $this->bdb->getconfig("rekarkpjakhir") ;
        $data['ketrekarkpjakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkpjakhir']}'", "keuangan_rekening");
        $data['rekarkkbawal']= $this->bdb->getconfig("rekarkkbawal") ;
        $data['ketrekarkkbawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkkbawal']}'", "keuangan_rekening");
        $data['rekarkkbakhir']= $this->bdb->getconfig("rekarkkbakhir") ;
        $data['ketrekarkkbakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkkbakhir']}'", "keuangan_rekening");
        $data['rekarkpiutangawal']= $this->bdb->getconfig("rekarkpiutangawal") ;
        $data['ketrekarkpiutangawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkpiutangawal']}'", "keuangan_rekening");
        $data['rekarkpiutangakhir']= $this->bdb->getconfig("rekarkpiutangakhir") ;
        $data['ketrekarkpiutangakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkpiutangakhir']}'", "keuangan_rekening");
        $data['rekarkpsdawal']= $this->bdb->getconfig("rekarkpsdawal") ;
        $data['ketrekarkpsdawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkpsdawal']}'", "keuangan_rekening");
        $data['rekarkpsdakhir']= $this->bdb->getconfig("rekarkpsdakhir") ;
        $data['ketrekarkpsdakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkpsdakhir']}'", "keuangan_rekening");
        $data['rekarkpsktawal']= $this->bdb->getconfig("rekarkpsktawal") ;
        $data['ketrekarkpsktawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkpsktawal']}'", "keuangan_rekening");
        $data['rekarkpsktakhir']= $this->bdb->getconfig("rekarkpsktakhir") ;
        $data['ketrekarkpsdktakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkpsktakhir']}'", "keuangan_rekening");
        $data['rekarkatawal']= $this->bdb->getconfig("rekarkatawal") ;
        $data['ketrekarkatawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkatawal']}'", "keuangan_rekening");
        $data['rekarkatakhir']= $this->bdb->getconfig("rekarkatakhir") ;
        $data['ketrekarkatakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkatakhir']}'", "keuangan_rekening");
        $data['rekarkatwawal']= $this->bdb->getconfig("rekarkatwawal") ;
        $data['ketrekarkatwawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkatwawal']}'", "keuangan_rekening");
        $data['rekarkatwakhir']= $this->bdb->getconfig("rekarkatwakhir") ;
        $data['ketrekarkatwakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkatwakhir']}'", "keuangan_rekening");
        $data['rekarkallawal']= $this->bdb->getconfig("rekarkallawal") ;
        $data['ketrekarkallawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkallawal']}'", "keuangan_rekening");
        $data['rekarkallakhir']= $this->bdb->getconfig("rekarkallakhir") ;
        $data['ketrekarkallakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkallakhir']}'", "keuangan_rekening");
        $data['rekarkhdawal']= $this->bdb->getconfig("rekarkhdawal") ;
        $data['ketrekarkhdawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkhdawal']}'", "keuangan_rekening");
        $data['rekarkhdakhir']= $this->bdb->getconfig("rekarkhdakhir") ;
        $data['ketrekarkhdakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkhdakhir']}'", "keuangan_rekening");
        $data['rekarkhbawal']= $this->bdb->getconfig("rekarkhbawal") ;
        $data['ketrekarkhbawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkhbawal']}'", "keuangan_rekening");
        $data['rekarkhbakhir']= $this->bdb->getconfig("rekarkhbakhir") ;
        $data['ketrekarkhbakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkhbakhir']}'", "keuangan_rekening");

    $this->load->view("rpt/rptanalisaratiokeu",$data) ; 

  }

    public function saving(){
    $va   = $this->input->post() ;
        $this->bdb->saveconfig("rekarkpjawal", $va['rekarkpjawal']) ;
        $this->bdb->saveconfig("rekarkpjakhir", $va['rekarkpjakhir']) ;
        $this->bdb->saveconfig("rekarkkbawal", $va['rekarkkbawal']) ;
        $this->bdb->saveconfig("rekarkkbakhir", $va['rekarkkbakhir']) ;
        $this->bdb->saveconfig("rekarkpiutangawal", $va['rekarkpiutangawal']) ;
        $this->bdb->saveconfig("rekarkpiutangakhir", $va['rekarkpiutangakhir']) ;
        $this->bdb->saveconfig("rekarkpsdawal", $va['rekarkpsdawal']) ;
        $this->bdb->saveconfig("rekarkpsdakhir", $va['rekarkpsdakhir']) ;
        $this->bdb->saveconfig("rekarkpsktawal", $va['rekarkpsktawal']) ;
        $this->bdb->saveconfig("rekarkpsktakhir", $va['rekarkpsktakhir']) ;
        $this->bdb->saveconfig("rekarkatawal", $va['rekarkatawal']) ;
        $this->bdb->saveconfig("rekarkatakhir", $va['rekarkatakhir']) ;
        $this->bdb->saveconfig("rekarkatwawal", $va['rekarkatwawal']) ;
        $this->bdb->saveconfig("rekarkatwakhir", $va['rekarkatwakhir']) ;
        $this->bdb->saveconfig("rekarkallawal", $va['rekarkallawal']) ;
        $this->bdb->saveconfig("rekarkallakhir", $va['rekarkallakhir']) ;
        $this->bdb->saveconfig("rekarkhdawal", $va['rekarkhdawal']) ;
        $this->bdb->saveconfig("rekarkhdakhir", $va['rekarkhdakhir']) ;
        $this->bdb->saveconfig("rekarkhbawal", $va['rekarkhbawal']) ;
        $this->bdb->saveconfig("rekarkhbakhir", $va['rekarkhbakhir']) ;



    echo('bos.rptanalisaratiokeu.settab(0) ') ;
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

        $vare   = array() ;

        //persd barang dalam proses awal
        $vare[] = array("no"=>1,"keterangan"=>"Laba Usaha","1"=>"","2"=>"","3"=>"","4"=>"","5"=>"");

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
        echo(' bos.rptanalisaratiokeu.openreport() ; ') ;
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
