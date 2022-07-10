<?php

class Rptsaldostock extends Bismillah_Controller{
    protected $bdb ;
    protected $ss ;
    protected $abc ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper('bdate');
        $this->load->model('rpt/rptsaldostock_m') ;
        $this->load->model('func/perhitungan_m') ;
        $this->bdb = $this->rptsaldostock_m ;
        $this->ss  = "ssrptsaldostock_" ;
    }

    public function index(){
        $d    = array("setdate"=>date_set()) ;
        $this->load->view('rpt/rptsaldostock', $d) ;
    }

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $cfghpp = $this->perhitungan_m->getcfghpp($va['tgl']);
        $vare   = array() ;
        $va['tgl'] = date_2s($va['tgl']);
        $vdb    = $this->rptsaldostock_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        //$saldo = $this->perhitungan_m->GetSaldoAkhirStock($va['stock'],$tglKemarin) ; ;
        $n = 0 ;
		$total = 0 ;
		$totalgol = 0 ;
		$stockgroup = "";
        while( $dbr = $this->rptsaldostock_m->getrow($dbd) ){
            $n++;
            $vaset = $dbr;
			if($stockgroup <> $dbr['stock_group']){
				if($n > 1){
					$vare[] = array("no"=> '', "kode"=> '', "keterangan"=> "Subtotal",'satuan'=>'',
                        "qty"=>"","persd"=>$totalgol,"cmddetail"=>"");
						$totalgol = 0 ;
					$vare[] = array("no"=> '', "kode"=> '', "keterangan"=> "",'satuan'=>'',
                        "qty"=>"","persd"=>"","cmddetail"=>"");
				}
				$ketgroup = $this->rptsaldostock_m->getval("keterangan", "kode = '{$dbr['stock_group']}'","stock_group");
				$vare[] = array("no"=> '', "kode"=> '', "keterangan"=> $dbr['stock_group']."-".$ketgroup,'satuan'=>'',
                        "qty"=>"","persd"=>"","cmddetail"=>"");
			}
            $vaset['qty'] = $this->perhitungan_m->GetSaldoAkhirStock($dbr['kode'],$va['tgl']) ;
            $arrhp= $this->perhitungan_m->getsaldohpstock($dbr['kode'],$va['tgl'],$va['cabang']);
            $vaset['persd'] = $arrhp['hptot'] ;
			$total += $arrhp['hptot'] ;
			$totalgol += $arrhp['hptot'] ;
            $vaset['cmddetail']    = '<button type="button" onClick="bos.rptsaldostock.cmddetail(\''.$dbr['kode'].'\',\''.$va['tgl'].'\',\''.$va['cabang'].'\')"
                                     class="btn btn-success btn-grid">Detail</button>' ;
            $vaset['cmddetail']    = html_entity_decode($vaset['cmddetail']) ;
            $vaset['no'] = $n;
            $vare[]     = $vaset ;
		
			
			$stockgroup = $dbr['stock_group'];
			
			
        }
		$vare[] = array("no"=> '', "kode"=> '', "keterangan"=> "Subtotal",'satuan'=>'',
                        "qty"=>"","persd"=>$totalgol,"cmddetail"=>"");
		$vare[] = array("recid"=>'ZZZZ',"no"=> '', "kode"=> '', "keterangan"=> 'TOTAL','satuan'=>'',
                        "qty"=>"","persd"=>$total,"cmddetail"=>"","w2ui"=>array("summary"=> true));
        
        $vare    = array("total"=>count($vare) - 1, "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
    
    public function seekcabang(){
        $search     = $this->input->get('q');
        $vdb    = $this->rptsaldostock_m->seekcabang($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->rptsaldostock_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ".$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
    
    public function detailhpp(){
        $va    = $this->input->post() ;
        echo('w2ui["bos-form-rptsaldostock_grid2"].clear();');
        $data = $this->rptsaldostock_m->getval("keterangan,satuan", "kode = '{$va['kode']}'","stock");
        if(!empty($data)){
            echo('
                  with(bos.rptsaldostock.obj){
                     find("#kode").val("'.$va['kode'].'") ;
                     find("#keterangan").val("'.$data['keterangan'].'") ;
                     find("#satuan").val("'.$data['satuan'].'") ;
                  }

              ') ;

            $vare = array();

            $arrhp = $this->perhitungan_m->getdetailsaldostock($va['kode'],$va['tgl'],"");
            $n = 0 ;
            $totqty = 0 ;
            $totjml = 0 ;
            foreach($arrhp['detailhp'] as $key => $val){
                $n++;
                $jml = $val['qty'] * $val['hp'];
                $arr = array("recid"=>$n,"no"=>$n,"faktur"=>$val['faktur'],"qty"=>$val['qty'],"hp"=>$val['hp'],"jml"=>$jml);
                $vare[] = $arr ;
                $totqty += $val['qty'];
                $totjml += $jml;
            }
            $vare[] = array("recid"=>"ZZZZ","no" => '', "faktur"=> 'Jumlah',"qty"=> $totqty,"hp"=>"", "jml"=> $totjml,"w2ui"=>array("summary"=>true));

            $vare = json_encode($vare);
            echo('
            bos.rptsaldostock.loadmodalpreview("show") ;
            bos.rptsaldostock.grid2_reloaddata();
            w2ui["bos-form-rptsaldostock_grid2"].add('.$vare.');
         ');
        }
    }

    public function initreport(){
        $arr = array();

        $va     = $this->input->post() ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;
        $vdb    = $this->rptsaldostock_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        while($dbr = $this->rptsaldostock_m->getrow($dbd)){
            if(!isset($arr[$dbr['stock_group']]))$arr[$dbr['stock_group']] = array();
            $no = count($arr[$dbr['stock_group']]) + 1;
            $qty = $this->perhitungan_m->GetSaldoAkhirStock($dbr['kode'],$va['tgl']) ;
            $arrhp= $this->perhitungan_m->getsaldohpstock($dbr['kode'],$va['tgl'],$va['cabang']);
            $arr[$dbr['stock_group']][$dbr['kode']] = array("no"=>$no, "kode"=>$dbr['kode'],
                                                           "keterangan"=>$dbr['keterangan'],'satuan'=>$dbr['satuan'],
                                                           "qty"=>$qty,"persd"=>$arrhp['hptot']);
        }
                 
        savesession($this, "rptsaldostock_rpt", json_encode($arr)) ;
        echo(' bos.rptsaldostock.openreport();') ;
    }
                 
    public function showreport(){
      $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
      $data = getsession($this,"rptsaldostock_rpt") ;      
      $data = json_decode($data,true) ;

      if(!empty($data)){ 
      	$font = 8 ;
        $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'SaldoStock_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>LAPORAN SALDO STOCK</b>",$font+4,array("justification"=>"center")) ;
        $this->bospdf->ezText("Sampai Tanggal : ". $va['tgl'],$font+2,array("justification"=>"center")) ;
		$this->bospdf->ezText("") ; 
        $totpersd = 0 ;
        foreach($data as $key => $val){
            $arrHGroup = array();
            $golstock = $this->bdb->getval("keterangan", "kode = '$key'", "stock_group");
            $arrHGroup[] = array("Keterangan"=>$key." - " .$golstock);
            $this->bospdf->ezTable($arrHGroup,"","",  
								array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,"cols"=> array( 
			                     "keterangan"=>array("caption"=>"Keterangan","justification"=>"left")))) ; 
            $arrBody = array();
            $subtotpersd = 0;
            foreach($val as $key2 => $val2){
                $subtotpersd += $val2['persd'];
                $totpersd += $val2['persd'];
                $val[$key2]['persd'] = string_2s($val2['persd']);
            }
            $arrfgroup = array();
            $arrfgroup[] = array("keterangan"=>"<b>SubTotal","persd"=>string_2s($subtotpersd)."</b>");

            $this->bospdf->ezTable($val,"","",  
								array("fontSize"=>$font,"cols"=> array( 
			                     "no"=>array("caption"=>"No","width"=>5,"justification"=>"right"),
			                     "kode"=>array("caption"=>"Kode","width"=>10,"justification"=>"center"),
			                     "keterangan"=>array("caption"=>"Keterangan","justification"=>"left"),
			                     "qty"=>array("caption"=>"Qty","width"=>15,"justification"=>"right"),
			                     "persd"=>array("caption"=>"H.Pokok","width"=>15,"justification"=>"right")))) ; 
            $this->bospdf->ezTable($arrfgroup,"","",  
								array("fontSize"=>$font,"showHeadings"=>0,"cols"=> array( 
			                     "keterangan"=>array("caption"=>"Keterangan","justification"=>"center"),
			                     "persd"=>array("caption"=>"H.Pokok","width"=>15,"justification"=>"right")))) ; 
        }
        $arrtot = array();
        $arrtot[] = array("keterangan"=>"<b>Total","persd"=>string_2s($totpersd)."</b>");
        $this->bospdf->ezTable($arrtot,"","",  
								array("fontSize"=>$font,"showHeadings"=>0,"cols"=> array( 
			                     "keterangan"=>array("caption"=>"Keterangan","justification"=>"center"),
			                     "persd"=>array("caption"=>"H.Pokok","width"=>15,"justification"=>"right")))) ;

		/* $this->bospdf->ezTable($total,"","",  
								array("fontSize"=>$font,"showHeadings"=>0,"cols"=> array( 
			                     "keterangan"=>array("caption"=>"Keterangan","wrap"=>1,"justification"=>"center"),
			                     "saldo"=>array("caption"=>"Saldo","width"=>15,"justification"=>"right")))) ;  	*/							 
        //print_r($data) ;    
        $this->bospdf->ezStream() ; 
      }else{
         echo('data kosong') ;
      }
   }
}

?>
