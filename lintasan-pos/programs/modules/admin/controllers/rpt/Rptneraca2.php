<?php
class Rptneraca2 extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model("rpt/rptneraca2_m") ;
        $this->load->model("func/perhitungan_m") ;
        $this->load->model("func/func_m") ;
        $this->bdb   = $this->rptneraca2_m ;
        $this->ss  = "ssrptneraca2_" ;
    }  

    public function index(){ 
        $this->load->view("rpt/rptneraca2") ; 

    }   

    public function loadgrid(){ 

        $va     = json_decode($this->input->post('request'), true) ; 
        $tglawal   = $va['tglawal'] ; //date("d-m-Y") ;
        $tglakhir   = $va['tglakhir'] ; //date("d-m-Y") ;
        $tglkemarin = date("d-m-Y",strtotime($tglawal)-(24*60*60)) ;
        $vare   = array() ; 

        // AKTIVA
        $n = 0 ;
        $totaktiva = array("saldoawal"=>0,"debet"=>0,"kredit"=>0,"saldoakhir"=>0);
        $vdb    = $this->perhitungan_m->loadrekening("1","1.9999") ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $vs = $dbr;  
            $vs['saldoawal'] = $this->perhitungan_m->getsaldoawal($tglawal,$vs['kode']) ; 
            $vs['debet'] = $this->perhitungan_m->getdebet($tglawal,$tglakhir,$vs['kode']) ;  
            $vs['kredit'] = $this->perhitungan_m->getkredit($tglawal,$tglakhir,$vs['kode']) ;        
            $vs['saldoakhir'] = $vs['saldoawal'] + $vs['debet'] - $vs['kredit'] ;

            //sum tot
            if($vs['jenis'] == "D"){
                $totaktiva["saldoawal"] += $vs['saldoawal'];
                $totaktiva["debet"] += $vs['debet'];
                $totaktiva["kredit"] += $vs['kredit'];
                $totaktiva["saldoakhir"] += $vs['saldoakhir'];
            }


            $arrkd = explode(".",$vs['kode']);
            $level = count($arrkd);
            //bold text
            if($vs['jenis'] == "I" and $va['level'] > $level){
                foreach($vs as $key => $val){
                    if($key == "kode" || $key == "keterangan")$vs[$key] = "<b>".$val."</b>";
                }
            }


            //susun array untuk struktur
            if($va['level'] >= $level){
                $n++;
                $saldoakhir = $vs['saldoakhir'];
                $saldoakhirinduk = 0;
                if($vs['jenis'] == "I" and $va['level'] > $level){
                    $saldoakhir = 0;
                    $saldoakhirinduk = $vs['saldoakhir'];
                }

                $vare[$n]    = array("kode1"=>$vs['kode'],"keterangan1"=>$vs['keterangan'],"saldoawal1"=>$vs['saldoawal'],
                                        "debet1"=>$vs['debet'],"kredit1"=>$vs['kredit'],
                                        "saldoakhir1"=>$saldoakhir,"saldoakhir1induk"=>$saldoakhirinduk,
                                        "batas"=>"","kode2"=>"","keterangan2"=>"","saldoawal2"=>"",
                                        "debet2"=>"","kredit2"=>"","saldoakhir2"=>"");

            }

        } 

        /* $vare[] = array("kode"=>"","keterangan"=>"<b>TOTAL AKTIVA</b>",
                  "saldoawal"=>"<b>".string_2s($totaktiva["saldoawal"])."</b>",
                                    "debet"=>"<b>".string_2s($totaktiva["debet"])."</b>",
                  "kredit"=>"<b>".string_2s($totaktiva["kredit"])."</b>",
                                    "saldoakhir"=>"<b>".string_2s($totaktiva["saldoakhir"])."</b>") ; */ 

        // PASIVA
        $np = 0 ;
        $reklrthnberjalan = $this->bdb->getconfig("reklrthberjalan");
        $reklrblnberjalan = $this->bdb->getconfig("reklrblnberjalan");

        $arrlr = $this->perhitungan_m->getlr($tglawal,$tglakhir);
        $totalpasiva = array("saldoawal"=>0,"debet"=>0,"kredit"=>0,"saldoakhir"=>0);
        $vdb    = $this->perhitungan_m->loadrekening("2","3.9999") ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $vs = $dbr;  
            $vs['saldoawal'] = $this->perhitungan_m->getsaldoawal($tglawal,$vs['kode']) ; 
            $vs['debet'] = $this->perhitungan_m->getdebet($tglawal,$tglakhir,$vs['kode']) ;  
            $vs['kredit'] = $this->perhitungan_m->getkredit($tglawal,$tglakhir,$vs['kode']) ;        
            $vs['saldoakhir'] = $vs['saldoawal'] + $vs['kredit'] - $vs['debet'] ;

            if(substr($reklrthnberjalan,0,strlen($vs['kode'])) == substr($vs['kode'],0,strlen($vs['kode']))){
                $vs['saldoawal'] += 0; 
                $vs['debet'] += 0; 
                $vs['kredit'] += 0; 
                $vs['saldoakhir'] += $arrlr['lrstlhpjk']['saldoawal']; 
            }

            if(substr($reklrblnberjalan,0,strlen($vs['kode'])) == substr($vs['kode'],0,strlen($vs['kode']))){
                $vs['saldoawal'] += 0; 
                $vs['debet'] += 0; 
                $vs['kredit'] += 0; 
                $vs['saldoakhir'] += $arrlr['lrstlhpjk']['saldoakhirperiod']; 
            }

            //sum tot
            if($vs['jenis'] == "D"){
                $totalpasiva["saldoawal"] += $vs['saldoawal'];
                $totalpasiva["debet"] += $vs['debet'];
                $totalpasiva["kredit"] += $vs['kredit'];
                $totalpasiva["saldoakhir"] += $vs['saldoakhir'];
            }

            $arrkd = explode(".",$vs['kode']);
            $level = count($arrkd);
            //bold text
            if($vs['jenis'] == "I" and $va['level'] > $level){
                foreach($vs as $key => $val){
                    if($key == "kode" || $key == "keterangan")$vs[$key] = "<b>".$val."</b>";
                }
            }


            if($va['level'] >= $level){
                $np++;
                if(!isset($vare[$np])){
                    $vare[$np]    = array("kode1"=>"","keterangan1"=>"","saldoawal1"=>"",
                                            "debet1"=>"","kredit1"=>"","saldoakhir1"=>"","saldoakhir1induk"=>"",
                                            "batas"=>"","kode2"=>"","keterangan2"=>"","saldoawal2"=>"",
                                            "debet2"=>"","kredit2"=>"","saldoakhir2"=>"","saldoakhir2induk"=>"");
                }
                
                $saldoakhir = $vs['saldoakhir'];
                $saldoakhirinduk = 0;
                if($vs['jenis'] == "I" and $va['level'] > $level){
                    $saldoakhir = 0;
                    $saldoakhirinduk = $vs['saldoakhir'];
                }

                $vare[$np]["kode2"]= $vs['kode'];
                $vare[$np]["keterangan2"]= $vs['keterangan'];
                $vare[$np]["saldoawal2"]= $vs['saldoawal'];
                $vare[$np]["debet2"]= $vs['debet'];
                $vare[$np]["kredit2"]= $vs['kredit'];
                $vare[$np]["saldoakhir2"]= $saldoakhir;
                $vare[$np]["saldoakhir2induk"]= $saldoakhirinduk;
            }

        } 
        $max = max($n,$np);
        $max++;
        $vare[$max] = array("kode1"=>"","keterangan1"=>"<b>Total Aktiva</b>","saldoawal1"=>$totaktiva["saldoawal"],
                            "debet1"=>$totaktiva["debet"],"kredit1"=>$totaktiva["kredit"],
                            "saldoakhir1"=>"","saldoakhir1induk"=>$totaktiva["saldoakhir"],
                            "batas"=>"","kode2"=>"","keterangan2"=>"<b>Total Pasiva</b>","saldoawal2"=>$totalpasiva["saldoawal"] ,
                            "debet2"=>$totalpasiva["debet"] ,"kredit2"=>$totalpasiva["kredit"] ,
                            "saldoakhir2"=>"","saldoakhir2induk"=>$totalpasiva["saldoakhir"] ,"w2ui"=>array("summary"=>true));
        /* $vare[] = array("kode"=>"","keterangan"=>"<b>TOTAL PASIVA</b>",
                  "saldoawal"=>"<b>".string_2s($totaktiva["saldoawal"])."</b>",
                                    "debet"=>"<b>".string_2s($totaktiva["debet"])."</b>",
                  "kredit"=>"<b>".string_2s($totaktiva["kredit"])."</b>",
                                    "saldoakhir"=>"<b>".string_2s($totaktiva["saldoakhir"])."</b>") ;*/
        $vare2 = array();
        foreach($vare as $key => $val){
            $vare2[] = $val;
        }
        $vare2   = array("total"=>count($vare2)-1, "records"=>$vare2) ; 
        echo(json_encode($vare2)) ; 
    }

    public function init(){
        savesession($this, "ssrptneraca_id", "") ;    
    }

    public function initreport(){
        $n=0;
        $va     = $this->input->post() ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;

        $tglawal   = $va['tglawal'] ; //date("d-m-Y") ;
        $tglakhir   = $va['tglakhir'] ; //date("d-m-Y") ;
        $tglkemarin = date("d-m-Y",strtotime($tglawal)-(24*60*60)) ;
        $vare   = array() ; 

        // AKTIVA
        $n=0;
        $totaktiva = array("saldoawal"=>0,"debet"=>0,"kredit"=>0,"saldoakhir"=>0);
        $vdb    = $this->perhitungan_m->loadrekening("1","1.9999") ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $vs = $dbr;  
            $vs['saldoawal'] = $this->perhitungan_m->getsaldo($tglkemarin,$vs['kode']) ; 
            $vs['debet'] = $this->perhitungan_m->getdebet($tglawal,$tglakhir,$vs['kode']) ;  
            $vs['kredit'] = $this->perhitungan_m->getkredit($tglawal,$tglakhir,$vs['kode']) ;        
            $vs['saldoakhir'] = $vs['saldoawal'] + $vs['debet'] - $vs['kredit'] ;

            //sum tot
            if($vs['jenis'] == "D"){
                $totaktiva["saldoawal"] += $vs['saldoawal'];
                $totaktiva["debet"] += $vs['debet'];
                $totaktiva["kredit"] += $vs['kredit'];
                $totaktiva["saldoakhir"] += $vs['saldoakhir'];
            }

            $vs['saldoawal'] = string_2s($vs['saldoawal']) ; 
            $vs['debet'] = string_2s($vs['debet']) ; 
            $vs['kredit'] = string_2s($vs['kredit']) ; 
            $vs['saldoakhir'] = string_2s($vs['saldoakhir']) ; 

            //bold text
            $arrkd = explode(".",$vs['kode']);
            $level = count($arrkd);

            if($va['level'] >= $level){
                $n++;

                $saldoakhir = $vs['saldoakhir'];
                $saldoakhirinduk = "";
                if($vs['jenis'] == "I" and $va['level'] > $level){
                    $saldoakhir = "";
                    $saldoakhirinduk = $vs['saldoakhir']."</b>";
                    $vs['kode'] = "<b>".$vs['kode'];
                }


                $vare[$n]    = array("kode1"=>$vs['kode'],"keterangan1"=>$vs['keterangan'],"saldoawal1"=>$vs['saldoawal'],
                                        "debet1"=>$vs['debet'],"kredit1"=>$vs['kredit'],
                                        "saldoakhir1"=>$saldoakhir,"saldoakhir1induk"=>$saldoakhirinduk,
                                        "batas"=>"","kode2"=>"","keterangan2"=>"","saldoawal2"=>"",
                                        "debet2"=>"","kredit2"=>"","saldoakhir2"=>"","saldoakhir2induk"=>"");
            }
        } 

        /*$vare[] = array("kode"=>"","keterangan"=>"<b>TOTAL AKTIVA</b>",
                  "saldoawal"=>"<b>".string_2s($totaktiva["saldoawal"])."</b>",
                                    "debet"=>"<b>".string_2s($totaktiva["debet"])."</b>",
                  "kredit"=>"<b>".string_2s($totaktiva["kredit"])."</b>",
                                    "saldoakhir"=>"<b>".string_2s($totaktiva["saldoakhir"])."</b>") ;  */

        // PASIVA
        $np=0;
        $reklrthnberjalan = $this->bdb->getconfig("reklrthberjalan");
        $reklrblnberjalan = $this->bdb->getconfig("reklrblnberjalan");
        $arrlr = $this->perhitungan_m->getlr($tglawal,$tglakhir);
        $totpasiva = array("saldoawal"=>0,"debet"=>0,"kredit"=>0,"saldoakhir"=>0);
        $vdb    = $this->perhitungan_m->loadrekening("2","3.9999") ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $vs = $dbr;  
            $vs['saldoawal'] = $this->perhitungan_m->getsaldo($tglkemarin,$vs['kode']) ; 
            $vs['debet'] = $this->perhitungan_m->getdebet($tglawal,$tglakhir,$vs['kode']) ;  
            $vs['kredit'] = $this->perhitungan_m->getkredit($tglawal,$tglakhir,$vs['kode']) ;        
            $vs['saldoakhir'] = $vs['saldoawal'] + $vs['kredit'] - $vs['debet'] ;

            if(substr($reklrthnberjalan,0,strlen($vs['kode'])) == substr($vs['kode'],0,strlen($vs['kode']))){
                $vs['saldoawal'] += 0; 
                $vs['debet'] += 0; 
                $vs['kredit'] += 0; 
                $vs['saldoakhir'] += $arrlr['lrstlhpjk']['saldoawal']; 
            }

            if(substr($reklrblnberjalan,0,strlen($vs['kode'])) == substr($vs['kode'],0,strlen($vs['kode']))){
                $vs['saldoawal'] += 0; 
                $vs['debet'] += 0; 
                $vs['kredit'] += 0; 
                $vs['saldoakhir'] += $arrlr['lrstlhpjk']['saldoakhirperiod']; 
            }



            //sum tot
            if($vs['jenis'] == "D"){
                $totpasiva["saldoawal"] += $vs['saldoawal'];
                $totpasiva["debet"] += $vs['debet'];
                $totpasiva["kredit"] += $vs['kredit'];
                $totpasiva["saldoakhir"] += $vs['saldoakhir'];
            }

            $vs['saldoawal'] = string_2s($vs['saldoawal']) ; 
            $vs['debet'] = string_2s($vs['debet']) ; 
            $vs['kredit'] = string_2s($vs['kredit']) ; 
            $vs['saldoakhir'] = string_2s($vs['saldoakhir']) ; 


            $arrkd = explode(".",$vs['kode']);
            $level = count($arrkd);
            if($va['level'] >= $level){
                $np++;




                if(!isset($vare[$np])){
                    $vare[$np]    = array("kode1"=>"","keterangan1"=>"","saldoawal1"=>"",
                                            "debet1"=>"","kredit1"=>"","saldoakhir1"=>"","saldoakhir1induk"=>"",
                                            "batas"=>"","kode2"=>"","keterangan2"=>"","saldoawal2"=>"",
                                            "debet2"=>"","kredit2"=>"","saldoakhir2"=>"","saldoakhir2induk"=>"");
                }
                
                $saldoakhir = $vs['saldoakhir'];
                $saldoakhirinduk = "";
                if($vs['jenis'] == "I" and $va['level'] > $level){
                    $saldoakhir = "";
                    $saldoakhirinduk = $vs['saldoakhir']."</b>";
                    $vs['kode'] = "<b>".$vs['kode'];
                }
                $vare[$np]["kode2"]= $vs['kode'];
                $vare[$np]["keterangan2"]= $vs['keterangan'];
                $vare[$np]["saldoawal2"]= $vs['saldoawal'];
                $vare[$np]["debet2"]= $vs['debet'];
                $vare[$np]["kredit2"]= $vs['kredit'];
                $vare[$np]["saldoakhir2"]= $saldoakhir;
                $vare[$np]["saldoakhir2induk"]= $saldoakhirinduk;
            }
        } 

        $max = max($n,$np);
        $max++;
        $vare[$max] = array("kode1"=>"","keterangan1"=>"<b>Total Aktiva</b>","saldoawal1"=>"<b>".string_2s($totaktiva["saldoawal"])."</b>",
                            "debet1"=>"<b>".string_2s($totaktiva["debet"])."</b>","kredit1"=>"<b>".string_2s($totaktiva["kredit"])."</b>",
                            "saldoakhir1"=>"","saldoakhir1induk"=>"<b>".string_2s($totaktiva["saldoakhir"])."</b>",
                            "batas"=>"","kode2"=>"","keterangan2"=>"<b>Total Pasiva</b>","saldoawal2"=>"<b>".string_2s($totpasiva["saldoawal"])."</b>",
                            "debet2"=>"<b>".string_2s($totpasiva["debet"])."</b>" ,"kredit2"=>"<b>".string_2s($totpasiva["kredit"])."</b>",
                            "saldoakhir2"=>"","saldoakhir2induk"=>"<b>".string_2s($totpasiva["saldoakhir"])."</b>");
        /*$vare[] = array("kode"=>"","keterangan"=>"<b>TOTAL PASIVA</b>",
                  "saldoawal"=>"<b>".string_2s($totaktiva["saldoawal"])."</b>",
                                    "debet"=>"<b>".string_2s($totaktiva["debet"])."</b>",
                  "kredit"=>"<b>".string_2s($totaktiva["kredit"])."</b>",
                                    "saldoakhir"=>"<b>".string_2s($totaktiva["saldoakhir"])."</b>") ;  */

        savesession($this, "rptneraca2_rpt", json_encode($vare)) ; 
        echo(' bos.rptneraca2.openreport() ; ') ;
    }

    public function showreport(){
        $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
        $data = getsession($this,"rptneraca2_rpt") ;      
        $data = json_decode($data,true) ;
        foreach($data as $key => $val){
            unset($data[$key]['saldoawal1']);
            unset($data[$key]['debet1']);
            unset($data[$key]['kredit1']);
            unset($data[$key]['saldoawal2']);
            unset($data[$key]['debet2']);
            unset($data[$key]['kredit2']);

        }
        if(!empty($data)){ 
            $font = 8 ;
            $o    = array('paper'=>'A4', 'orientation'=>'landscape', 'export'=>$va['export'],
                          'opt'=>array('export_name'=>'DaftarNeraca_' . getsession($this, "username") ) ) ;
            $this->load->library('bospdf', $o) ;   
            $cabang = getsession($this,"cabang");
            $arrcab = $this->func_m->GetDataCabang($cabang);
            $this->bospdf->ezText($arrcab['kode'] ." - ".$arrcab['nama'],$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText($arrcab['alamat'] . " / ". $arrcab['telp'],$font,array("justification"=>"center")) ;
            $this->bospdf->ezText("<b>NERACA</b>",$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText("Tgl : ".$va['tglakhir'],$font+2,array("justification"=>"center")) ;
            $this->bospdf->line(30,515,820,515);
            $this->bospdf->ezText("") ; 
            $this->bospdf->ezTable($data,"","",  
                                   array("showLines"=>0,"showHeadings"=>"","fontSize"=>$font,"cols"=> array( 
                                       "kode1"=>array("caption"=>"Kode","width"=>6),
                                       "keterangan1"=>array("caption"=>"Keterangan","wrap"=>1),
                                       "saldoawal1"=>array("caption"=>"Saldo Awal","width"=>8,"justification"=>"right"),
                                       "debet1"=>array("caption"=>"Debet","width"=>8,"justification"=>"right"),
                                       "kredit1"=>array("caption"=>"Kredit","width"=>8,"justification"=>"right"),
                                       "saldoakhir1"=>array("caption"=>"Saldo Akhir","width"=>10,"justification"=>"right"),
                                       "saldoakhir1induk"=>array("caption"=>"Saldo Akhir","width"=>10,"justification"=>"right"),
                                       "batas"=>array("caption"=>"","width"=>4),
                                       "kode2"=>array("caption"=>"Kode","width"=>6),
                                       "keterangan2"=>array("caption"=>"Keterangan","wrap"=>1),
                                       "saldoawal2"=>array("caption"=>"Saldo Awal","width"=>8,"justification"=>"right"),
                                       "debet2"=>array("caption"=>"Debet","width"=>8,"justification"=>"right"),
                                       "kredit2"=>array("caption"=>"Kredit","width"=>8,"justification"=>"right"),
                                       "saldoakhir2"=>array("caption"=>"Saldo Akhir","width"=>10,"justification"=>"right"),
                                       "saldoakhir2induk"=>array("caption"=>"Saldo Akhir","width"=>10,"justification"=>"right")
                                   ))) ;   
            //print_r($data) ;    
            $this->bospdf->ezStream() ; 
        }else{
            echo('data kosong') ;
        }
    }

}
?>
