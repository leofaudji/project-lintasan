<?php
class Rptaruskas extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model("rpt/rptaruskas_m") ;
        $this->load->model("func/perhitungan_m") ;
        $this->bdb   = $this->rptaruskas_m ;
        $this->ss  = "ssrptaruskas_" ;
    }  

    public function index(){ 
        $data = array();
        $this->load->view("rpt/rptaruskas",$data) ; 

    }

    public function saving(){
        $va   = $this->input->post() ;
        echo('bos.rptaruskas.settab(0) ') ;
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
        $arrdatamutasi = $this->bdb->loadfakturtrkas($tglawal,$tglakhir);
        $vare   = array() ;
        $vdb    = $this->bdb->loadrekeningstt("k","D") ;
        $vare[] = array("kode"=>"","keterangan"=>"<b>KAS ELEMENT KAS ".$tglkemarin."</b>","1"=>"","2"=>"","3"=>"","4"=>"");
        $totsaldokasawal = 0;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldo = $this->perhitungan_m->getsaldo($tglkemarin,$dbr['kode']);
            $totsaldokasawal += $saldo;
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>"","2"=>"","3"=>$saldo,"4"=>"");
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>JUMLAH KAS ELEMENT KAS</b>","1"=>"","2"=>"","3"=>"","4"=>$totsaldokasawal);

        $vare[] = array("kode"=>"","keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");

        //OPERASI
        $vare[] = array("kode"=>"","keterangan"=>"<b>ARUS KAS DARI AKTIVITAS OPERASI</b>","1"=>"","2"=>"","3"=>"","4"=>"");
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: SUMBER DANA</b>","1"=>"","2"=>"","3"=>"","4"=>"");
        $vdb    = $this->bdb->loadrekeningstt("o") ;
        $totoprsumberdana = 0 ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $sumberdana = $arrdatamutasi[$dbr['kode']]['sumberdana'];
            if($dbr['jenis'] == "I"){
                $dbr['kode'] = "<b>".$dbr['kode']."</b>";
                $dbr['keterangan'] = "<b>".$dbr['keterangan']."</b>";
            }else{
                $totoprsumberdana += $sumberdana;
            }
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>$sumberdana,"2"=>"","3"=>"","4"=>"");
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: JUMLAH SUMBER DANA</b>","1"=>"","2"=>$totoprsumberdana,"3"=>"","4"=>"");

        $vare[] = array("kode"=>"","keterangan"=>"<b>:: PENGGUNAAN</b>","1"=>"","2"=>"","3"=>"","4"=>"");
        $vdb    = $this->bdb->loadrekeningstt("o") ;
        $totoprpenggunaan = 0 ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $penggunaan = $arrdatamutasi[$dbr['kode']]['penggunaan'];
            if($dbr['jenis'] == "I"){
                $dbr['kode'] = "<b>".$dbr['kode']."</b>";
                $dbr['keterangan'] = "<b>".$dbr['keterangan']."</b>";
            }else{
                $totoprpenggunaan += $penggunaan;
            }
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>$penggunaan,"2"=>"","3"=>"","4"=>"");
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: JUMLAH PENGGUNAAN</b>","1"=>"","2"=>$totoprpenggunaan,"3"=>"","4"=>"");
        $jmlaktivitasopr = $totoprsumberdana - $totoprpenggunaan;
        $vare[] = array("kode"=>"","keterangan"=>"<b>JUMLAH ARUS KAS DARI AKTIVITAS OPERASI</b>","1"=>"","2"=>"","3"=>$jmlaktivitasopr,"4"=>"");
        $vare[] = array("kode"=>"","keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");
        
        //investasi
        $vare[] = array("kode"=>"","keterangan"=>"<b>ARUS KAS DARI AKTIVITAS INVESTASI</b>","1"=>"","2"=>"","3"=>"","4"=>"");
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: SUMBER DANA</b>","1"=>"","2"=>"","3"=>"","4"=>"");
        $vdb    = $this->bdb->loadrekeningstt("i") ;
        $totinvessumberdana = 0 ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $sumberdana = $arrdatamutasi[$dbr['kode']]['sumberdana'];
            if($dbr['jenis'] == "I"){
                $dbr['kode'] = "<b>".$dbr['kode']."</b>";
                $dbr['keterangan'] = "<b>".$dbr['keterangan']."</b>";
            }else{
                $totinvessumberdana += $sumberdana;
            }
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>$sumberdana,"2"=>"","3"=>"","4"=>"");
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: JUMLAH SUMBER DANA</b>","1"=>"","2"=>$totinvessumberdana,"3"=>"","4"=>"");

        $vare[] = array("kode"=>"","keterangan"=>"<b>:: PENGGUNAAN</b>","1"=>"","2"=>"","3"=>"","4"=>"");
        $vdb    = $this->bdb->loadrekeningstt("i") ;
        $totinvespenggunaan = 0 ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $penggunaan = $arrdatamutasi[$dbr['kode']]['penggunaan'];
            if($dbr['jenis'] == "I"){
                $dbr['kode'] = "<b>".$dbr['kode']."</b>";
                $dbr['keterangan'] = "<b>".$dbr['keterangan']."</b>";
            }else{
                $totinvespenggunaan += $penggunaan;
            }
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>$penggunaan,"2"=>"","3"=>"","4"=>"");
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: JUMLAH PENGGUNAAN</b>","1"=>"","2"=>$totinvespenggunaan,"3"=>"","4"=>"");
        $jmlaktivitasinves = $totinvessumberdana - $totinvespenggunaan;
        $vare[] = array("kode"=>"","keterangan"=>"<b>JUMLAH ARUS KAS DARI AKTIVITAS INVESTASI</b>","1"=>"","2"=>"","3"=>$jmlaktivitasinves,"4"=>"");
        $vare[] = array("kode"=>"","keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");
        

        //pembiayaan
        $vare[] = array("kode"=>"","keterangan"=>"<b>ARUS KAS DARI AKTIVITAS PEMBIAYAAN</b>","1"=>"","2"=>"","3"=>"","4"=>"");
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: SUMBER DANA</b>","1"=>"","2"=>"","3"=>"","4"=>"");
        $vdb    = $this->bdb->loadrekeningstt("p") ;
        $totpbysumberdana = 0 ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $sumberdana = $arrdatamutasi[$dbr['kode']]['sumberdana'];
            if($dbr['jenis'] == "I"){
                $dbr['kode'] = "<b>".$dbr['kode']."</b>";
                $dbr['keterangan'] = "<b>".$dbr['keterangan']."</b>";
            }else{
                $totpbysumberdana += $sumberdana;
            }
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>$sumberdana,"2"=>"","3"=>"","4"=>"");
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: JUMLAH SUMBER DANA</b>","1"=>"","2"=>$totpbysumberdana,"3"=>"","4"=>"");

        $vare[] = array("kode"=>"","keterangan"=>"<b>:: PENGGUNAAN</b>","1"=>"","2"=>"","3"=>"","4"=>"");
        $vdb    = $this->bdb->loadrekeningstt("p") ;
        $totpbypengunaan = 0 ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $penggunaan = $arrdatamutasi[$dbr['kode']]['penggunaan'];
            if($dbr['jenis'] == "I"){
                $dbr['kode'] = "<b>".$dbr['kode']."</b>";
                $dbr['keterangan'] = "<b>".$dbr['keterangan']."</b>";
            }else{
                $totpbypengunaan += $penggunaan;
            }
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>$penggunaan,"2"=>"","3"=>"","4"=>"");
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: JUMLAH PENGGUNAAN</b>","1"=>"","2"=>$totpbypengunaan,"3"=>"","4"=>"");
        $jmlaktivitaspby = $totpbysumberdana - $totpbypengunaan;
        $vare[] = array("kode"=>"","keterangan"=>"<b>JUMLAH ARUS KAS DARI AKTIVITAS PEMBIAYAAN</b>","1"=>"","2"=>$jmlaktivitaspby,"3"=>"","4"=>"");
        $vare[] = array("kode"=>"","keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");
        $totaktivitas = $jmlaktivitaspby + $jmlaktivitasopr + $jmlaktivitasinves;
        $vare[] = array("kode"=>"","keterangan"=>"<b>KAS ELEMENT KAS ".$tglakhir."</b>","1"=>"","2"=>"","3"=>"","4"=>$totaktivitas);

        //saldo kas akhir
        $vare[] = array("kode"=>"","keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");
        $vdb    = $this->bdb->loadrekeningstt("k","D") ;
        $vare[] = array("kode"=>"","keterangan"=>"<b>KAS ELEMENT KAS ".$tglakhir."</b>","1"=>"","2"=>"","3"=>"","4"=>"");
        $totsaldokasakhir = 0 ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldo = $this->perhitungan_m->getsaldo($tglakhir,$dbr['kode']);
            $totsaldokasakhir += $saldo;
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>"","2"=>"","3"=>$saldo,"4"=>"");
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>JUMLAH KAS ELEMENT KAS</b>","1"=>"","2"=>"","3"=>"","4"=>$totsaldokasakhir);

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

        $arrdatamutasi = $this->bdb->loadfakturtrkas($tglawal,$tglakhir);
        $vare   = array() ;
        $vdb    = $this->bdb->loadrekeningstt("k","D") ;
        $vare[] = array("kode"=>"","keterangan"=>"<b>KAS ELEMENT KAS ".$tglkemarin."</b>","1"=>"","2"=>"","3"=>"","4"=>"");
        $totsaldokasawal = 0;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldo = $this->perhitungan_m->getsaldo($tglkemarin,$dbr['kode']);
            $totsaldokasawal += $saldo;
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>"","2"=>"","3"=>string_2s($saldo),"4"=>"");
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>JUMLAH KAS ELEMENT KAS","1"=>"","2"=>"","3"=>"","4"=>string_2s($totsaldokasawal)."</b>");

        $vare[] = array("kode"=>"","keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");

        //OPERASI
        $vare[] = array("kode"=>"","keterangan"=>"<b>ARUS KAS DARI AKTIVITAS OPERASI","1"=>"","2"=>"","3"=>"","4"=>"</b>");
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: SUMBER DANA","1"=>"","2"=>"","3"=>"","4"=>"</b>");
        $vdb    = $this->bdb->loadrekeningstt("o") ;
        $totoprsumberdana = 0 ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $sumberdana = $arrdatamutasi[$dbr['kode']]['sumberdana'];
            if($dbr['jenis'] == "I"){
                $dbr['kode'] = "<b>".$dbr['kode'];
            }else{
                $totoprsumberdana += $sumberdana;
            }
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>string_2s($sumberdana),"2"=>"","3"=>"","4"=>"</b>");
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: JUMLAH SUMBER DANA</b>","1"=>"","2"=>string_2s($totoprsumberdana),"3"=>"","4"=>"</b>");

        $vare[] = array("kode"=>"","keterangan"=>"<b>:: PENGGUNAAN","1"=>"","2"=>"","3"=>"","4"=>"</b>");
        $vdb    = $this->bdb->loadrekeningstt("o") ;
        $totoprpenggunaan = 0 ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $penggunaan = $arrdatamutasi[$dbr['kode']]['penggunaan'];
            if($dbr['jenis'] == "I"){
                $dbr['kode'] = "<b>".$dbr['kode'];
            }else{
                $totoprpenggunaan += $penggunaan;
            }
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>string_2s($penggunaan),"2"=>"","3"=>"","4"=>"</b>");
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: JUMLAH PENGGUNAAN","1"=>"","2"=>string_2s($totoprpenggunaan),"3"=>"","4"=>"</b>");
        $jmlaktivitasopr = $totoprsumberdana - $totoprpenggunaan;
        $vare[] = array("kode"=>"","keterangan"=>"<b>JUMLAH ARUS KAS DARI AKTIVITAS OPERASI","1"=>"","2"=>"","3"=>string_2s($jmlaktivitasopr),"4"=>"</b>");
        $vare[] = array("kode"=>"","keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");

        //investasi
        $vare[] = array("kode"=>"","keterangan"=>"<b>ARUS KAS DARI AKTIVITAS INVESTASI","1"=>"","2"=>"","3"=>"","4"=>"</b>");
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: SUMBER DANA","1"=>"","2"=>"","3"=>"","4"=>"</b>");
        $vdb    = $this->bdb->loadrekeningstt("i") ;
        $totinvessumberdana = 0 ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $sumberdana = $arrdatamutasi[$dbr['kode']]['sumberdana'];
            if($dbr['jenis'] == "I"){
                $dbr['kode'] = "<b>".$dbr['kode'];
            }else{
                $totinvessumberdana += $sumberdana;
            }
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>string_2s($sumberdana),"2"=>"","3"=>"","4"=>"</b>");
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: JUMLAH SUMBER DANA","1"=>"","2"=>string_2s($totinvessumberdana),"3"=>"","4"=>"</b>");

        $vare[] = array("kode"=>"","keterangan"=>"<b>:: PENGGUNAAN","1"=>"","2"=>"","3"=>"","4"=>"</b>");
        $vdb    = $this->bdb->loadrekeningstt("i") ;
        $totinvespenggunaan = 0 ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $penggunaan = $arrdatamutasi[$dbr['kode']]['penggunaan'];
            if($dbr['jenis'] == "I"){
                $dbr['kode'] = "<b>".$dbr['kode'];
            }else{
                $totinvespenggunaan += $penggunaan;
            }
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>string_2s($penggunaan),"2"=>"","3"=>"","4"=>"</b>");
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: JUMLAH PENGGUNAAN","1"=>"","2"=>string_2s($totinvespenggunaan),"3"=>"","4"=>"</b>");
        $jmlaktivitasinves = $totinvessumberdana - $totinvespenggunaan;
        $vare[] = array("kode"=>"","keterangan"=>"<b>JUMLAH ARUS KAS DARI AKTIVITAS INVESTASI","1"=>"","2"=>"","3"=>string_2s($jmlaktivitasinves),"4"=>"</b>");
        $vare[] = array("kode"=>"","keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");
        

        //pembiayaan
        $vare[] = array("kode"=>"","keterangan"=>"<b>ARUS KAS DARI AKTIVITAS PEMBIAYAAN","1"=>"","2"=>"","3"=>"","4"=>"</b>");
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: SUMBER DANA","1"=>"","2"=>"","3"=>"","4"=>"</b>");
        $vdb    = $this->bdb->loadrekeningstt("p") ;
        $totpbysumberdana = 0 ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $sumberdana = $arrdatamutasi[$dbr['kode']]['sumberdana'];
            if($dbr['jenis'] == "I"){
                $dbr['kode'] = "<b>".$dbr['kode'];
            }else{
                $totpbysumberdana += $sumberdana;
            }
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>string_2s($sumberdana),"2"=>"","3"=>"","4"=>"</b>");
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: JUMLAH SUMBER DANA","1"=>"","2"=>string_2s($totpbysumberdana),"3"=>"","4"=>"</b>");

        $vare[] = array("kode"=>"","keterangan"=>"<b>:: PENGGUNAAN","1"=>"","2"=>"","3"=>"","4"=>"</b>");
        $vdb    = $this->bdb->loadrekeningstt("p") ;
        $totpbypengunaan = 0 ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $penggunaan = $arrdatamutasi[$dbr['kode']]['penggunaan'];
            if($dbr['jenis'] == "I"){
                $dbr['kode'] = "<b>".$dbr['kode'];
            }else{
                $totpbypengunaan += $penggunaan;
            }
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>string_2s($penggunaan),"2"=>"","3"=>"","4"=>"</b>");
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: JUMLAH PENGGUNAAN","1"=>"","2"=>string_2s($totpbypengunaan),"3"=>"","4"=>"</b>");
        $jmlaktivitaspby = $totpbysumberdana - $totpbypengunaan;
        $vare[] = array("kode"=>"","keterangan"=>"<b>JUMLAH ARUS KAS DARI AKTIVITAS PEMBIAYAAN","1"=>"","2"=>string_2s($jmlaktivitaspby),"3"=>"","4"=>"</b>");
        $vare[] = array("kode"=>"","keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");
        $totaktivitas = $jmlaktivitaspby + $jmlaktivitasopr + $jmlaktivitasinves;
        $vare[] = array("kode"=>"","keterangan"=>"<b>KAS ELEMENT KAS ".$tglakhir,"1"=>"","2"=>"","3"=>"","4"=>string_2s($totaktivitas)."</b>");

        //saldo kas akhir
        $vare[] = array("kode"=>"","keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");
        $vdb    = $this->bdb->loadrekeningstt("k","D") ;
        $vare[] = array("kode"=>"","keterangan"=>"<b>KAS ELEMENT KAS ".$tglakhir,"1"=>"","2"=>"","3"=>"","4"=>"</b>");
        $totsaldokasakhir = 0 ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldo = $this->perhitungan_m->getsaldo($tglakhir,$dbr['kode']);
            $totsaldokasakhir += $saldo;
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>"","2"=>"","3"=>string_2s($saldo),"4"=>"");
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>JUMLAH KAS ELEMENT KAS","1"=>"","2"=>"","3"=>"","4"=>string_2s($totsaldokasakhir)."</b>");
        savesession($this, "rptaruskas_rpt", json_encode($vare)) ; 
        echo(' bos.rptaruskas.openreport() ; ') ;
    }

    public function showreport(){
      $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
      $data = getsession($this,"rptaruskas_rpt") ;      
      $data = json_decode($data,true) ;       
      if(!empty($data)){ 
        $font = 10 ;
        $o    = array('paper'=>'A4', 'orientation'=>'l', 'export'=>"",
                        'opt'=>array('export_name'=>'DaftarNeraca_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>LAPORAN ARUS KAS</b>",$font+4,array("justification"=>"center")) ;
        $this->bospdf->ezText("Periode : ".$va['tglawal']." sd ". $va['tglakhir'],$font+2,array("justification"=>"center")) ;
    $this->bospdf->ezText("") ; 
    $this->bospdf->ezTable($data,"","",  
                array("showHeadings"=>"","showLines"=>"1","fontSize"=>$font,"cols"=> array( 
                                 "kode"=>array("caption"=>"Kode","width"=>15,"justification"=>"left"),
                                 "keterangan"=>array("caption"=>"Keterangan","wrap"=>1),
                           "1"=>array("caption"=>"","width"=>15,"justification"=>"right"),
                          "2"=>array("caption"=>"","width"=>13,"justification"=>"right"),
                           "3"=>array("caption"=>"","width"=>13,"justification"=>"right"),
                                 "4"=>array("caption"=>"","width"=>13,"justification"=>"right")))) ;   
        //print_r($data) ;    
        $this->bospdf->ezStream() ; 
      }else{
         echo('data kosong') ;
      }
   }
}
?>
