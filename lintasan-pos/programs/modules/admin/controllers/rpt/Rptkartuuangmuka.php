<?php

class Rptkartuuangmuka extends Bismillah_Controller{
    protected $bdb ;
    protected $ss ;
    protected $abc ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper('bdate');
        $this->load->model('rpt/rptkartuuangmuka_m') ;
        $this->load->model('func/perhitungan_m') ;
        $this->bdb = $this->rptkartuuangmuka_m ;
        $this->ss  = "ssrptkartuuangmuka_" ;
    }

    public function index(){
        $d    = array("setdate"=>date_set()) ;
        $this->load->view('rpt/rptkartuuangmuka', $d) ;
    }

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $va['tglAwal'] = date_2s($va['tglAwal']);
        $va['tglAkhir'] = date_2s($va['tglAkhir']);
        $vdb    = $this->rptkartuuangmuka_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        $tglKemarin = date("Y-m-d",strtotime($va['tglAwal'])-(60*60*24));
        $saldo = $this->perhitungan_m->GetSaldoAkhirPiutang($va['customer'],$tglKemarin,"","U") ;
        $n = 0 ;
        $vare[] = array("no"=>"","faktur"=>"","tgl"=>"","keterangan"=>"Saldo Awal","debet"=>"","kredit"=>"","saldo"=>$saldo);
        $totdebet = 0 ;
        $totkredit = 0 ;
        while( $dbr = $this->rptkartuuangmuka_m->getrow($dbd) ){
            $n++;
            $saldo += $dbr['debet'] - $dbr['kredit'];
            $vaset   = $dbr ;
            $vaset['no'] = $n;
            $vaset['saldo'] = $saldo;
            $vaset['tgl'] = date_2d($vaset['tgl']);
            $vare[]     = $vaset ;
            $totdebet += $dbr['debet'];
            $totkredit += $dbr['kredit'];
        }
        $vare[] = array("recid"=>'ZZZZ',"no"=> '', "faktur"=> '',"tgl"=> '', 'keterangan'=>'TOTAL',
                        "debet"=>$totdebet,"kredit"=>$totkredit,"saldo"=>"","w2ui"=>array("summary"=> true));

        $vare    = array("total"=>count($vare)-1, "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function pilihcustomer(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->rptkartuuangmuka_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.rptkartuuangmuka.obj){
               find("#customer").val("'.$data['kode'].'") ;
               find("#namacustomer").val("'.$data['nama'].'");
               bos.rptkartuuangmuka.loadmodelcustomer("hide");
            }

         ') ;
        }
    }

    public function seekcustomer(){
        $va 	= $this->input->post() ;
        $kode 	= $va['Customer'] ;
        $data = $this->rptkartuuangmuka_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.rptkartuuangmuka.obj){
               find("#customer").val("'.$data['kode'].'") ;
               find("#namacustomer").val("'.$data['nama'].'");
            }

         ') ;
        }else{
            echo('
                alert("data tidak ditemukan !!!");
                with(bos.rptkartuuangmuka.obj){
                    find("#customer").val("") ;
                    find("#customer").focus() ;
                }
            ');
        }
    }

    public function loadgrid2(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->rptkartuuangmuka_m->loadgrid2($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->rptkartuuangmuka_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.rptkartuuangmuka.cmdpilih(\''.$dbr['kode'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
	
	public function initreport(){
	  $va     = $this->input->post() ;
      savesession($this, $this->ss . "va", json_encode($va) ) ;
      $vare   = array() ;
      $va['tglAwal'] = date_2s($va['tglawal']);
        $va['tglAkhir'] = date_2s($va['tglakhir']);
        $vdb    = $this->rptkartuuangmuka_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        $tglKemarin = date("Y-m-d",strtotime($va['tglAwal'])-(60*60*24));
      $saldo = $this->perhitungan_m->GetSaldoAkhirPiutang($va['customer'],$tglKemarin,"","U") ; 
      $n = 0 ;
      $vare[] = array("no"=>"","faktur"=>"","tgl"=>"","keterangan"=>"Saldo Awal","debet"=>"","kredit"=>"","saldo"=>string_2s($saldo));
      $totdebet = 0 ;
      $totkredit = 0 ;
      while( $dbr = $this->rptkartuuangmuka_m->getrow($dbd) ){
		$n++;
        $saldo += $dbr['debet'] - $dbr['kredit'];
        $vaset   = $dbr ;
        $vaset['no'] = $n;
        $vaset['saldo'] = string_2s($saldo);
        $vaset['tgl'] = date_2d($vaset['tgl']);
		$vaset['debet'] = string_2s($vaset['debet']);
		$vaset['kredit'] = string_2s($vaset['kredit']);
        $vare[]     = $vaset ;
      }
	  
      savesession($this, "rptkartuuangmuka_rpt", json_encode($vare)) ;
      echo(' bos.rptkartuuangmuka.openreport() ; ') ;
	}

	public function showreport(){
      $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
      $data = getsession($this,"rptkartuuangmuka_rpt") ;      
      $data = json_decode($data,true) ;
	  $totdebet = 0 ;
	  $totkredit = 0 ;
	  foreach($data as $key => $val){
		if($val['debet'] == "")$val['debet'] = 0 ;
		if($val['kredit'] == "")$val['kredit'] = 0 ;
		$totdebet += string_2n($val['debet']) ;
		$totkredit += string_2n($val['kredit']) ;
	  }
	  $total = array();
	  $total[] = array("keterangan"=>"<b>Total","debet"=>string_2s($totdebet),"kredit"=>string_2s($totkredit),"ket2"=>"</b>");
      if(!empty($data)){ 
      	$font = 8 ;
        $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'Kartuhutang_' . getsession($this, "username") ) ) ;
        $ketcutomer = $this->bdb->getval("nama", "kode = '{$va['customer']}'", "customer");
		$this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>LAPORAN KARTU UANG MUKA</b>",$font+4,array("justification"=>"center")) ;
        $this->bospdf->ezText("Periode : ". $va['tglawal'] . " sd " . $va['tglakhir'],$font+2,array("justification"=>"center")) ;
		$this->bospdf->ezText("Customer : ".$va['customer']."-".$ketcutomer,$font+2,array("justification"=>"center")) ;
		$this->bospdf->ezText("") ; 
		$this->bospdf->ezTable($data,"","",  
								array("fontSize"=>$font,"cols"=> array( 
			                     "no"=>array("caption"=>"No","width"=>5,"justification"=>"right"),
			                     "tgl"=>array("caption"=>"Tgl","width"=>10,"justification"=>"center"),
			                     "faktur"=>array("caption"=>"Faktur","width"=>16,"justification"=>"center"),
			                     "keterangan"=>array("caption"=>"Keterangan","wrap"=>1),
			                     "debet"=>array("caption"=>"Debet","width"=>13,"justification"=>"right"),
			                     "kredit"=>array("caption"=>"Kredit","width"=>13,"justification"=>"right"),
			                     "saldo"=>array("caption"=>"Saldo","width"=>15,"justification"=>"right")))) ;  
		$this->bospdf->ezTable($total,"","",  
								array("fontSize"=>$font,"showHeadings"=>0,"cols"=> array( 
			                     "keterangan"=>array("caption"=>"Keterangan","wrap"=>1,"justification"=>"center"),
			                     "debet"=>array("caption"=>"Debet","width"=>13,"justification"=>"right"),
			                     "kredit"=>array("caption"=>"Kredit","width"=>13,"justification"=>"right"),
			                     "ket2"=>array("caption"=>"Saldo","width"=>15,"justification"=>"right")))) ;  								 
        //print_r($data) ;    
        $this->bospdf->ezStream() ; 
      }else{
         echo('data kosong') ;
      }
	}
}

?>
