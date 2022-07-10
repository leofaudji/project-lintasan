<?php

class Rptmarginpenjualanproduk extends Bismillah_Controller{
    protected $bdb ;
    protected $ss ;
    protected $abc ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper('bdate');
        $this->load->model('rpt/rptmarginpenjualanproduk_m') ;
        $this->load->model('func/perhitungan_m') ;
        $this->bdb = $this->rptmarginpenjualanproduk_m ;
        $this->ss  = "ssrptmarginpenjualanproduk_" ;
    }

    public function index(){
        $d    = array("setdate"=>date_set()) ;
        $this->load->view('rpt/rptmarginpenjualanproduk', $d) ;
    }

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $va['tglawal'] = date_2s($va['tglawal']);
		$va['tglakhir'] = date_2s($va['tglakhir']);
        $vdb    = $this->rptmarginpenjualanproduk_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        $n = 0 ;
		$totpenjualan = 0 ;
		$tothpp = 0 ;
		$totmargin = 0 ;
		$persmargin = 0 ;
        while( $dbr = $this->rptmarginpenjualanproduk_m->getrow($dbd) ){
            $n++;
            $vaset = $dbr;
			$arrmp = $this->perhitungan_m->analisapenjualanproduk($dbr['kode'],$va['tglawal'],$va['tglakhir']);
            $vaset['no'] = $n;
			$vaset['penjualan'] = $arrmp['penjualan'];
			$vaset['hpp'] = $arrmp['hpp'];
			$vaset['margin'] = $arrmp['margin'];
			$vaset['persmargin'] = $arrmp['persmargin'];
            $vare[]     = $vaset ;
			
			$totpenjualan += $vaset['penjualan'] ;
			$tothpp 		+= $vaset['hpp'] ;
			
			
			
        }
		$totmargin = $totpenjualan - $tothpp;
		$persmargin = devide($totmargin,$totpenjualan) * 100;
		$vare[] = array("recid"=>'ZZZZ',"no"=> '', "kode"=> '', "keterangan"=> 'TOTAL','satuan'=>'',
                        "penjualan"=>$totpenjualan,"hpp"=>$tothpp,"margin"=>$totmargin,"persmargin"=>$persmargin,"w2ui"=>array("summary"=> true));
        
        $vare    = array("total"=>count($vare) - 1, "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
	
	public function initreport(){
	  $va     = $this->input->post() ;
      savesession($this, $this->ss . "va", json_encode($va) ) ;
      $vare   = array() ;
      $va['tglawal'] = date_2s($va['tglawal']);
		$va['tglakhir'] = date_2s($va['tglakhir']);
        $vdb    = $this->rptmarginpenjualanproduk_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        $n = 0 ;
		$totpenjualan = 0 ;
		$tothpp = 0 ;
		$totmargin = 0 ;
		$persmargin = 0 ;
        while( $dbr = $this->rptmarginpenjualanproduk_m->getrow($dbd) ){
            $n++;
            $vaset = $dbr;
			$arrmp = $this->perhitungan_m->analisapenjualanproduk($dbr['kode'],$va['tglawal'],$va['tglakhir']);
			$vaset['penjualan'] = string_2s($arrmp['penjualan']);
			$vaset['hpp'] = string_2s($arrmp['hpp']);
			$vaset['margin'] = string_2s($arrmp['margin']);
			$vaset['persmargin'] = string_2s($arrmp['persmargin']);
            $vare[]     = array("no"=>$n,"kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"satuan"=>$dbr['satuan'],
								"penjualan"=>string_2s($arrmp['penjualan']),"hpp"=>string_2s($arrmp['hpp']),
								"margin"=>string_2s($arrmp['margin']),"persmargin"=>string_2s($arrmp['persmargin']));
			
			
			
        }
      savesession($this, "rptmarginpenjualanproduk_rpt", json_encode($vare)) ;
      echo(' bos.rptmarginpenjualanproduk.openreport() ; ') ;
	}
	public function showreport(){
      $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
      $data = getsession($this,"rptmarginpenjualanproduk_rpt") ;      
      $data = json_decode($data,true) ;    
	  
	  $totpenjualan = 0 ;
		$tothpp = 0 ;
		$totmargin = 0 ;
		$persmargin = 0 ;
	  foreach($data as $key => $val){
		$totpenjualan += string_2n($val['penjualan']);
		$tothpp += string_2n($val['hpp']);
	  }
	  $totmargin = $totpenjualan - $tothpp ;
	  $persmargin = devide($totmargin,$totpenjualan) * 100;
	  
	  $vatotal[] = array("keterangan"=>"<b>Total",
								"penjualan"=>string_2s($totpenjualan),"hpp"=>string_2s($tothpp),
								"margin"=>string_2s($totmargin),"persmargin"=>string_2s($persmargin)."</b>");
      if(!empty($data)){ 
      	$font = 8 ;
        $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'DaftarBukuBesar_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>LAPORAN MARGIN PENJUALAN PRODUK</b>",$font+4,array("justification"=>"center")) ;
        $this->bospdf->ezText("Periode : ". $va['tglawal'] . " sd " . $va['tglakhir'],$font+2,array("justification"=>"center")) ;
		$this->bospdf->ezText("") ; 
		$this->bospdf->ezTable($data,"","",  
								array("fontSize"=>$font,"cols"=> array( 
			                     "no"=>array("caption"=>"No","width"=>5,"justification"=>"right"),
			                     "kode"=>array("caption"=>"Kode","width"=>10,"justification"=>"center"),
			                     "keterangan"=>array("caption"=>"Keterangan","justification"=>"left"),
			                     "satuan"=>array("caption"=>"Satuan","width"=>8),
			                     "penjualan"=>array("caption"=>"Penjualan","width"=>13,"justification"=>"right"),
								 "hpp"=>array("caption"=>"HPP","width"=>13,"justification"=>"right"),
								 "margin"=>array("caption"=>"Margin","width"=>13,"justification"=>"right"),
			                     "persmargin"=>array("caption"=>"% Margin","width"=>13,"justification"=>"right")))) ;
								
		$this->bospdf->ezTable($vatotal,"","",  
								array("fontSize"=>$font,"showHeadings"=>0,"cols"=> array( 
								"keterangan"=>array("caption"=>"Keterangan","justification"=>"center"),
			                     "penjualan"=>array("caption"=>"Penjualan","width"=>13,"justification"=>"right"),
								 "hpp"=>array("caption"=>"HPP","width"=>13,"justification"=>"right"),
								 "margin"=>array("caption"=>"Margin","width"=>13,"justification"=>"right"),
			                     "persmargin"=>array("caption"=>"% Margin","width"=>13,"justification"=>"right")))) ;
        //print_r($data) ;    
        $this->bospdf->ezStream() ; 
      }else{
         echo('data kosong') ;
      }
	}
}

?>
