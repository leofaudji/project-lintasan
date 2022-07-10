<?php

class Rptsaldopersekot extends Bismillah_Controller{
    protected $bdb ;
    protected $ss ;
    protected $abc ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper('bdate');
        $this->load->model('rpt/rptsaldopersekot_m') ;
        $this->load->model('func/perhitungan_m') ;
        $this->bdb = $this->rptsaldopersekot_m ;
        $this->ss  = "ssrptsaldopersekot_" ;
    }

    public function index(){
        $d    = array("setdate"=>date_set()) ;
        $this->load->view('rpt/rptsaldopersekot', $d) ;
    }

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $va['tgl'] = date_2s($va['tgl']);
        $vdb    = $this->rptsaldopersekot_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        $n = 0 ;
		$totsaldo = 0;
        while( $dbr = $this->rptsaldopersekot_m->getrow($dbd) ){
            $n++;
            $vaset = $dbr;
            $vaset['saldo'] = $this->perhitungan_m->GetSaldoAkhirHutang($dbr['kode'],$va['tgl'],"","P") ; 
            $vaset['no'] = $n;
			$totsaldo += $vaset['saldo'];
            $vare[]     = $vaset ;
        }
		$vare[] = array("recid"=>'ZZZZ',"no"=> '', "kode"=> '',"nama"=> '', 'alamat'=>'TOTAL',"saldo"=>$totsaldo,"w2ui"=>array("summary"=> true));

        $vare    = array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
	
	public function initreport(){
	  $va     = $this->input->post() ;
      savesession($this, $this->ss . "va", json_encode($va) ) ;
      $vare   = array() ;
      $va['tgl'] = date_2s($va['tgl']);
      $vdb    = $this->rptsaldopersekot_m->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
	  $n = 0 ;
      while( $dbr = $this->rptsaldopersekot_m->getrow($dbd) ){
		$n++;
		$saldo = $this->perhitungan_m->GetSaldoAkhirHutang($dbr['kode'],$va['tgl'],"","P") ; 
        
        $vare[]     = array("no"=>$n,"nama"=>$dbr['nama'],"alamat"=>$dbr['alamat'],"saldo"=>string_2s($saldo)) ;
      }
	  
      savesession($this, "rptsaldopersekot_rpt", json_encode($vare)) ;
      echo(' bos.rptsaldopersekot.openreport() ; ') ;
	}

	public function showreport(){
      $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
      $data = getsession($this,"rptsaldopersekot_rpt") ;      
      $data = json_decode($data,true) ;
	  $totsaldo = 0 ;
	  $n = 0 ;
	  foreach($data as $key => $val){
		  $n++;
		 $data[$key]['no'] = $n;
		$totsaldo += string_2n($val['saldo']) ;
	  }
	  $total = array();
	  $total[] = array("keterangan"=>"<b>Total","saldo"=>string_2s($totsaldo)."</b>");
      if(!empty($data)){ 
      	$font = 8 ;
        $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'Kartupersekot_' . getsession($this, "username") ) ) ;
		$ketsupplier = $this->bdb->getval("nama", "kode = '{$va['supplier']}'", "supplier");
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>LAPORAN SALDO PERSEKOT</b>",$font+4,array("justification"=>"center")) ;
        $this->bospdf->ezText("Sampai Tanggal : ". $va['tgl'],$font+2,array("justification"=>"center")) ;
		$this->bospdf->ezText("") ; 
		$this->bospdf->ezTable($data,"","",  
								array("fontSize"=>$font,"cols"=> array( 
			                     "no"=>array("caption"=>"No","width"=>5,"justification"=>"right"),
			                     "kode"=>array("caption"=>"Kode","width"=>10,"justification"=>"center"),
			                     "nama"=>array("caption"=>"Nama","justification"=>"left"),
			                     "alamat"=>array("caption"=>"Alamat","justification"=>"left"),
			                     "saldo"=>array("caption"=>"Saldo","width"=>15,"justification"=>"right")))) ;  
		$this->bospdf->ezTable($total,"","",  
								array("fontSize"=>$font,"showHeadings"=>0,"cols"=> array( 
			                     "keterangan"=>array("caption"=>"Keterangan","wrap"=>1,"justification"=>"center"),
			                     "saldo"=>array("caption"=>"Saldo","width"=>15,"justification"=>"right")))) ;  								 
        //print_r($data) ;    
        $this->bospdf->ezStream() ; 
      }else{
         echo('data kosong') ;
      }
   }
}

?>
