
<?php
class Rpthpproduksi extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model("rpt/rpthpproduksi_m") ;
        $this->load->model("func/perhitungan_m") ;
        $this->bdb 	= $this->rpthpproduksi_m ;
        $this->ss  = "ssrpthpprodusi_" ;
    }  

    public function index(){ 
        $data['rekhppbbbawal']= $this->bdb->getconfig("rekhppbbbawal") ;
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
        $data['ketrekhppbdpakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekhppbdpakhir']}'", "keuangan_rekening");

        $this->load->view("rpt/rpthpproduksi",$data) ; 

    }

    public function saving(){
        $va 	= $this->input->post() ;

        $this->bdb->saveconfig("rekhppbbbawal", $va['rekhppbbbawal']) ;
        $this->bdb->saveconfig("rekhppbbbakhir", $va['rekhppbbbakhir']) ;
        $this->bdb->saveconfig("rekhppbbpawal", $va['rekhppbbpawal']) ;
        $this->bdb->saveconfig("rekhppbbpakhir", $va['rekhppbbpakhir']) ;
        $this->bdb->saveconfig("rekhppbtklawal", $va['rekhppbtklawal']) ;
        $this->bdb->saveconfig("rekhppbtklakhir", $va['rekhppbtklakhir']) ;
        $this->bdb->saveconfig("rekhppbopawal", $va['rekhppbopawal']) ;
        $this->bdb->saveconfig("rekhppbopakhir", $va['rekhppbopakhir']) ;
        $this->bdb->saveconfig("rekhppbdpawal", $va['rekhppbdpawal']) ;
        $this->bdb->saveconfig("rekhppbdpakhir", $va['rekhppbdpakhir']) ;

        echo('bos.rpthpproduksi.settab(0) ') ;
    }

    public function seekrekening(){
        $search     = $this->input->get('q');
        $vdb    = $this->bdb->seekrekening($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->bdb->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ".$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function loadgrid(){ 

        $va     = json_decode($this->input->post('request'), true) ; 
        $tglawal 	= $va['tglawal'] ; //date("d-m-Y") ;
        $tglakhir 	= $va['tglakhir'] ; //date("d-m-Y") ;
        $tglkemarin = date("d-m-Y",strtotime($tglawal)-(24*60*60)) ;

        $vare   = array() ;

        //persd barang dalam proses awal
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: Persediaan Barang Dalam Proses ".$tglkemarin."</b>","1"=>"","2"=>"","3"=>"","4"=>""); ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbdpawal"),$this->bdb->getconfig("rekhppbdpakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldoakhir = $this->perhitungan_m->getsaldo($tglkemarin,$dbr['kode']);
            $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],"1"=>"","2"=>"","3"=>$saldoakhir,"4"=>""); 
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>Jumlah Barang Dalam Proses ".$tglkemarin."</b>","1"=>"","2"=>"","3"=>"","4"=>""); ;

        //biaya produksi
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: Biaya Produksi </b>","1"=>"","2"=>"","3"=>"","4"=>"");
        $vare[] = array("kode"=>"","keterangan"=>"<b>Biaya Bahan Baku </b>","1"=>"","2"=>"","3"=>"","4"=>"");

        $saldoawal = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbbbawal"),$this->bdb->getconfig("rekhppbbbakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldoawal += $this->perhitungan_m->getsaldo($tglkemarin,$dbr['kode']);
        }

        $vare[] = array("kode"=>"","keterangan"=>"Persediaan Bahan Baku ".$tglkemarin,"1"=>$saldoawal,"2"=>"","3"=>"","4"=>"");

        $pembelian = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbbbawal"),$this->bdb->getconfig("rekhppbbbakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $pembelian += $this->perhitungan_m->getdebet($tglawal,$tglakhir,$dbr['kode'],"PB") ;  

        }
        $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>"Pembelian Bahan Baku","1"=>$pembelian,"2"=>"","3"=>"","4"=>"");

        $returpembelian = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbbbawal"),$this->bdb->getconfig("rekhppbbbakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $returpembelian += $this->perhitungan_m->getkredit($tglawal,$tglakhir,$dbr['kode'],"RB") ;

        }
        $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>"Retur Pembelian Bahan Baku","1"=>$returpembelian,"2"=>"","3"=>"","4"=>"");
        $pbbbbersih = $pembelian - $returpembelian;
        $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>"<b>Pembelian Bahan Baku Bersih</b>","1"=>$pbbbbersih,"2"=>"","3"=>"","4"=>"");
        $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>"Harga Pokok Pembelian Bahan Baku","1"=>"","2"=>$pbbbbersih,"3"=>"","4"=>"");
        $bbbtp = $saldoawal + $pembelian - $returpembelian;
        $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>"Bahan Baku Tersedia Untuk dipakai","1"=>"","2"=>"","3"=>$bbbtp,"4"=>"");

        //SALDO AKHIR bb
        $saldoakhir = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbbbawal"),$this->bdb->getconfig("rekhppbbbakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldoakhir += $this->perhitungan_m->getsaldo($tglakhir,$dbr['kode']);
        }

        $vare[] = array("kode"=>"","keterangan"=>"Persediaan Bahan Baku ".$tglakhir,"1"=>"","2"=>"","3"=>$saldoakhir,"4"=>"");
        $nJmlBBB = $bbbtp - $saldoakhir;
        $vare[] = array("kode"=>"","keterangan"=>"<b>Jumlah Biaya Bahan Baku</b>","1"=>"","2"=>"","3"=>"","4"=>$nJmlBBB);
        $vare[] = array("kode"=>"","keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");

        //Bahan penolong
        $vare[] = array("kode"=>"","keterangan"=>"<b>Biaya Bahan Penolong </b>","1"=>"","2"=>"","3"=>"","4"=>"");

        $saldoawal = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbbpawal"),$this->bdb->getconfig("rekhppbbpakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldoawal += $this->perhitungan_m->getsaldo($tglkemarin,$dbr['kode']);
        }

        $vare[] = array("kode"=>"","keterangan"=>"Persediaan Bahan Penolong ".$tglkemarin,"1"=>$saldoawal,"2"=>"","3"=>"","4"=>"");

        $pembelian = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbbpawal"),$this->bdb->getconfig("rekhppbbpakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $pembelian += $this->perhitungan_m->getdebet($tglawal,$tglakhir,$dbr['kode'],"PB") ;  

        }
        $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>"Pembelian Bahan Penolong","1"=>$pembelian,"2"=>"","3"=>"","4"=>"");

        $returpembelian = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbbpawal"),$this->bdb->getconfig("rekhppbbpakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $returpembelian += $this->perhitungan_m->getkredit($tglawal,$tglakhir,$dbr['kode'],"RB") ;

        }
        $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>"Retur Pembelian Bahan Penolong","1"=>$returpembelian,"2"=>"","3"=>"","4"=>"");
        $pbbbpersih = $pembelian - $returpembelian;
        $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>"<b>Pembelian Bahan Penolong Bersih</b>","1"=>$pbbbpersih,"2"=>"","3"=>"","4"=>"");
        $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>"Harga Pokok Pembelian Bahan Penolong","1"=>"","2"=>$pbbbpersih,"3"=>"","4"=>"");
        $bbptp = $saldoawal + $pembelian - $returpembelian;
        $vare[] = array("kode"=>$dbr['kode'],"keterangan"=>"Bahan Penolong Tersedia Untuk dipakai","1"=>"","2"=>"","3"=>$bbptp,"4"=>"");

        //SALDO AKHIR bp
        $saldoakhir = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbbpawal"),$this->bdb->getconfig("rekhppbbpakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldoakhir += $this->perhitungan_m->getsaldo($tglakhir,$dbr['kode']);
        }

        $vare[] = array("kode"=>"","keterangan"=>"Persediaan Bahan Penolong ".$tglakhir,"1"=>"","2"=>"","3"=>$saldoakhir,"4"=>"");
        $nJmlBBP = $bbptp - $saldoakhir;
        $vare[] = array("kode"=>"","keterangan"=>"<b>Jumlah Biaya Bahan Penolong</b>","1"=>"","2"=>"","3"=>"","4"=>$nJmlBBP);
        $vare[] = array("kode"=>"","keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");

        //btkl
        $btkl = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekprbtkldibebankan"),$this->bdb->getconfig("rekprbtkldibebankan")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $btkl += $this->perhitungan_m->getkredit($tglawal,$tglakhir,$dbr['kode'],"PR");
        }
        $vare[] = array("kode"=>"","keterangan"=>"Biaya Tenaga Kerja Langsung ","1"=>"","2"=>"","3"=>"","4"=>$btkl);

        //bop
        $bop = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekprbopdibebankan"),$this->bdb->getconfig("rekprbopdibebankan")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $bop += $this->perhitungan_m->getkredit($tglawal,$tglakhir,$dbr['kode'],"PR");
        }
        $vare[] = array("kode"=>"","keterangan"=>"Biaya Overhead Pabrik ","1"=>"","2"=>"","3"=>"","4"=>$bop);
        $vare[] = array("kode"=>"","keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");
		
		$selisih = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening('6.10.010.30','6.10.010.30') ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $selisih -= $this->perhitungan_m->getdebet($tglawal,$tglakhir,$dbr['kode'],"PD");
			$selisih += $this->perhitungan_m->getkredit($tglawal,$tglakhir,$dbr['kode'],"PD");
        }
        $vare[] = array("kode"=>"","keterangan"=>"Selisih Pembulatan ","1"=>"","2"=>"","3"=>"","4"=>$selisih);
        $vare[] = array("kode"=>"","keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");
		
		
		$totbdp = $bop + $btkl + $nJmlBBP + $nJmlBBB + $selisih; 
		$vare[] = array("keterangan"=>"<b>Total Biaya Produksi</b>","1"=>"","2"=>"","3"=>"","4"=>$totbdp);
        $vare[] = array("keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");
		
		$vare[] = array("keterangan"=>"<b>Total Tersedia Untuk diproduksi</b>","1"=>"","2"=>"","3"=>"","4"=>$totbdp);
        $vare[] = array("keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");

        //persd barang dalam proses akhir
        $bdpakhir = 0 ;
        $vare[] = array("kode"=>"","keterangan"=>"<b>:: Persediaan Barang Dalam Proses ".$tglakhir ."</b>","1"=>"","2"=>"","3"=>"","4"=>""); ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbdpawal"),$this->bdb->getconfig("rekhppbdpakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $bdpakhir += $this->perhitungan_m->getsaldo($tglakhir ,$dbr['kode']);
        }
        $vare[] = array("kode"=>"","keterangan"=>"<b>Jumlah Barang Dalam Proses ".$tglakhir ."</b>","1"=>"","2"=>"","3"=>"","4"=>$bdpakhir); ;
		
		$HPP = $totbdp - $bdpakhir;
		$vare[] = array("keterangan"=>"<b>Harga Pokok Produksi</b>","1"=>"","2"=>"","3"=>"","4"=>$HPP);
        $vare[] = array("keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");

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
        
        //persd barang dalam proses awal
        $bdpawal = 0 ;
        $vare[] = array("keterangan"=>"<b>:: Persediaan Barang Dalam Proses ".$tglkemarin."</b>","1"=>"","2"=>"","3"=>"","4"=>""); ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbdpawal"),$this->bdb->getconfig("rekhppbdpakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $bdpawal += $this->perhitungan_m->getsaldo($tglkemarin,$dbr['kode']);
        }
        $vare[] = array("keterangan"=>"<b>Jumlah Barang Dalam Proses ".$tglkemarin."</b>","1"=>"","2"=>string_2s($bdpawal),"3"=>"","4"=>""); ;

        //biaya produksi
        $vare[] = array("keterangan"=>"<b>:: Biaya Produksi </b>","1"=>"","2"=>"","3"=>"","4"=>"");
        $vare[] = array("keterangan"=>"<b>Biaya Bahan Baku </b>","1"=>"","2"=>"","3"=>"","4"=>"");

        $saldoawal = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbbbawal"),$this->bdb->getconfig("rekhppbbbakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldoawal += $this->perhitungan_m->getsaldo($tglkemarin,$dbr['kode']);
        }

        $vare[] = array("keterangan"=>"Persediaan Bahan Baku ".$tglkemarin,"1"=>string_2s($saldoawal),"2"=>"","3"=>"","4"=>"");

        $pembelian = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbbbawal"),$this->bdb->getconfig("rekhppbbbakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $pembelian += $this->perhitungan_m->getdebet($tglawal,$tglakhir,$dbr['kode'],"PB") ;  

        }
        $vare[] = array("keterangan"=>"Pembelian Bahan Baku","1"=>string_2s($pembelian),"2"=>"","3"=>"","4"=>"");

        $returpembelian = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbbbawal"),$this->bdb->getconfig("rekhppbbbakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $returpembelian += $this->perhitungan_m->getkredit($tglawal,$tglakhir,$dbr['kode'],"RB") ;

        }
        $vare[] = array("keterangan"=>"Retur Pembelian Bahan Baku","1"=>string_2s($returpembelian),"2"=>"","3"=>"","4"=>"");
        $pbbbbersih = $pembelian - $returpembelian;
        $vare[] = array("keterangan"=>"<b>Pembelian Bahan Baku Bersih</b>","1"=>string_2s($pbbbbersih),"2"=>"","3"=>"","4"=>"");
        $vare[] = array("keterangan"=>"Harga Pokok Pembelian Bahan Baku","1"=>"","2"=>string_2s($pbbbbersih),"3"=>"","4"=>"");
        $bbbtp = $saldoawal + $pembelian - $returpembelian;
        $vare[] = array("keterangan"=>"Bahan Baku Tersedia Untuk dipakai","1"=>"","2"=>"","3"=>string_2s($bbbtp),"4"=>"");

        //SALDO AKHIR bb
        $saldoakhir = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbbbawal"),$this->bdb->getconfig("rekhppbbbakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldoakhir += $this->perhitungan_m->getsaldo($tglakhir,$dbr['kode']);
        }

        $vare[] = array("keterangan"=>"Persediaan Bahan Baku ".$tglakhir,"1"=>"","2"=>"","3"=>string_2s($saldoakhir),"4"=>"");
        $nJmlBBB = $bbbtp - $saldoakhir;
        $vare[] = array("keterangan"=>"<b>Jumlah Biaya Bahan Baku</b>","1"=>"","2"=>"","3"=>"","4"=>string_2s($nJmlBBB));
        $vare[] = array("keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");

        //Bahan penolong
        $vare[] = array("keterangan"=>"<b>Biaya Bahan Penolong </b>","1"=>"","2"=>"","3"=>"","4"=>"");

        $saldoawal = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbbpawal"),$this->bdb->getconfig("rekhppbbpakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldoawal += $this->perhitungan_m->getsaldo($tglkemarin,$dbr['kode']);
        }

        $vare[] = array("keterangan"=>"Persediaan Bahan Penolong ".$tglkemarin,"1"=>string_2s($saldoawal),"2"=>"","3"=>"","4"=>"");

        $pembelian = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbbpawal"),$this->bdb->getconfig("rekhppbbpakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $pembelian += $this->perhitungan_m->getdebet($tglawal,$tglakhir,$dbr['kode'],"PB") ;  

        }
        $vare[] = array("keterangan"=>"Pembelian Bahan Penolong","1"=>string_2s($pembelian),"2"=>"","3"=>"","4"=>"");

        $returpembelian = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbbpawal"),$this->bdb->getconfig("rekhppbbpakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $returpembelian += $this->perhitungan_m->getkredit($tglawal,$tglakhir,$dbr['kode'],"RB") ;

        }
        $vare[] = array("keterangan"=>"Retur Pembelian Bahan Penolong","1"=>string_2s($returpembelian),"2"=>"","3"=>"","4"=>"");
        $pbbbpersih = $pembelian - $returpembelian;
        $vare[] = array("keterangan"=>"<b>Pembelian Bahan Penolong Bersih</b>","1"=>string_2s($pbbbpersih),"2"=>"","3"=>"","4"=>"");
        $vare[] = array("keterangan"=>"Harga Pokok Pembelian Bahan Penolong","1"=>"","2"=>string_2s($pbbbpersih),"3"=>"","4"=>"");
        $bbptp = $saldoawal + $pembelian - $returpembelian;
        $vare[] = array("keterangan"=>"Bahan Penolong Tersedia Untuk dipakai","1"=>"","2"=>"","3"=>string_2s($bbptp),"4"=>"");

        //SALDO AKHIR bp
        $saldoakhir = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbbpawal"),$this->bdb->getconfig("rekhppbbpakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $saldoakhir += $this->perhitungan_m->getsaldo($tglakhir,$dbr['kode']);
        }

        $vare[] = array("keterangan"=>"Persediaan Bahan Penolong ".$tglakhir,"1"=>"","2"=>"","3"=>string_2s($saldoakhir),"4"=>"");
        $nJmlBBP = $bbptp - $saldoakhir;
        $vare[] = array("keterangan"=>"<b>Jumlah Biaya Bahan Penolong</b>","1"=>"","2"=>"","3"=>"","4"=>string_2s($nJmlBBP));
        $vare[] = array("keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");

        //btkl
        $btkl = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekprbtkldibebankan"),$this->bdb->getconfig("rekprbtkldibebankan")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $btkl += $this->perhitungan_m->getdebet($tglawal,$tglakhir,$dbr['kode'],"PR");
        }
        $vare[] = array("keterangan"=>"Biaya Tenaga Kerja Langsung ","1"=>"","2"=>"","3"=>"","4"=>string_2s($btkl));

        //bop
        $bop = 0 ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekprbopdibebankan"),$this->bdb->getconfig("rekprbopdibebankan")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $bop += $this->perhitungan_m->getkredit($tglawal,$tglakhir,$dbr['kode'],"PR");
        }
        $vare[] = array("keterangan"=>"Biaya Overhead Pabrik ","1"=>"","2"=>"","3"=>"","4"=>string_2s($bop));
        $vare[] = array("keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");
		
		$totbdp = $bop + $btkl + $nJmlBBP + $nJmlBBB; 
		$vare[] = array("keterangan"=>"<b>Total Biaya Produksi</b>","1"=>"","2"=>"","3"=>"","4"=>string_2s($totbdp));
        $vare[] = array("keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");
		$vare[] = array("keterangan"=>"<b>Total Tersedia Untuk diproduksi</b>","1"=>"","2"=>"","3"=>"","4"=>string_2s($totbdp));
        $vare[] = array("keterangan"=>"","1"=>"","2"=>"","3"=>"","4"=>"");

        //persd barang dalam proses akhir
        $bdpakhir = 0 ;
        $vare[] = array("keterangan"=>"<b>:: Persediaan Barang Dalam Proses ".$tglakhir ."</b>","1"=>"","2"=>"","3"=>"","4"=>""); ;
        $vdb    = $this->perhitungan_m->loadrekening($this->bdb->getconfig("rekhppbdpawal"),$this->bdb->getconfig("rekhppbdpakhir")) ;
        while($dbr = $this->bdb->getrow($vdb) ){
            $bdpakhir += $this->perhitungan_m->getkredit($tglakhir ,$dbr['kode']);
        }
        $vare[] = array("keterangan"=>"<b>Jumlah Barang Dalam Proses ".string_2s($tglakhir) ."</b>","1"=>"","2"=>"","3"=>"","4"=>string_2s($bdpakhir)); 
		
		$HPP = $totbdp - $bdpakhir;
		$vare[] = array("keterangan"=>"<b>Harga Pokok Produksi</b>","1"=>"","2"=>"","3"=>"","4"=>string_2s($HPP));
        savesession($this, "rpthppp_rpt", json_encode($vare)) ; 
        echo(' bos.rpthpproduksi.openreport() ; ') ;
    }

    public function showreport(){
      $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
      $data = getsession($this,"rpthppp_rpt") ;      
      $data = json_decode($data,true) ;       
      if(!empty($data)){ 
      	$font = 10 ;
        $o    = array('paper'=>'A4', 'orientation'=>'l', 'export'=>"",
                        'opt'=>array('export_name'=>'DaftarNeraca_' . getsession($this, "username") ) ) ;
        $this->load->library('bospdf', $o) ;   
        $this->bospdf->ezText("<b>LAPORAN HARGA POKOK PRODUKSI</b>",$font+4,array("justification"=>"center")) ;
        $this->bospdf->ezText("Periode : ".$va['tglawal']." sd ". $va['tglakhir'],$font+2,array("justification"=>"center")) ;
		$this->bospdf->ezText("") ; 
		$this->bospdf->ezTable($data,"","",  
								array("showHeadings"=>"","showLines"=>"0","fontSize"=>$font,"cols"=> array( 
			                     "keterangan"=>array("caption"=>"Keterangan","wrap"=>1),
			                     "1"=>array("caption"=>"","width"=>15,"justification"=>"right"),
			                 	 "2"=>array("caption"=>"","width"=>13,"justification"=>"right"),
			                     "3"=>array("caption"=>"","width"=>13,"justification"=>"right"),
                                 "4"=>array("caption"=>"","width"=>13,"justification"=>"right")))) ;   
        //print_r($data) ;    
        $this->bospdf->ezStream() ; 
      }else{
         echo('data kosong') ;
      }
   }
}
?>
