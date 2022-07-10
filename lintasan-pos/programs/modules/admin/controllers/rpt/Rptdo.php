<?php
class Rptdo extends Bismillah_Controller{
   protected $bdb ;
   protected $ss ;
   protected $abc ;
   public function __construct(){
      parent::__construct() ;
      $this->load->helper('bdate');
      $this->load->model('rpt/rptdo_m') ;
       $this->load->model('func/func_m') ;
       $this->load->library('curl');
      $this->bdb = $this->rptdo_m ;
      $this->ss  = "ssrptdo_" ;
   }

   public function index(){
      $d    = array("setdate"=>date_set()) ;
      $this->load->view('rpt/rptdo', $d) ;
   }

   public function loadgrid(){
      $va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $va['tglAwal'] = date_2s($va['tglAwal']);
      $va['tglAkhir'] = date_2s($va['tglAkhir']);
      $vdb    = $this->rptdo_m->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->rptdo_m->getrow($dbd) ){
         $vaset   = $dbr ;
         $vaset['tgl'] = date_2d($vaset['tgl']);
         $vaset['cmdPreview']    = '<button type="button" onClick="bos.rptdo.cmdpreviewdetail(\''.$dbr['faktur'].'\')"
                                     class="btn btn-success btn-grid">Preview Detail</button>' ;
         $vaset['cmdPreview']    = html_entity_decode($vaset['cmdPreview']) ;
         $vare[]     = $vaset ;
      }

