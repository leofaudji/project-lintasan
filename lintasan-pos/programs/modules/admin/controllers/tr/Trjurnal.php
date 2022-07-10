<?php
class Trjurnal extends Bismillah_Controller{
	protected $bdb ;
	public function __construct(){
		parent::__construct() ;
		$this->load->model("tr/trjurnal_m") ;
		$this->bdb 	= $this->trjurnal_m ;
	}

	public function index(){
		$this->load->view("tr/trjurnal") ; 
 
	} 
 
	public function loadgrid(){
	  $va     = json_decode($this->input->post('request'), true) ; 
      $vare   = array() ;
      $vdb    = $this->bdb->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      $totdebet = 0 ;
      $totkredit = 0 ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr; 
         $totdebet += $dbr['debet'] ;
         $totkredit += $dbr['kredit'] ;
         $vs['tgl'] = date_2d($vs['tgl']) ; 
         $vs['debet'] = $vs['debet'] ;
         $vs['kredit'] = $vs['kredit'] ;
         $vs['cmddelete']  = '<button type="button" onClick="bos.trjurnal.cmddelete(\''.$dbr['id'].'\')"
                           class="btn btn-danger btn-grid">Hapus</button>' ;
         $vs['cmddelete']  = html_entity_decode($vs['cmddelete']) ; 

         $vare[]		= $vs ;  
      }
      $vare[] = array("recid"=>'ZZZZ',"tgl"=> '', "rekening"=> '',"keterangan"=> 'Total', 'debet'=>$totdebet,"kredit"=>$totkredit,
                      "username"=>"","cmddelete"=>"","w2ui"=>array("summary"=> true));

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ; 
	}

	public function init(){
		savesession($this, "sstrjurnal_id", "") ;    
	} 

	public function saving(){
		$va 	= $this->input->post() ;  
 		$id 	= getsession($this, "sstrjurnal_id") ;  
		$this->bdb->saving($va, $id) ; 
        echo(' bos.trjurnal.grid1_reload() ; ') ; 
	}

	public function deleting(){
		$va 	= $this->input->post() ; 
		$id 	= $va['id'] ; 
		$this->bdb->delete("keuangan_jurnal_tmp", "id = " . $this->bdb->escape($id)) ;
		echo(' bos.trjurnal.grid1_reload() ; ') ; 
	}

	public function updbukubesar(){
        $tgl = date("Y-m-d");
		$username = getsession($this,"username") ; 
		$where    = "username = '$username'" ; 
		$dba      = $this->bdb->select("keuangan_jurnal_tmp", "sum(debet-kredit) total", $where) ;
      	if($dbra  = $this->bdb->getrow($dba)){ 
        	$total   = $dbra['total'] ;
			
			if($total == 0){
				$faktur = $this->bdb->getfaktur(true,$tgl) ;
				$dbtmp      = $this->bdb->select("keuangan_jurnal_tmp", "*", $where) ;   
				while($row  = $this->bdb->getrow($dbtmp)){
					unset($row['id']) ;   
					$row['faktur'] = $faktur ;    
					$row['datetime'] = date_now() ; 
                    $row['cabang'] = getsession($this,"cabang") ;
					$this->bdb->insert("keuangan_jurnal",$row) ; 	 
					$this->bdb->insert("keuangan_bukubesar",$row) ; 	  
				}  
        		$this->bdb->delete("keuangan_jurnal_tmp",$where) ; 
				echo(' 
					alert("Transaksi Berhasil Disimpan...") ;
					bos.trjurnal.grid1_reload() ; 
					') ;    
			}else{
				echo(' 
					alert("Maaf,Nominal Debet Kredit Tidak Balance ,\\n Mohon Diperiksa Ulang...") ;
					') ; 
			}
      	}	 
	}

}
?>
