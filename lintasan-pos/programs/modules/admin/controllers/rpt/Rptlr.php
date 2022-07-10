<?php
class Rptlr extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model("rpt/rptlr_m") ;
        $this->load->model("func/perhitungan_m") ;
        $this->load->model("func/func_m") ;
        $this->bdb   = $this->rptlr_m ;
        $this->ss  = "ssrptlr_" ;
    }  

    public function index(){
        $this->load->view("rpt/rptlr") ; 

    }   

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $rrlr = $this->perhitungan_m->getlr($va['tglawal'],$va['tglakhir'],$va['level']);

        $data = array();
        foreach($rrlr['records'] as $key => $val){
            $saldoakhirperiodinduk = "";
            $arrkd = explode(".",$val['kode']);
            $level = count($arrkd);
            if($val['jenis'] == "I" and $va['level'] > $level){
                $saldoakhirperiodinduk = $val['saldoakhirperiod'];
                $val['saldoakhirperiod'] = "";
            }
            unset($val['saldoawal']);
            unset($val['debet']);
            unset($val['kredit']);
            unset($val['saldoakhir']);
            unset($val['jenis']);

            $data[] = array("kode"=>$val['kode'],"keterangan"=>$val['keterangan'],
                            "saldoakhirperiod"=>$val['saldoakhirperiod'],"saldoakhirperiodinduk"=>$saldoakhirperiodinduk);
        }

        $vare   = array("total"=>$rrlr['total'],"records"=>$data) ;
        echo(json_encode($vare)) ; 

    }

    public function initreport(){
        $n=0;
        $va     = $this->input->post() ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;
        $rrlr = $this->perhitungan_m->getlr($va['tglawal'],$va['tglakhir'],$va['level']);
        $data = array();
        foreach($rrlr['records'] as $key => $val){
            $saldoakhirperiodinduk = "";
            $arrkd = explode(".",$val['kode']);
            $level = count($arrkd);
            if($val['jenis'] == "I" and $va['level'] > $level){
                $saldoakhirperiodinduk = $val['saldoakhirperiod'];
                $val['saldoakhirperiod'] = "";
            }
            unset($val['saldoawal']);
            unset($val['debet']);
            unset($val['kredit']);
            unset($val['saldoakhir']);
            unset($val['jenis']);

            $data[] = array("kode"=>$val['kode'],"keterangan"=>$val['keterangan'],
                            "saldoakhirperiod"=>$val['saldoakhirperiod'],"saldoakhirperiodinduk"=>$saldoakhirperiodinduk);
        }
        savesession($this, "rptlabarugi_rpt", json_encode($data)) ; 
        echo(' bos.rptlr.openreport() ; ') ;
    }

    public function showreport(){
        $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
        $data = getsession($this,"rptlabarugi_rpt") ;      
        $data = json_decode($data,true) ;       
        if(!empty($data)){ 
            $font = 8 ;
            $o    = array('paper'=>'FOLIO', 'orientation'=>'portrait', 'export'=>$va['export'],
                          'opt'=>array('export_name'=>'DaftarLabaRugi_' . getsession($this, "username") ) ) ;
            $this->load->library('bospdf', $o) ;
            $cabang = getsession($this,"cabang");
            $arrcab = $this->func_m->GetDataCabang($cabang);
            $this->bospdf->ezText($arrcab['kode'] ." - ".$arrcab['nama'],$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText($arrcab['alamat'] . " / ". $arrcab['telp'],$font,array("justification"=>"center")) ;

            $this->bospdf->ezText("<b>LABA RUGI</b>",$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText("Untuk Periode Antara : ".$va['tglawal']." sd ".$va['tglakhir'],$font+2,array("justification"=>"center")) ;
            $this->bospdf->line(30,850,595,850);
            $this->bospdf->ezText("") ; 
            $this->bospdf->ezTable($data,"","",  
                                   array("showHeadings"=>"","showLines"=>"0","fontSize"=>$font,"cols"=> array( 
                                       "kode"=>array("caption"=>"Tgl","width"=>10),
                                       "keterangan"=>array("caption"=>"Keterangan","wrap"=>1),
                                       "saldoawal"=>array("caption"=>"Saldo Awal","width"=>0,"justification"=>"right"),
                                       "debet"=>array("caption"=>"Debet","width"=>0,"justification"=>"right"),
                                       "kredit"=>array("caption"=>"Kredit","width"=>0,"justification"=>"right"),
                                       "saldoakhirperiod"=>array("caption"=>"Saldo Akhir","width"=>15,"justification"=>"right"),
                                       "saldoakhirperiodinduk"=>array("caption"=>"Saldo Akhir","width"=>15,"justification"=>"right")))) ;   
            //print_r($data) ;    
            $this->bospdf->ezStream() ; 
        }else{
            echo('data kosong') ;
        }
    }

}
?>
