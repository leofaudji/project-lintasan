
<?php
class rpthpproduksistock extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model("rpt/rpthpproduksistock_m") ;
        $this->load->model("func/perhitungan_m") ;
        $this->bdb 	= $this->rpthpproduksistock_m ;
        $this->ss  = "ssrpthpproduksistock_" ;
    }  

    public function index(){ 
        /*$data['rekhppbbbawal']= $this->bdb->getconfig("rekhppbbbawal") ;
        $data['ketrekhppbbbawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekhppbbbawal']}'", "keuangan_rekening");
        $data['rekhppbbbakhir']= $this->bdb->getconfig("rekhppbbbakhir") ;
        $data['ketrekhppbbbakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekhppbbbakhir']}'", "keuangan_rekening");
        $data['rekhppbbpawal']= $this->bdb->getconfig("rekhppbbpawal") ;
        $data['ketrekhppbbpawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekhppbbpawal']}'", "keuangan_rekening");
        $data['rekhppbbpakhir']= $this->bdb->getconfig("rekhppbbpakhir") ;
        $data['ketrekhppbbpakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekhppbbpakhir']}'", "keuangan_rekening");
        $data['rekhppbtklawal']= $this->bdb->getconfig("rekhppbtklawal") ;
        $data['ketrekhppbtklawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekhppbtklawal']}'", "keuangan_rekening");
        $data['rekhppbtklakhir']= $this->bdb->getconfig("rekhppbtklakhir") ;
        $data['ketrekhppbtklakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekhppbtklakhir']}'", "keuangan_rekening");
        $data['rekhppbopawal']= $this->bdb->getconfig("rekhppbopawal") ;
        $data['ketrekhppbopawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekhppbopawal']}'", "keuangan_rekening");
        $data['rekhppbopakhir']= $this->bdb->getconfig("rekhppbopakhir") ;
        $data['ketrekhppbopakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekhppbopakhir']}'", "keuangan_rekening");
        $data['rekhppbdpawal']= $this->bdb->getconfig("rekhppbdpawal") ;
        $data['ketrekhppbdpawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekhppbdpawal']}'", "keuangan_rekening");
        $data['rekhppbdpakhir']= $this->bdb->getconfig("rekhppbdpakhir") ;
        $data['ketrekhppbdpakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekhppbdpakhir']}'", "keuangan_rekening");*/

        $this->load->view("rpt/rpthpproduksistock") ; 

    }
	
	
	public function seekstock(){
        $search     = $this->input->get('q');
        $vdb    = $this->rpthpproduksistock_m->seekstock($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->rpthpproduksistock_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
	
    public function loadgrid(){ 

        $va     = json_decode($this->input->post('request'), true) ; 
        $tglawal 	= $va['tglawal'] ; //date("d-m-Y") ;
        $tglakhir 	= $va['tglakhir'] ;
		$stock 	= $va['stock'] ;		//date("d-m-Y") ;
        $tglkemarin = date("d-m-Y",strtotime($tglawal)-(24*60*60)) ;

        $vare   = array() ;
		$arrhpp = $this->perhitungan_m->hargapokokproduksistock($stock,$tglawal,$tglakhir);

        //persd barang dalam proses awal
        
        //$vare[] = array("kode"=>"","keterangan"=>"<b>Produk dalam proses ".$tglkemarin."</b>","1"=>"","2"=>"","3"=>"","4"=>"");
		//$vare[] = array("kode"=>"","keterangan"=>"<b>Jumlah Barang Dalam Proses ".$tglkemarin."</b>","1"=>"","2"=>"","3"=>"","4"=>"");
		$totprod = $arrhpp['BBB'] + $arrhpp['BTKL'] + $arrhpp['BOP'];
		$hppperqty = devide($totprod,$arrhpp['Qty']);
		$vare[] = array("kode"=>"","keterangan"=>"<b>:: Biaya Produksi </b>","1"=>"","2"=>"","3"=>"","4"=>"");
		$vare[] = array("kode"=>"","keterangan"=>"Biaya Bahan Baku","1"=>$arrhpp['BBB'],"2"=>"","3"=>"","4"=>"");
		$vare[] = array("kode"=>"","keterangan"=>"Biaya Tenaga Kerja Langsung","1"=>$arrhpp['BTKL'],"2"=>"","3"=>"","4"=>"");
		$vare[] = array("kode"=>"","keterangan"=>"Biaya Overhead Pabrik","1"=>$arrhpp['BOP'],"2"=>"","3"=>"","4"=>"");
		$vare[] = array("kode"=>"","keterangan"=>"<b>Total Biaya Produksi </b>","1"=>"","2"=>$totprod,"3"=>"","4"=>"");
		$vare[] = array("kode"=>"","keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");
		$vare[] = array("kode"=>"","keterangan"=>"<b>Qty yang diproduksi</b>","1"=>"","2"=>$arrhpp['Qty'],"3"=>"","4"=>"");
		$vare[] = array("kode"=>"","keterangan"=>"<b>Harga Pokok Per Produk</b>","1"=>"","2"=>"","3"=>$hppperqty,"4"=>"");
		
        $vare 	= array("total"=>count($vare), "records"=>$vare ) ; 
        echo(json_encode($vare)) ; 
    }

    public function initreport(){
        $n=0;
        $va     = $this->input->post() ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;

        $tglawal 	= $va['tglawal'] ; //date("d-m-Y") ;
        $tglakhir 	= $va['tglakhir'] ; //date("d-m-Y") ;
        $tglkemarin = date("d-m-Y",strtotime($tglawal)-(24*60*60)) ;
        $vare   = array() ;
        
        $tglawal 	= $va['tglawal'] ; //date("d-m-Y") ;
        $tglakhir 	= $va['tglakhir'] ;
		$stock 	= $va['stock'] ;		//date("d-m-Y") ;
        $tglkemarin = date("d-m-Y",strtotime($tglawal)-(24*60*60)) ;

        $vare   = array() ;
		$arrhpp = $this->perhitungan_m->hargapokokproduksistock($stock,$tglawal,$tglakhir);

        //persd barang dalam proses awal
        
        //$vare[] = array("kode"=>"","keterangan"=>"<b>Produk dalam proses ".$tglkemarin."</b>","1"=>"","2"=>"","3"=>"","4"=>"");
		//$vare[] = array("kode"=>"","keterangan"=>"<b>Jumlah Barang Dalam Proses ".$tglkemarin."</b>","1"=>"","2"=>"","3"=>"","4"=>"");
		$totprod = $arrhpp['BBB'] + $arrhpp['BTKL'] + $arrhpp['BOP'];
		$hppperqty = devide($totprod,$arrhpp['Qty']);
		$vare[] = array("keterangan"=>"<b>:: Biaya Produksi </b>","1"=>"","2"=>"","3"=>"","4"=>"");
		$vare[] = array("keterangan"=>"Biaya Bahan Baku","1"=>string_2s($arrhpp['BBB']),"2"=>"","3"=>"","4"=>"");
		$vare[] = array("keterangan"=>"Biaya Tenaga Kerja Langsung","1"=>string_2s($arrhpp['BTKL']),"2"=>"","3"=>"","4"=>"");
		$vare[] = array("keterangan"=>"Biaya Overhead Pabrik","1"=>string_2s($arrhpp['BOP']),"2"=>"","3"=>"","4"=>"");
		$vare[] = array("keterangan"=>"<b>Total Biaya Produksi </b>","1"=>"","2"=>string_2s($totprod),"3"=>"","4"=>"");
		$vare[] = array("keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");
		$vare[] = array("keterangan"=>"<b>Qty yang diproduksi</b>","1"=>"","2"=>string_2s($arrhpp['Qty']),"3"=>"","4"=>"");
		$vare[] = array("keterangan"=>"<b>Harga Pokok Per Produk</b>","1"=>"","2"=>"","3"=>string_2s($hppperqty),"4"=>"");
        savesession($this, "rpthpppstock_rpt", json_encode($vare)) ; 
        echo(' bos.rpthpproduksistock.openreport() ; ') ;
    }

    public function showreport(){
      $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
      $data = getsession($this,"rpthpppstock_rpt") ;      
      $data = json_decode($data,true) ;       
      if(!empty($data)){ 
      	$font = 9 ;
        $o    = array('paper'=>'A4', 'orientation'=>'p', 'export'=>"",
                        'opt'=>array('export_name'=>'DaftarNeraca_' . getsession($this, "username") ) ) ;
		$ketstock = $this->bdb->getval("keterangan", "kode = '{$va['stock']}'", "stock");
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>LAPORAN HARGA POKOK PRODUKSI Produk</b>",$font+4,array("justification"=>"center")) ;
        $this->bospdf->ezText("Periode : ".$va['tglawal']." sd ". $va['tglakhir'],$font+2,array("justification"=>"center")) ;
		$this->bospdf->ezText("Produk : ".$va['stock']."-".$ketstock,$font+2,array("justification"=>"center")) ;
		$this->bospdf->ezText("") ; 
		$this->bospdf->ezTable($data,"","",  
								array("showHeadings"=>"","showLines"=>"0","fontSize"=>$font,"cols"=> array( 
			                     "keterangan"=>array("caption"=>"Keterangan","wrap"=>1),
			                     "1"=>array("caption"=>"","width"=>15,"justification"=>"right"),
			                 	 "2"=>array("caption"=>"","width"=>15,"justification"=>"right"),
			                     "3"=>array("caption"=>"","width"=>15,"justification"=>"right"),
                                 "4"=>array("caption"=>"","width"=>15,"justification"=>"right")))) ;   
        //print_r($data) ;    
        $this->bospdf->ezStream() ; 
      }else{
         echo('data kosong') ;
      }
   }
}
?>
