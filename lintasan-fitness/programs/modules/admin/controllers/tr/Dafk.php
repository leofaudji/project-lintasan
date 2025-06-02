<?php
class Dafk extends Bismillah_Controller{
	protected $bdb ;
	private $date ;
	public function __construct(){
		parent::__construct() ;
      $this->load->model("func/toko_m") ;
		$this->load->helper("toko") ;
		$this->bdb 	= $this->toko_m ;
	}

	public function index(){
		$this->load->view("tr/dafk") ;

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
		$where[]  = "jenis = 1" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "*" ;
      $dbd      = $this->bdb->select("brg_beli_total", $f, $where, "", "", "id DESC", $limit) ;
      while( $dbr = $this->bdb->getrow($dbd) ){
         $vs = $dbr;
			$vs['recid']= $vs['id'] ;
			$vs['tgl']  = date("d-m-Y", strtotime($vs['tgl'])) ;
			$sup 			= $this->bdb->getval("kode, nama", "id = '".$vs['id_supplier']."'", "mst_supplier") ; ;
         $vs['id_supplier']= $sup['kode'] . " - " . $sup['nama'] ;

			if($vs['retur_bayar'] == 0){
				$dbs 	 	 = $this->bdb->select("brg_beli", "id_brg, harga", "faktur = '".$vs['faktur']."'") ;
				while($sr = $this->bdb->getrow($dbs)){
					$stok  = $this->bdb->getstok($sr['id_brg']) ;
					$vs['qty_sisa'] 	 += $stok ;
					$vs['retur_bayar'] += $stok*$sr['harga'] ;
				}
			}

         //delete harus opname kas
         if($dbr['retur_faktur'] == "" && $dbr['tgl'] == $tgl){
            $vs['cmdretur']    = '<button type="button" onClick="bos.dafk.cmdretur(\''.$dbr['id'].'\')"
                                 class="btn btn-danger btn-grid">Lunasi</button>' ;
            $vs['cmdretur']	 = html_entity_decode($vs['cmdretur']) ;
         }else if($dbr['retur_faktur'] !== ""){
				$vs['cmdretur']    = $dbr['retur_faktur'] ;
			}

         $vare[]		= $vs ;
      }

		$row      = 0 ;
      $dba      = $this->bdb->select("brg_beli_total", "COUNT(id) id", $where) ;
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
		savesession($this, "ssdafk_id_retur", $va['id']) ;
		echo(' bos.dafk.openretur() ; ') ;
	}

}
