<?php

class rptindexpenjualanstock extends Bismillah_Controller{
    protected $bdb ;
    protected $ss ;
    protected $abc ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper('bdate');
        $this->load->model('rpt/rptindexpenjualanstock_m') ;
        $this->load->model('func/perhitungan_m') ;
        $this->load->model('func/func_m') ;
        $this->bdb = $this->rptindexpenjualanstock_m ;
        $this->ss  = "ssrptindexpenjualanstock_" ;
    }

    public function index(){
        $d    = array("setdate"=>date_set()) ;
        $this->load->view('rpt/rptindexpenjualanstock', $d) ;
    }

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $va['tglawal'] = date_2s($va['tglawal']);
        $va['tglakhir'] = date_2s($va['tglakhir']);
        $vdb    = $this->rptindexpenjualanstock_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        $n = 0 ;
		$total = 0 ;
        while( $dbr = $this->rptindexpenjualanstock_m->getrow($dbd) ){
            $supplier = $this->perhitungan_m->getsupplierpembelianstockterakhir($dbr['kode'],$va['tglakhir']) ;
            if($supplier == $va['supplier'] || trim($va['supplier']) == ""){
                $n++;
                $vaset = $dbr;
                $vaset['saldo'] = $this->perhitungan_m->GetSaldoAkhirStock($dbr['kode'],$va['tglakhir']) ;
                $arrsupplier = $this->func_m->GetKeterangan($supplier,"nama","supplier");
                $vaset['supplier'] = $arrsupplier['nama'];
                $vaset['no'] = $n;
                $vare[]     = $vaset ;
            }

        }
		$vare    = array("total"=>count($vare), "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function seeksupplier(){
        $search     = $this->input->get('q');
        $vdb    = $this->rptindexpenjualanstock_m->seeksupplier($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        $vare[] 	= array("id"=>" ", "text"=>"Semua Supplier") ;
        while( $dbr = $this->rptindexpenjualanstock_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ".$dbr['nama']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function initreport(){
        $arr = array();

        $va     = $this->input->post() ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;
        $vdb    = $this->rptindexpenjualanstock_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        $n= 0 ;
        while($dbr = $this->rptindexpenjualanstock_m->getrow($dbd)){
            $supplier = $this->perhitungan_m->getsupplierpembelianstockterakhir($dbr['kode'],$va['tglakhir']) ;
            if($supplier == $va['supplier'] || trim($va['supplier']) == ""){
                $n++;
                $vaset = $dbr;
                $vaset['no'] = $n;
                $saldo = $this->perhitungan_m->GetSaldoAkhirStock($dbr['kode'],$va['tglakhir']) ;

                $arrsupplier = $this->func_m->GetKeterangan($supplier,"nama","supplier");


                $arr[]     = array("no"=>$n,"kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],
                                   "satuan"=>$dbr['satuan'],"qtypj"=>string_2s($dbr['qtypj']),
                                   "saldo"=>string_2s($saldo),"supplier"=>$arrsupplier['nama']);
            }



        }
                 
        savesession($this, "rptindexpenjualanstock_rpt", json_encode($arr)) ;
        echo(' bos.rptindexpenjualanstock.openreport();') ;
    }
                 
    public function showreport(){
        $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
        $data = getsession($this,"rptindexpenjualanstock_rpt") ;      
        $data = json_decode($data,true) ;

        if(!empty($data)){ 
            $font = 8 ;
            $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                          'opt'=>array('export_name'=>'IndesPJStock_' . getsession($this, "username") ) ) ;
            $this->load->library('bospdf', $o) ;   
            $this->bospdf->ezText("<b>LAPORAN INDEX PENJUALAN STOCK</b>",$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText("Periode Tanggal : ". $va['tglawal'] . " sd ". $va['tglakhir'],$font+2,array("justification"=>"center")) ;
            $this->bospdf->ezText("") ; 
            $totpersd = 0 ;

            $this->bospdf->ezTable($data,"","",  
                                   array("fontSize"=>$font,"cols"=> array( 
                                       "no"=>array("caption"=>"No","width"=>5,"justification"=>"right"),
                                       "kode"=>array("caption"=>"Kode","width"=>10,"justification"=>"center"),
                                       "keterangan"=>array("caption"=>"Keterangan","justification"=>"left"),
                                       "satuan"=>array("caption"=>"Satuan","width"=>6,"justification"=>"center"),
                                       "qtypj"=>array("caption"=>"Qty","width"=>15,"justification"=>"right"),
                                       "saldo"=>array("caption"=>"Saldo","width"=>15,"justification"=>"right"),
                                       "supplier"=>array("caption"=>"Keterangan","justification"=>"left")))) ; 

            $this->bospdf->ezStream() ; 
        }else{
            echo('data kosong') ;
        }
    }
}

?>
