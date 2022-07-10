
<?php
class Rptneraca extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("rpt/rptneraca_m") ;
        $this->load->model("func/perhitungan_m") ;
		$this->bdb 	= $this->rptneraca_m ;
        $this->ss  = "ssrptneraca_" ;
	}  

	public function index(){ 
		$this->load->view("rpt/rptneraca") ; 

	}   

	public function loadgrid(){ 

	  	$va     = json_decode($this->input->post('request'), true) ; 
	    $tglawal 	= $va['tglawal'] ; //date("d-m-Y") ;
        $tglakhir 	= $va['tglakhir'] ; //date("d-m-Y") ;
	  	$tglkemarin = date("d-m-Y",strtotime($tglawal)-(24*60*60)) ;
	  	$vare   = array() ; 
        
        // AKTIVA
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
            if($vs['jenis'] == "I"){
                foreach($vs as $key => $val){
                    $vs[$key] = "<b>".$val."</b>";
                }
            }
            
            unset($vs['jenis']);
			$vare[]		= $vs ;
		} 

	    $vare[] = array("kode"=>"","keterangan"=>"<b>TOTAL AKTIVA</b>",
									"saldoawal"=>"<b>".string_2s($totaktiva["saldoawal"])."</b>",
                                    "debet"=>"<b>".string_2s($totaktiva["debet"])."</b>",
									"kredit"=>"<b>".string_2s($totaktiva["kredit"])."</b>",
                                    "saldoakhir"=>"<b>".string_2s($totaktiva["saldoakhir"])."</b>") ;  

        // PASIVA
        $reklrthnberjalan = $this->bdb->getconfig("reklrthberjalan");
        $totaktiva = array("saldoawal"=>0,"debet"=>0,"kredit"=>0,"saldoakhir"=>0);
	    $vdb    = $this->perhitungan_m->loadrekening("2","3.9999") ;
	    while($dbr = $this->bdb->getrow($vdb) ){
			$vs = $dbr;  
            $vs['saldoawal'] = $this->perhitungan_m->getsaldo($tglkemarin,$vs['kode']) ; 
            $vs['debet'] = $this->perhitungan_m->getdebet($tglawal,$tglakhir,$vs['kode']) ;  
            $vs['kredit'] = $this->perhitungan_m->getkredit($tglawal,$tglakhir,$vs['kode']) ;  			
            $vs['saldoakhir'] = $vs['saldoawal'] + $vs['kredit'] - $vs['debet'] ;

            if(substr($reklrthnberjalan,0,strlen($reklrthnberjalan)) == substr($vs['kode'],0,strlen($vs['kode']))){
                $arrlr = $this->perhitungan_m->getlr($tglawal,$tglakhir);
                $vs['saldoawal'] += $arrlr['lrstlhpjk']['saldoawal']; 
                $vs['debet'] += $arrlr['lrstlhpjk']['debet']; 
                $vs['kredit'] += $arrlr['lrstlhpjk']['kredit']; 
                $vs['saldoakhir'] += $arrlr['lrstlhpjk']['saldoakhir']; 
            }


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
            if($vs['jenis'] == "I"){
                foreach($vs as $key => $val){
                    $vs[$key] = "<b>".$val."</b>";
                }
            }
            
            unset($vs['jenis']);

			$vare[]		= $vs ;
		} 

	    $vare[] = array("kode"=>"","keterangan"=>"<b>TOTAL PASIVA</b>",
									"saldoawal"=>"<b>".string_2s($totaktiva["saldoawal"])."</b>",
                                    "debet"=>"<b>".string_2s($totaktiva["debet"])."</b>",
									"kredit"=>"<b>".string_2s($totaktiva["kredit"])."</b>",
                                    "saldoakhir"=>"<b>".string_2s($totaktiva["saldoakhir"])."</b>") ;  
		$vare 	= array("total"=>count($vare), "records"=>$vare ) ; 
        $varpt = $vare['records'] ;
      	echo(json_encode($vare)) ; 
      	savesession($this, "rptneraca_rpt", json_encode($varpt)) ;  
	}

	public function init(){
		savesession($this, "ssrptneraca_id", "") ;    
	}
    
    public function initreport(){
        $n=0;
        $va     = $this->input->post() ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;

	    $tglawal 	= $va['tglawal'] ; //date("d-m-Y") ;
        $tglakhir 	= $va['tglakhir'] ; //date("d-m-Y") ;
	  	$tglkemarin = date("d-m-Y",strtotime($tglawal)-(24*60*60)) ;
	  	$vare   = array() ; 
        
        // AKTIVA
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
            if($vs['jenis'] == "I"){
                foreach($vs as $key => $val){
                    $vs[$key] = "<b>".$val."</b>";
                }
            }
            unset($vs['jenis']);
			$vare[]		= $vs ;
		} 

	    $vare[] = array("kode"=>"","keterangan"=>"<b>TOTAL AKTIVA</b>",
									"saldoawal"=>"<b>".string_2s($totaktiva["saldoawal"])."</b>",
                                    "debet"=>"<b>".string_2s($totaktiva["debet"])."</b>",
									"kredit"=>"<b>".string_2s($totaktiva["kredit"])."</b>",
                                    "saldoakhir"=>"<b>".string_2s($totaktiva["saldoakhir"])."</b>") ;  
        
        // PASIVA
        $reklrthnberjalan = $this->bdb->getconfig("reklrthberjalan");
        $totaktiva = array("saldoawal"=>0,"debet"=>0,"kredit"=>0,"saldoakhir"=>0);
	    $vdb    = $this->perhitungan_m->loadrekening("2","3.9999") ;
	    while($dbr = $this->bdb->getrow($vdb) ){
			$vs = $dbr;  
            $vs['saldoawal'] = $this->perhitungan_m->getsaldo($tglkemarin,$vs['kode']) ; 
            $vs['debet'] = $this->perhitungan_m->getdebet($tglawal,$tglakhir,$vs['kode']) ;  
            $vs['kredit'] = $this->perhitungan_m->getkredit($tglawal,$tglakhir,$vs['kode']) ;  			
            $vs['saldoakhir'] = $vs['saldoawal'] + $vs['kredit'] - $vs['debet'] ;

            if(substr($reklrthnberjalan,0,strlen($reklrthnberjalan)) == substr($vs['kode'],0,strlen($vs['kode']))){
                $arrlr = $this->perhitungan_m->getlr($tglawal,$tglakhir);
                $vs['saldoawal'] += $arrlr['lrstlhpjk']['saldoawal']; 
                $vs['debet'] += $arrlr['lrstlhpjk']['debet']; 
                $vs['kredit'] += $arrlr['lrstlhpjk']['kredit']; 
                $vs['saldoakhir'] += $arrlr['lrstlhpjk']['saldoakhir']; 
            }


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
            if($vs['jenis'] == "I"){
                foreach($vs as $key => $val){
                    $vs[$key] = "<b>".$val."</b>";
                }
            }
            
            unset($vs['jenis']);

			$vare[]		= $vs ;
		} 

	    $vare[] = array("kode"=>"","keterangan"=>"<b>TOTAL PASIVA</b>",
									"saldoawal"=>"<b>".string_2s($totaktiva["saldoawal"])."</b>",
                                    "debet"=>"<b>".string_2s($totaktiva["debet"])."</b>",
									"kredit"=>"<b>".string_2s($totaktiva["kredit"])."</b>",
                                    "saldoakhir"=>"<b>".string_2s($totaktiva["saldoakhir"])."</b>") ;  
		$vare 	= array("total"=>count($vare), "records"=>$vare ) ; 
        $varpt = $vare['records'] ;
      	savesession($this, "rptneraca_rpt", json_encode($varpt)) ; 
        echo(' bos.rptneraca.openreport() ; ') ;
    }

	public function showreport(){
      $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
      $data = getsession($this,"rptneraca_rpt") ;      
      $data = json_decode($data,true) ;       
      if(!empty($data)){ 
      	$font = 8 ;
        $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'DaftarNeraca_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>LAPORAN NERACA</b>",$font+4,array("justification"=>"center")) ;
        $this->bospdf->ezText("Periode : ".$va['tglawal']." sd ". $va['tglakhir'],$font+2,array("justification"=>"center")) ;
		$this->bospdf->ezText("") ; 
		$this->bospdf->ezTable($data,"","",  
								array("fontSize"=>$font,"cols"=> array( 
			                     "kode"=>array("caption"=>"Tgl","width"=>10),
			                     "keterangan"=>array("caption"=>"Keterangan","wrap"=>1),
			                     "saldoawal"=>array("caption"=>"Saldo Awal","width"=>15,"justification"=>"right"),
			                 	 "debet"=>array("caption"=>"Debet","width"=>13,"justification"=>"right"),
			                     "kredit"=>array("caption"=>"Kredit","width"=>13,"justification"=>"right"),
			                     "saldoakhir"=>array("caption"=>"Saldo Akhir","width"=>15,"justification"=>"right")))) ;   
        //print_r($data) ;    
        $this->bospdf->ezStream() ; 
      }else{
         echo('data kosong') ;
      }
   }

}
?>
