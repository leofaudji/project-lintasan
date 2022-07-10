<?php
class Rptbukubesar extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("rpt/rptbukubesar_m") ;
		$this->bdb 	= $this->rptbukubesar_m ;
        $this->ss  = "ssrptbukubesar_" ;
	}  

	public function index(){
		$this->load->view("rpt/rptbukubesar") ; 

	}  

	public function loadgrid(){
	  $va     = json_decode($this->input->post('request'), true) ; 
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      $n = 0 ; 
      $vare[0] = array("no"=>"","tgl"=>"","faktur"=>"","keterangan"=>"Saldo Awal","debet"=>"","kredit"=>"","total"=> $vdb['saldoawal'],"username"=>"") ;
	  $total = $vdb['saldoawal'] ;
	  $totdebet = 0 ;
	  $totkredit = 0 ;
	  while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;
         $vs['no'] = ++$n ;
         $vs['tgl'] = date_2d($vs['tgl']) ;  
         $c = $vdb['rekening'] ;
         if($c == "1" || $c == "5" || $c == "6" || $c == "8" || $c == "9"){
         	$total += $vs['debet'] - $vs['kredit'] ;
         }else{
         	$total += $vs['kredit'] - $vs['debet'];
         }
         $totdebet += $vs['debet'];
         $totkredit += $vs['kredit'];
         $vs['total'] = $total ;
         //$vs['total'] = string_2s($vs['total']);
          
         $vs['cmdprintbukti']    = "";
         

         $vare[]		= $vs ;
	  }
	  $vare[] = array("recid"=>'ZZZZ',"no"=> '', "tgl"=> '', "faktur"=> '','keterangan'=>'TOTAL',
                        "debet"=>$totdebet,"kredit"=>$totkredit,"total"=>"","username"=>"","w2ui"=>array("summary"=> true));
      $vare 	= array("total"=>$vdb['rows']+1, "records"=>$vare ) ;
      $varpt = $vare['records'] ;
      echo(json_encode($vare)) ; 
      savesession($this, "rptbukubesar_rpt", json_encode($varpt)) ;   
	}

    public function initreport(){
	  $va     = $this->input->post() ;
      savesession($this, $this->ss . "va", json_encode($va) ) ;
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      $n = 0 ; 
      $vare[0] = array("no"=>"","tgl"=>"","faktur"=>"","keterangan"=>"Saldo Awal","debet"=>"","kredit"=>"","total"=> string_2s($vdb['saldoawal']),"username"=>"") ;
	  $total = $vdb['saldoawal'] ;
	  while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;
         $vs['no'] = ++$n ;
         $vs['tgl'] = date_2d($vs['tgl']) ;  
         $c = $vdb['rekening'] ;
         if($c == "1" || $c == "5" || $c == "6" || $c == "8" || $c == "9"){
         	$total += $vs['debet'] - $vs['kredit'] ;
         }else{
         	$total += $vs['kredit'] - $vs['debet'];
         }
         $vs['debet'] = string_2s($vs['debet']);
         $vs['kredit'] = string_2s($vs['kredit']);
         $vs['total'] = $total ;
         $vs['total'] = string_2s($vs['total']);
         $vare[]		= $vs ;
	  }
      $vare 	= array("total"=>$vdb['rows']+1, "records"=>$vare ) ;
      $varpt = $vare['records'] ;
      savesession($this, "rptbukubesar_rpt", json_encode($varpt)) ;
      echo(' bos.rptbukubesar.openreport() ; ') ;
	}

	public function showreport(){
      $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
      $data = getsession($this,"rptbukubesar_rpt") ;      
      $data = json_decode($data,true) ;    
      if(!empty($data)){ 
      	$font = 8 ;
        $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'DaftarBukuBesar_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>LAPORAN BUKU BESAR</b>",$font+4,array("justification"=>"center")) ;
        $this->bospdf->ezText("Periode : ". $va['tglawal'] . " sd " . $va['tglakhir'],$font+2,array("justification"=>"center")) ;
		$this->bospdf->ezText("") ; 
		$this->bospdf->ezTable($data,"","",  
								array("fontSize"=>$font,"cols"=> array( 
			                     "no"=>array("caption"=>"No","width"=>5,"justification"=>"right"),
			                     "tgl"=>array("caption"=>"Tgl","width"=>10,"justification"=>"center"),
			                     "faktur"=>array("caption"=>"Faktur","width"=>16,"justification"=>"center"),
			                     "keterangan"=>array("caption"=>"Keterangan","wrap"=>1),
			                     "debet"=>array("caption"=>"Debet","width"=>13,"justification"=>"right"),
			                     "kredit"=>array("caption"=>"Kredit","width"=>13,"justification"=>"right"),
			                     "total"=>array("caption"=>"Total","width"=>15,"justification"=>"right"),
			                 	 "username"=>array("caption"=>"Username","width"=>8)))) ;   
        //print_r($data) ;    
        $this->bospdf->ezStream() ; 
      }else{
         echo('data kosong') ;
      }
   }

   public function refresh(){
      echo('
         bos.rptbukubesar.grid1_reloaddata() ;
      ');
   }

}
?>