      $vare    = array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
   }

   public function PreviewDetail(){
      $va    = $this->input->post() ;
      $cFaktur = $va['faktur'] ;
      echo('w2ui["bos-form-rptdo_grid2"].clear();');
      $data = $this->rptdo_m->GetDataPerFaktur($cFaktur) ;
      if(!empty($data)){
         echo('
                  with(bos.rptdo.obj){
                     find("#faktur").val("'.$data['faktur'].'") ;
                     find("#customer").val("'.$data['customer'].'") ;
                     find("#tgl").val("'.$data['Tgl'].'") ;
                  }

              ') ;
         $data = $this->rptdo_m->getDetailDO($cFaktur) ;
         $vare = array();
         $n = 0 ;
         while($dbr = $this->rptdo_m->getrow($data)){
            $n++;
            $vaset          = $dbr ;
            $vaset['recid'] = $n;
            $vaset['no']    = $n;
            $vare[]         = $vaset ;
         }

         $vare = json_encode($vare);
         echo('
            bos.rptdo.loadmodalpreview("show") ;
            bos.rptdo.grid2_reloaddata();
            w2ui["bos-form-rptdo_grid2"].add('.$vare.');
         ');
      }
   }

   public function initreport(){
      $va      = $this->input->post() ;
      $cFaktur  = $va['cFaktur'];

      $file   = setfile($this, "rpt", __FILE__ , $va) ;
      savesession($this, $this->ss . "file", $file ) ;
      savesession($this, $this->ss . "va", json_encode($va) ) ;
      file_put_contents($file, json_encode(array()) ) ;

      $file    = getsession($this, $this->ss . "file") ;
      $data    = @file_get_contents($file) ;
      $data    = json_decode($data,true) ;
      $db      = $this->bdb->getDetailDO($cFaktur) ;
      $nDebet  = 0 ;
      $nKredit = 0 ;
      $nSaldo  = 0 ;
      $s = 0 ;
      while($dbr = $this->bdb->getrow($db)){
         $no      = ++$s ;
         $data[]  = array("#"=>$no,
                          "Kode"=>$dbr['kode'],
                          "Keterangan"=>$dbr['keterangan'],
                          "Qty"=>number_format($dbr['qty']),
                          "Satuan"=>$dbr['satuan']
                       ) ;
      }
      file_put_contents($file, json_encode($data) ) ;
      echo(' bos.rptdo.openreport() ; ') ;
   }

   public function initreportTotal(){
      $va         = $this->input->post() ;
      $dTglAwal   = date_2s($va['tglawal']);
      $dTglAkhir  = date_2s($va['tglakhir']);
      $file       = setfile($this, "rpt_dototal", __FILE__ , $va) ;
      savesession($this, $this->ss . "file", $file ) ;
      savesession($this, $this->ss . "va", json_encode($va) ) ;
      file_put_contents($file, json_encode(array()) ) ;

      $file    = getsession($this, $this->ss . "file") ;
      $data    = @file_get_contents($file) ;
      $data    = json_decode($data,true) ;
      $db      = $this->bdb->getTotaldo($dTglAwal,$dTglAkhir) ;
      $s       = 0 ;
      while ($dbRow = $this->bdb->getrow($db)) {
         $no      = ++$s ;
         $data[]  = array("No"=>$no,
                          "Faktur"=>$dbRow['faktur'],
                          "Tgl"=>$dbRow['tgl'],
                          "Cabang"=>$dbRow['cabang'],
                          "Customer"=>$dbRow['customer']
                        ) ;
      }
      file_put_contents($file, json_encode($data) ) ;
      echo(' bos.rptdo.openreporttotal() ; ') ;

   }

   public function showreport(){
      $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
      $file = getsession($this, $this->ss . "file") ;
      $data = @file_get_contents($file) ;
      $data = json_decode($data,true) ;
      if(!empty($data)){
         //tanda tangan
         $now  = date_2b(date("Y-m-d")) ;
         $kota = $this->bdb->getconfig("kota") . ", " . $now['d'] . ' ' . $now['m'] . ' ' . $now['y'];
         $ttd  = json_decode($this->bdb->getconfig("ttd"), true) ;
         $vttd = array() ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=> $kota ,"5"=>"") ;
         //$vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"Gudang,","3"=>"","4"=>"Penjualan,","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"(.......................)","3"=>"","4"=>"(.......................)","5"=>"") ;


         $font = 10 ;
         $exTgl = explode("-",$va['tgl']);
         $dTglFaktur = $exTgl['2'] . "-" . $exTgl['1'] . "-" . $exTgl['0'];

         $vDetail = array() ;
         $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Faktur","5"=>":","6"=>$va['cFaktur']) ;
         $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Customer","5"=>":","6"=>$va['customer']) ;
         $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Tanggal","5"=>":","6"=>$dTglFaktur) ;
     
     $vTitle = array() ;
         $vTitle[] = array("capt"=>" DELIVERY ORDER (DO) ") ;


         $o    = array('paper'=>'A4', 'orientation'=>'p', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                        'opt'=>array('export_name'=>'Kartu Stock','mtop'=>1) ) ;
         $this->load->library('bospdf', $o) ;
     //$this->bospdf->ezSetMargins(1,1,20,20);
     //$this->bospdf->ezSetCmMargins(0, 1, 1, 1);
     //$this->bospdf->ezImage("./uploads/HeaderSJDO.jpg",true,'60','190','50');
         $this->bospdf->ezLogoHeaderPage(base_url()."uploads/HeaderSJDO.jpg",'0','65','150','50');
         //$this->bospdf->ezHeader("<b>DELIVERY ORDER (DO)</b>",array("justification"=>"center")) ;
         //$this->bospdf->ezText("") ;

     //ketika width tidak di set maka akan menyesuaikan dengan lebar kertas

     $this->bospdf->ezTable($vDetail,"","",
                                 array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                       "cols"=> array(
                                          "1"=>array("width"=>10,"justification"=>"left"),
                                          "2"=>array("width"=>3,"justification"=>"left"),
                                          "3"=>array("justification"=>"left"),
                                          "4"=>array("width"=>10,"justification"=>"left"),
                                          "5"=>array("width"=>3,"justification"=>"left"),
                                          "6"=>array("width"=>20,"justification"=>"left"),)
                                 )
                              ) ;

         $this->bospdf->ezTable($vTitle,"","",
                                 array("fontSize"=>$font+3,"showHeadings"=>0,"showLines"=>0,
                                       "cols"=> array(
                                          "capt"=>array("justification"=>"center"),)
                                 )
                              ) ;
    $this->bospdf->ezText("") ;
         $this->bospdf->ezTable($data,"","",
                                 array("fontSize"=>$font,"showLines"=>1,
                                       "cols"=> array(
                                             "#"            =>array("width"=>2,"justification"=>"right"),
                                             "Kode"      =>array("width"=>12,"justification"=>"center"),
                                             "Keterangan"   =>array("wrap"=>1,"caption"=>"Nama Barang"),
                                             "Qty"          =>array("width"=>9,"justification"=>"center","caption"=>"Jumlah"),
                                             "Satuan"       =>array("width"=>9,"justification"=>"center")))
                                 ) ;


         $this->bospdf->ezText("") ;
         $this->bospdf->ezTable($vttd,"","",
                                 array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                       "cols"=> array(
                                          "1"=>array("justification"=>"right"),
                                          "2"=>array("width"=>25,"wrap"=>1,"justification"=>"center"),
                                          "3"=>array("width"=>40,"wrap"=>1),
                                          "4"=>array("width"=>30,"wrap"=>1,"justification"=>"center"),
                                          "5"=>array("wrap"=>1,"justification"=>"center"))
                                 )
                              ) ;
         $this->bospdf->ezStream() ;
      }else{
         echo('kosong') ;
      }
   }

   public function showreporttotal(){
      $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
      $file = getsession($this, $this->ss . "file") ;
      $data = @file_get_contents($file) ;
      $data = json_decode($data,true) ;
      if(!empty($data)){
         //tanda tangan
         $now  = date_2b(date("Y-m-d")) ;
         $kota = $this->bdb->getconfig("kota") . ", " . $now['d'] . ' ' . $now['m'] . ' ' . $now['y'];
         $ttd  = json_decode($this->bdb->getconfig("ttd"), true) ;
         $vttd = array() ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=> $kota ,"5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"Mengetahui,","3"=>"","4"=>"Menyetujui,","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"(.........................)","3"=>"","4"=>"(.........................)","5"=>"") ;


         $font = 8 ;
         $o    = array('paper'=>'A4', 'orientation'=>'P', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                        'opt'=>array('export_name'=>'Kartu Stock') ) ;
         $this->load->library('bospdf', $o) ;
         $this->bospdf->ezText("<b>LAPORAN TOTAL DELIVERY ORDER</b>",$font+4,array("justification"=>"center")) ;
         $this->bospdf->ezText("<b>Periode : " .$va['tglawal']. " s/d " . $va['tglakhir'] . "</b>",$font+4,array("justification"=>"center")) ;
         $this->bospdf->ezText("") ;
          $this->bospdf->ezTable($data,"","",
                                 array("fontSize"=>$font,
                                       "cols"=> array(
                                             "No"=>array("width"=>5,"justification"=>"right"),
                                             "Faktur"=>array("width"=>20,"wrap"=>1,"justification"=>"center"),
                                             "Tgl"=>array("width"=>10,"wrap"=>1,"justification"=>"center"),
                                             "Cabang"=>array("width"=>8,"justification"=>"center"),
                                             "Customer"=>array("justification"=>"left")
                                          ))
                                 ) ;

         $this->bospdf->ezText("") ;
         $this->bospdf->ezText("") ;
         $this->bospdf->ezTable($vttd,"","",
                                 array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                       "cols"=> array(
                                          "1"=>array("justification"=>"right"),
                                          "2"=>array("width"=>25,"wrap"=>1,"justification"=>"center"),
                                          "3"=>array("width"=>40,"wrap"=>1),
                                          "4"=>array("width"=>25,"wrap"=>1,"justification"=>"center"),
                                          "5"=>array("wrap"=>1,"justification"=>"center"))
                                 )
                              ) ;
         $this->bospdf->ezStream() ;
      }else{
         echo('kosong') ;
      }
   }
    
    public function cetakdm(){
        $va   = $this->input->post() ;
        $faktur = $va['faktur'] ;

        $this->func_m->cetakdo($faktur);
    }
}

?>
