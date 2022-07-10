<?php

class Rptsj extends Bismillah_Controller{
   protected $bdb ;
   protected $ss ;
   protected $abc ;
   public function __construct(){
      parent::__construct() ;
      $this->load->helper('bdate');
      $this->load->model('rpt/rptsj_m') ;
	  $this->load->model('func/func_m') ;
	  $this->load->library('curl');
      $this->bdb = $this->rptsj_m ;
      $this->ss  = "ssrptsj_" ;
   }

   public function index(){
      $d    = array("setdate"=>date_set()) ;
      $this->load->view('rpt/rptsj', $d) ;
   }

   public function loadgrid(){
      $va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $va['tglAwal'] = date_2s($va['tglAwal']);
      $va['tglAkhir'] = date_2s($va['tglAkhir']);
      $vdb    = $this->rptsj_m->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->rptsj_m->getrow($dbd) ){
         $vaset   = $dbr ;
         $vaset['tgl'] = date_2d($vaset['tgl']);
         $vaset['cmdPreview']    = '<button type="button" onClick="bos.rptsj.cmdpreviewdetail(\''.$dbr['faktur'].'\')"
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
      echo('w2ui["bos-form-rptsj_grid2"].clear();');
      $data = $this->rptsj_m->GetDataPerFaktur($cFaktur) ;
      if(!empty($data)){
         echo('
                  with(bos.rptsj.obj){
                     find("#faktur").val("'.$data['faktur'].'") ;
                     find("#fakturdo").val("'.$data['do'].'") ;
                     find("#customer").val("'.$data['customer'].'") ;
                     find("#petugaspengirim").val("'.$data['petugaspengirim'].'") ;
                     find("#kernet").val("'.$data['kernet'].'") ;
                     find("#nopol").val("'.$data['nopol'].'") ;
                     find("#tgl").val("'.$data['Tgl'].'") ;
                  }

              ') ;
         $data = $this->rptsj_m->getDetailSJ($cFaktur) ;
         $vare = array();
         $n = 0 ;
         while($dbr = $this->rptsj_m->getrow($data)){
            $n++;
            $vaset          = $dbr ;
            $vaset['recid'] = $n;
            $vaset['no']    = $n;
            $vare[]         = $vaset ;
         }

         $vare = json_encode($vare);
         echo('
            bos.rptsj.loadmodalpreview("show") ;
            bos.rptsj.grid2_reloaddata();
            w2ui["bos-form-rptsj_grid2"].add('.$vare.');
         ');
      }
   }

   public function initreport(){
      $va      = $this->input->post() ;
      $cFaktur  = $va['faktur'];

      $file   = setfile($this, "rpt", __FILE__ , $va) ;
      savesession($this, $this->ss . "file", $file ) ;
      savesession($this, $this->ss . "va", json_encode($va) ) ;
      file_put_contents($file, json_encode(array()) ) ;

      $file    = getsession($this, $this->ss . "file") ;
      $data    = @file_get_contents($file) ;
      $data    = json_decode($data,true) ;
      $db      = $this->bdb->getDetailSJ($cFaktur) ;
      $nDebet  = 0 ;
      $nKredit = 0 ;
      $nSaldo  = 0 ;
      $s = 0 ;
      while($dbr = $this->bdb->getrow($db)){
         $no      = ++$s ;
         $data[]  = array("No"=>$no,
                          "Kode"=>$dbr['kode'],
                          "Keterangan"=>$dbr['keterangan'],
                          "Qty"=>number_format($dbr['qty']),
                          "Retur"=>"",
                          "Diterima"=>""
						  //"Satuan"=>$dbr['satuan']
                       ) ;
      }
      file_put_contents($file, json_encode($data) ) ;
      echo(' bos.rptsj.openreport() ; ') ;
   }

   public function initreportTotal(){
      $va         = $this->input->post() ;
      $dTglAwal   = date_2s($va['tglawal']);
      $dTglAkhir  = date_2s($va['tglakhir']);
      $file       = setfile($this, "rpt_sjtotal", __FILE__ , $va) ;
      savesession($this, $this->ss . "file", $file ) ;
      savesession($this, $this->ss . "va", json_encode($va) ) ;
      file_put_contents($file, json_encode(array()) ) ;

      $file    = getsession($this, $this->ss . "file") ;
      $data    = @file_get_contents($file) ;
      $data    = json_decode($data,true) ;
      $db      = $this->bdb->getTotalSJ($dTglAwal,$dTglAkhir) ;
      $s       = 0 ;
      while ($dbRow = $this->bdb->getrow($db)) {
         $no      = ++$s ;
         $data[]  = array("No"=>$no,
                          "Faktur"=>$dbRow['faktur'],
                          "Faktur DO"=>$dbRow['do'],
                          "Tgl"=>$dbRow['tgl'],
                          "Cabang"=>$dbRow['cabang'],
                          "Customer"=>$dbRow['customer'],
                          "Pengirim"=>$dbRow['petugaspengirim'],
                          "Kernet"=>$dbRow['kernet'],
                          "No Pol"=>$dbRow['nopol']
                        ) ;
      }
      file_put_contents($file, json_encode($data) ) ;
      echo(' bos.rptsj.openreporttotal() ; ') ;

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
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=> $kota ) ;
         $vttd[] = array("1"=>"Penerima","2"=>"","3"=>"Supir","4"=>",","5"=>"Gudang") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"(.........................)","2"=>"","3"=>"(.........................)","4"=>"","5"=>"(.........................)") ;


		$vgalon = array();
		$vgalon[] = array("1"=>"Note","2"=>"Kembali Galon Kosong KH-Q","3"=>":","4"=>"________ pcs","5"=>"");
		$vgalon[] = array("1"=>"","2"=>"Kembali Galon Kosong BUYA","3"=>":","4"=>"________ pcs","5"=>"");
		$vgalon[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"");

        $vyth = array();
        $vyth[] = array("1"=>"","2"=>"","3"=>"Kepada Yang Terhormat: ");
          $vyth[] = array("1"=>"","2"=>"","3"=>$va['customer']);

         $font = 8 ;
         $exTgl = explode("-",$va['tgl']);
         $dTglFaktur = $exTgl['2'] . "-" . $exTgl['1'] . "-" . $exTgl['0'];

         $vDetail = array() ;
         $vDetail[] = array("1"=>"No SJ","2"=>" : ","3"=> $va['faktur'],"4"=>"","5"=>"No. DO","6"=>":","7"=>$va['fakturdo'],"8"=>"","9"=>"Supir","10"=>":","11"=>$va['petugaspengirim'] ) ;
         $vDetail[] = array("1"=>"Tgl SJ","2"=>" : ","3"=> date_2d($va['tgl']),"4"=>"","5"=>"No. Pol Truk","6"=>":","7"=>$va['nopol'],"8"=>"","9"=>"Kernet","10"=>":","11"=>$va['kernet'] ) ;


         $o    = array('paper'=>'A4', 'orientation'=>'p', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                        'opt'=>array('export_name'=>'Kartu Stock','mtop'=>1) ) ;
         $this->load->library('bospdf', $o) ;
         $this->bospdf->ezLogoHeaderPage(base_url()."uploads/HeaderSJDO.jpg",'0','65','150','50');

         $this->bospdf->ezTable($vyth,"","",
                                 array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                       "cols"=> array(
                                          "1"=>array("justification"=>"left"),
                                          "2"=>array("width"=>10,"justification"=>"center"),
                                          "3"=>array("wrap"=>1,"width"=>25,"justification"=>"left"))
										)
									);
         $this->bospdf->ezText("<b>SURAT JALAN</b>",$font+6,array("justification"=>"center")) ;

