<?php

class Rptkartustock extends Bismillah_Controller{
    protected $bdb ;
    protected $ss ;
    protected $abc ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper('bdate');
        $this->load->model('rpt/rptkartustock_m') ;
        $this->load->model('func/perhitungan_m') ;
        $this->bdb = $this->rptkartustock_m ;
        $this->ss  = "ssrptkartustock_" ;
    }

    public function index(){
        $d    = array("setdate"=>date_set()) ;
        $this->load->view('rpt/rptkartustock', $d) ;
    }

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $va['tglAwal'] = date_2s($va['tglAwal']);
        $va['tglAkhir'] = date_2s($va['tglAkhir']);
        $vdb    = $this->rptkartustock_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        $tglKemarin = date("Y-m-d",strtotime($va['tglAwal'])-(60*60*24));
        $saldo = $this->perhitungan_m->GetSaldoAkhirStock($va['stock'],$tglKemarin) ; ;
        $n = 0 ;
        $vare[] = array("no"=>"","faktur"=>"","tgl"=>"","keterangan"=>"Saldo Awal","debet"=>"","kredit"=>"","saldo"=>$saldo);
        while( $dbr = $this->rptkartustock_m->getrow($dbd) ){
            $n++;
            $saldo += $dbr['debet'] - $dbr['kredit'];
            $vaset   = $dbr ;
            $vaset['no'] = $n;
            $vaset['saldo'] = $saldo;
            $vaset['tgl'] = date_2d($vaset['tgl']);
            $vare[]     = $vaset ;
        }

        $vare    = array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function pilihstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->rptkartustock_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.rptkartustock.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               bos.rptkartustock.loadmodelstock("hide");
            }

         ') ;
        }
    }

    public function seekstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['stock'] ;
        $data = $this->rptkartustock_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.rptkartustock.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
            }

         ') ;
        }else{
            echo('
                alert("data tidak ditemukan !!!");
                with(bos.rptkartustock.obj){
                    find("#stock").val("") ;
                    find("#stock").focus() ;
                }
            ');
        }
    }
    
    public function loadgrid2(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->rptkartustock_m->loadgrid2($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->rptkartustock_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.rptkartustock.cmdpilih(\''.$dbr['kode'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
    
    public function initreport(){
        $arr = array();

        $va     = $this->input->post() ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;
        $vare   = array() ;
        $va['tglAwal'] = date_2s($va['tglawal']);
        $va['tglAkhir'] = date_2s($va['tglakhir']);
        $vdb    = $this->rptkartustock_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        $tglKemarin = date("Y-m-d",strtotime($va['tglAwal'])-(60*60*24));
        $saldo = $this->perhitungan_m->GetSaldoAkhirStock($va['stock'],$tglKemarin) ; ;
        $n = 0 ;
        $vare[] = array("no"=>"","faktur"=>"","tgl"=>"","keterangan"=>"Saldo Awal","debet"=>"0","kredit"=>"0","saldo"=>$saldo);
        while( $dbr = $this->rptkartustock_m->getrow($dbd) ){
            $n++;
            $saldo += $dbr['debet'] - $dbr['kredit'];
            $vare[]     = array("no"=>$n,"faktur"=>$dbr['faktur'],"tgl"=>date_2d($dbr['tgl']),"keterangan"=>$dbr['keterangan'],
                                "debet"=>$dbr['debet'],"kredit"=>$dbr['kredit'],"saldo"=>$saldo);
        }

        savesession($this, "rptkartustock_rpt", json_encode($vare)) ;
        echo(' bos.rptkartustock.openreport();') ;
    }

    public function showreport(){
      $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
      $data = getsession($this,"rptkartustock_rpt") ;      
      $data = json_decode($data,true) ;

      if(!empty($data)){ 
      	$font = 8 ;
        $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'SaldoStock_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>LAPORAN KARTU STOCK</b>",$font+4,array("justification"=>"center")) ;
        $this->bospdf->ezText("Antara Tanggal : ". $va['tglawal'] ." sd ". $va['tglakhir'],$font+2,array("justification"=>"center")) ;
		$this->bospdf->ezText("Stock : ".$va['stock']." - ".$va['namastock']) ; 
        $totdebet = 0 ;
        $totkredit = 0 ;
        foreach($data as $key => $val){
            $totdebet += $val['debet'];
            $totkredit += $val['kredit'];
            $data[$key]['debet'] = string_2s($val['debet']);
            $data[$key]['kredit'] = string_2s($val['kredit']);
            $data[$key]['saldo'] = string_2s($val['saldo']);
        }
        $arrtot = array();
        $arrtot[]= array("keterangan"=>"<b>Total","debet"=>string_2s($totdebet),"kredit"=>string_2s($totkredit),"saldo"=>"</b>");
        $this->bospdf->ezTable($data,"","",  
								array("fontSize"=>$font,"cols"=> array( 
			                        "no"=>array("caption"=>"No","justification"=>"right","width"=>5),
                                    "faktur"=>array("caption"=>"Faktur","justification"=>"center","width"=>15),
                                    "tgl"=>array("caption"=>"Tanggal","justification"=>"center","width"=>10),
                                    "keterangan"=>array("caption"=>"Keterangan","justification"=>"left"),
			                        "debet"=>array("caption"=>"Debet","width"=>12,"justification"=>"right"),
                                    "kredit"=>array("caption"=>"Kredit","width"=>12,"justification"=>"right"),
                                    "saldo"=>array("caption"=>"Saldo","width"=>12,"justification"=>"right")))) ;

        $this->bospdf->ezTable($arrtot,"","",  
								array("fontSize"=>$font,"showHeadings"=>0,"cols"=> array( 
			                        "keterangan"=>array("caption"=>"Keterangan","justification"=>"left"),
			                        "debet"=>array("caption"=>"Debet","width"=>12,"justification"=>"right"),
                                    "kredit"=>array("caption"=>"Kredit","width"=>12,"justification"=>"right"),
                                    "saldo"=>array("caption"=>"Saldo","width"=>12,"justification"=>"right")))) ;

        $this->bospdf->ezStream() ; 
      }else{
         echo('data kosong') ;
      }
   }
}

?>
