<?php
class Rptakuntansibukubesar extends Bismillah_Controller{
	protected $bdb ; 
	public function __construct(){
		parent::__construct() ;
		$this->load->model("rpt/rptakuntansibukubesar_m") ;
		$this->bdb 	= $this->rptakuntansibukubesar_m ;
	}   

	public function index(){
		$this->load->view("rpt/rptakuntansibukubesar") ; 

	}   

	public function loadgrid(){
	  $va     = json_decode($this->input->post('request'), true) ; 
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;  
      $n = 0 ; 
      $vare[0] = array("no"=>"","tgl"=>"","faktur"=>"","rekening"=>"","keterangan"=>"Saldo Awal","debet"=>"","kredit"=>"","total"=> string_2s($vdb['saldoawal']),"username"=>"","cmddelete"=>"") ;
	  $total = $vdb['saldoawal'] ;
	  while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;
         $vs['no'] = ++$n ;
         if($va['offset'] > 0) $vs['no'] += $va['offset'] ; 
         $vs['tgl'] = date_2d($vs['tgl']) ;  
         $c = $vdb['rekening'] ;
         if($c == "1" || $c == "5"){
         	$total += $vs['debet'] - $vs['kredit'] ;
         }else{
         	$total += $vs['kredit'] - $vs['debet'];
         }
         $vs['debet'] = string_2s($vs['debet']);
         $vs['kredit'] = string_2s($vs['kredit']);
         $vs['total'] = $total ;
         $vs['total'] = string_2s($vs['total']); 
         $vs['cmddelete']  = '<button type="button" onClick="bos.rptakuntansibukubesar.cmddelete(\''.$dbr['faktur'].'\')" class="btn btn-danger btn-grid">Hapus</button>' ;
         $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ;   
         $vare[]		= $vs ;
	  }
      $vare 	= array("total"=>$vdb['rows']+1, "records"=>$vare ) ;
      $varpt = $vare['records'] ;
      echo(json_encode($vare)) ; 
      savesession($this, "rptakuntansibukubesar_rpt", json_encode($varpt)) ;   
	}

  public function deleting(){
    $va   = $this->input->post() ; 
    $id   = $va['id'] ;
    $this->bdb->delete("keuangan_jurnal", "faktur = " . $this->bdb->escape($id)) ;
    $this->bdb->delete("keuangan_bukubesar", "faktur = " . $this->bdb->escape($id)) ;
    echo(' bos.rptakuntansibukubesar.grid1_reload() ; ') ; 
  }

	public function init(){
		savesession($this, "ssrptakuntansibukubesar_id", "") ;    
	}

	public function showreport(){
      $data = getsession($this,"rptakuntansibukubesar_rpt") ;      
      $data = json_decode($data,true) ;    
      if(!empty($data)){ 
      	$font = 8 ;
         $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                        'opt'=>array('export_name'=>'DaftarBukuBesar_' . getsession($this, "username") ) ) ;
         $this->load->library('bospdf', $o) ;   
         $this->bospdf->ezText("<b>LAPORAN BUKU BESAR</b>",$font+4,array("justification"=>"center")) ;
		   $this->bospdf->ezText("") ; 
		   $this->bospdf->ezTable($data,"","",  
								array("fontSize"=>$font,"cols"=> array( 
			                     "no"=>array("caption"=>"No","width"=>5,"justification"=>"right"),
			                     "tgl"=>array("caption"=>"Tgl","width"=>10,"justification"=>"center"),
			                     "faktur"=>array("caption"=>"Faktur","width"=>14,"justification"=>"center"),
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
         bos.rptakuntansibukubesar.grid1_reloaddata() ;
      ');
   }

}
?>