         $this->bospdf->ezText("") ;
         $this->bospdf->ezTable($vDetail,"","",
                                 array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                       "cols"=> array(
                                          "1"=>array("width"=>10,"justification"=>"left"),
                                          "2"=>array("width"=>3,"justification"=>"center"),
                                          "3"=>array("width"=>15,"justification"=>"left"),
                                          "4"=>array("justification"=>"center"),
                                          "5"=>array("width"=>10,"justification"=>"left"),
                                          "6"=>array("width"=>3,"justification"=>"center"),
                                          "7"=>array("width"=>15,"justification"=>"left"),
                                          "8"=>array("justification"=>"center"),
                                          "9"=>array("width"=>10,"justification"=>"left"),
                                          "10"=>array("width"=>3,"justification"=>"center"),
                                          "11"=>array("width"=>15,"justification"=>"left"))
										)
									);

         $this->bospdf->ezText("") ;
         $this->bospdf->ezTable($data,"","",
                                 array("fontSize"=>$font,"showLines"=>1,"outerLineThickness"=>0.1,"innerLineThickness"=>0.1,
								 "shadeCol"=>array(0.1,0.1,0.1),
                                       "cols"=> array(
                                             "No"			=>array("width"=>3,"justification"=>"center"),
                                             "Kode"			=>array("width"=>12,"justification"=>"center"),
                                             "Keterangan"	=>array("wrap"=>1,"caption"=>"Nama Barang"),
                                             "Qty"          =>array("width"=>8,"justification"=>"right","caption"=>"Jumlah;Barang"),
											 "Retur"        =>array("width"=>8,"justification"=>"right","caption"=>"Jumlah;Retur"),
											 "Diterima"        =>array("width"=>8,"justification"=>"right","caption"=>"Jumlah;Diterima")))
                                             //"Satuan"       =>array("width"=>9,"justification"=>"center")))
                                 ) ;


          $this->bospdf->ezTable($vgalon,"","",
                                 array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                       "cols"=> array(
                                          "1"=>array("width"=>5,"justification"=>"left"),
                                          "2"=>array("width"=>20,"justification"=>"left"),
                                          "3"=>array("width"=>3,"justification"=>"center"),
                                          "4"=>array("width"=>10,"justification"=>"right"),
                                          "5"=>array("justification"=>"center"))
                                 )
                              ) ;


         $this->bospdf->ezText("") ;
         $this->bospdf->ezTable($vttd,"","",
                                 array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                       "cols"=> array(
                                          "1"=>array("width"=>25,"justification"=>"center"),
                                          "2"=>array("wrap"=>1,"justification"=>"center"),
                                          "3"=>array("width"=>25,"justification"=>"center"),
                                          "4"=>array("wrap"=>1,"justification"=>"center"),
                                          "5"=>array("width"=>25,"justification"=>"center"))
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
         $this->bospdf->ezText("<b>LAPORAN TOTAL SURAT JALAN</b>",$font+4,array("justification"=>"center")) ;
         $this->bospdf->ezText("<b>Periode : " .$va['tglawal']. " s/d " . $va['tglakhir'] . "</b>",$font+4,array("justification"=>"center")) ;
         $this->bospdf->ezText("") ;
          $this->bospdf->ezTable($data,"","",
                                 array("fontSize"=>$font,
                                       "cols"=> array(
                                             "No"=>array("width"=>5,"justification"=>"right"),
                                             "Faktur"=>array("width"=>20,"wrap"=>1,"justification"=>"center"),
                                             "Faktur DO"=>array("width"=>20,"wrap"=>1,"justification"=>"center"),
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
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;

        $this->func_m->cetaksj($faktur);
    }
}

?>
