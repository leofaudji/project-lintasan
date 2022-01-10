<?php
class Dafj extends Bismillah_Controller{
	protected $bdb ;
	private $date ;
	public function __construct(){
		parent::__construct() ;
      $this->load->model("func/toko_m") ;
		$this->load->helper("toko") ;
		$this->bdb 	= $this->toko_m ;
	}

	public function index(){
		$this->load->view("tr/dafj") ;

	}

	public function loadgrid(){
		$va     	 = json_decode($this->input->post('request'), true) ;
		$tgl 	  	 = date("Y-m-d") ;
      $vare   	 = array() ;
		$limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->bdb->escape_like_str($search) ;
      $where 	 = array() ;
      if($search !== ""){
         $sfield  = $va['search'][0]['field'] ;
         if($sfield == "tgl"){
            $vd   = explode("/", $search) ;
            $search = $vd[2] . "-" . $vd[0] . "-" . $vd[1] ;
         }
         $where[]	= "".$sfield." LIKE '{$search}%'" ;
      }
		$where[]  = "tgl = " . $this->bdb->escape($tgl) ;
		if(getsession($this, "level_code") !== "0000") $where[] = "username = " . $this->bdb->escape(getsession($this, "username")) ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "id recid, faktur, tgl, id_pelanggan, total, bayar,
                  retur_faktur, retur_keterangan, retur_tgl, retur_username" ;
      $dbd      = $this->bdb->select("brg_jual_total", $f, $where, "", "", "id DESC", $limit) ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;
			$vs['tgl']   		= date("d-m-Y", strtotime($vs['tgl'])) ;
         $vs['id_pelanggan']= $this->bdb->getval("nama", "id = '".$vs['id_pelanggan']."'", "mst_pelanggan") ;

         //delete harus opname kas
         if($dbr['retur_faktur'] == "" && $dbr['tgl'] == $tgl){
            $vs['cmdretur']    = '<button type="button" onClick="bos.dafj.cmdretur(\''.$dbr['recid'].'\')"
                                 class="btn btn-danger btn-grid">Retur</button>' ;
            $vs['cmdretur']	 = html_entity_decode($vs['cmdretur']) ;
         }else if($dbr['retur_faktur'] !== ""){
				$vs['cmdretur']    = $dbr['retur_faktur'] ;
			}

         $vare[]		= $vs ;
      }

		$row      = 0 ;
      $dba      = $this->bdb->select("brg_jual_total", "COUNT(id) id", $where) ;
      if($dbra  = $this->bdb->getrow($dba)){
         $row   = $dbra['id'] ;
      }

      $vare 	= array("total"=>$row, "records"=>$vare ) ;
      echo(json_encode($vare)) ;
	}

	public function init(){
	}

	public function retur(){
		$va 	= $this->input->post() ;
		savesession($this, "ssdafj_id_retur", $va['id']) ;
		echo(' bos.dafj.openretur() ; ') ;
	}

}
