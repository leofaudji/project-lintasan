<?php
class Perhitungan_m extends Bismillah_Model{

    public function getkepenyusutan($tglawal,$tgl,$lama){

        $ntgl     = date_2t($tgl) ;
        $njthtmp  = date_2t($tglawal) ;
        $ntglawal = date_2t($tglawal) ;
        $ke      = 0 ;

        while($njthtmp < $ntgl){
            $ke ++ ; 
            $njthtmp = nextmonth($ntglawal,$ke) ;
        }

        return $ke  ;
    }

    public function getpenyusutan($kode,$tgl){
        $tgl = date_2s($tgl);
        $va = array('awal'=>0,'bulan ini'=>0,'akhir'=>0,'ke'=>0,'jadwal'=>array()) ;
        $cfield = "kode,tglperolehan,hargaperolehan,residu,jenispenyusutan,lama,penyusutanperbulan,tarifpenyusutan,tglhabis" ;
        $dbData = $this->select("aset",$cfield,"Kode = '$kode' and (tglhabis > '$tgl' or tglhabis = '0000-00-00')") ;
        if($dbRow = $this->getrow($dbData)){
            if($dbRow['jenispenyusutan'] == "1"){ // metode garis lurus
                $dbRow ['tglperolehan'] = date_bom($dbRow ['tglperolehan']);
                $tgl = date_eom($tgl);
                $ke = $this->getkepenyusutan($dbRow ['tglperolehan'],$tgl,$dbRow['lama']*12) ; 
                $va ['ke'] = $ke;
                //if($dbRow['Status'] == 1 && $dbRow['TglPerolehan'] <= Date2String($dTgl)) $nKe ++ ; 
                $hargaperolehan = $dbRow ['hargaperolehan'] - $dbRow ['residu'] ;
                $penyusutan = round(devide($hargaperolehan,$dbRow['lama']*12),0) ;  
                if($ke == 0 and $dbRow['lama'] > 0){
                    $va ['awal'] = 0 ;
                    $va ['bulan ini'] = 0  ;
                    $va ['akhir'] = 0 ;
                }else if($ke < $dbRow['lama']*12){ 
                    $va ['awal'] = $penyusutan * ($ke - 1) ;
                    $va ['bulan ini'] = $penyusutan  ;
                    $va ['akhir'] = $va['awal'] + $va['bulan ini'] ;
                }else if($ke == $dbRow['lama']*12){
                    $va ['awal'] = $penyusutan * ($ke- 1) ;
                    $va ['akhir'] = $hargaperolehan ;   
                    $va ['bulan ini'] = $va['akhir'] - $va['awal'] ;
                }else if($dbRow['lama'] == 0){// untuk yg tidak di susustkan 
                    $va ['awal'] = $hargaperolehan ;
                    $va ['akhir'] = 0 ;
                    $va ['bulan ini'] = 0 ;

                }else{
                    $va ['awal'] = $hargaperolehan ;
                    $va ['akhir'] = $hargaperolehan ;
                    $va ['bulan ini'] = 0 ;
                }


                //echo(" Ke " . $nKe . " ++ " . $va ['Awal'] . " => " . $va ['Bulan Ini']  . " -> " . $va ['Akhir'] . " ; ") ;
            }else{ 
                $ntglperolehan = date_2t($dbRow ['tglperolehan']) ;
                $lama = $dbRow ['lama'] * 12 ; //- intval(date("m",$nTglPerolehan)) + 1 ;
                $lamathn = 0 ; 
                $saldo = $dbRow ['hargaperolehan'] - $dbRow ['residu'] ;
                $penyusutan = 0 ;
                for($n=1;$n<=$lama;$n++){
                    $djthtmp = date_eom(date("d-m-Y",nextmonth($ntglperolehan,$n-1))) ;
                    if($lamathn == 0 || intval(date("m",date_2t($djthtmp))) == 1){
                        $lamathn ++ ;
                        if($lamathn <= $dbRow ['lama']){ 
                            $penyusutan = round(($saldo * $dbRow ['tarifpenyusutan'])/1200) ;
                        }else{ 
                            $pembagi    = intval(date("m",$ntglperolehan)) - 1 ; 
                            $penyusutan = round($saldo / $pembagi,0) ;
                        }
                    } 
                    if($n == $lama) $penyusutan = $saldo - $dbRow ['residu'] ;
                    $saldo -= $penyusutan ;
                    $va ['jadwal'][$n] = array("ke"=>$n,"jthtmp"=>$djthtmp,"penyusutan"=>$penyusutan,"nilai buku"=>$saldo) ;
                }
                if(date_2t($dbRow ['tglperolehan']) <= date_2t($tgl)){ 
                    $ke = $this->getkepenyusutan($dbRow ['tglperolehan'],$tgl,10000) + 1 ;
                    $va ['ke'] = $ke;
                    if(isset($va ['jadwal'][$ke])){
                        $penyusutan = $va ['jadwal'][$ke]['penyusutan'] ;
                        $va ['bulan ini'] = $penyusutan ;
                        $va ['akhir'] = $dbRow ['hargaperolehan'] - $va ['jadwal'][$ke]['nilai buku'] ;
                        $va ['awal'] = $va ['akhir'] - $va ['bulan ini'] ;
                    }else if($ke > $lama){
                        $va ['bulan ini'] = 0 ;
                        $va ['awal'] = $dbRow ['hargaperolehan'] - $dbRow ['residu'] ;
                        $va ['akhir'] = $va ['awal'] ;
                    }
                }
            }       
        }  
        return $va ;
    }
    public function GetSaldoAkhirStock($cKode,$dTgl,$gudang='',$cabang=''){
        $dTgl = date_2s($dTgl);
        $cField = "ifnull(SUM(debet-kredit),0) as Saldo" ;
        $saldo = 0 ;
        $where = "stock = '$cKode' and Tgl <= '$dTgl'";
        if($gudang <> '') $where .= " and gudang = '$gudang'" ;
        if($cabang <> '') $where .= " and cabang = '$cabang'" ;
        $dbData = $this->select("stock_kartu",$cField,$where);
        if($dbr = $this->getrow($dbData)){
            $saldo = $dbr['Saldo'];
        }
        return $saldo;
    }

    public function getsaldohpstock($kode,$tgl,$cabang){
        $tgl = date_2s($tgl);
        $arrhp = array();
        $arr = array("hptot"=>0,"detailhp"=>array());
        $tglakhir = "0000-00-00";
        $field = "tgl"; 
        $where = "tgl <= '$tgl=' and kode = '$kode' and cabang = '$cabang'";
        $dbd = $this->select("stock_hp",$field,$where,"","","tgl desc","1");
        if($dbr = $this->getrow($dbd)){
            $tglakhir = $dbr['tgl'];
        }

        //lihat saldo kemarin
        $field = "faktur,tgl,kode,cabang,qty,hp,datetime"; 
        $where = "tgl = '$tglakhir' and kode = '$kode' and cabang = '$cabang'";
        $dbd = $this->select("stock_hp",$field,$where,"","","id asc");
        while($dbr = $this->getrow($dbd)){
            $arrhp[] = $dbr;
        }
        //hitung hp
        ksort($arrhp);
        $arr['detailhp'] = $arrhp;
        foreach($arrhp as $key => $val){
            $arr['hptot'] += $val['qty'] * $val['hp'];
        }

        return $arr;
    }

    public function gethistorydebetsaldo($kode,$tgl,$cabang,$saldo){
        $tgl = date_2s($tgl);
        $arrhp = array();
        $field = "faktur,tgl,stock,debet,datetime_insert,id,hp"; 
        $where = "tgl <= '$tgl' and stock = '$kode' and cabang = '$cabang' and faktur not like 'SP%' and debet > 0";
        $dbd = $this->select("stock_kartu",$field,$where,"","","tgl desc,datetime_insert desc,id desc");
        while($dbr = $this->getrow($dbd)){
            if($saldo > 0){
                $qty = min($saldo,$dbr['debet']);
                $arrhp[] = array("faktur"=>$dbr['faktur'],"tgl"=>$dbr['tgl'],"qty"=>$qty,"hp"=>$dbr['hp']);
                $saldo -= $qty;
            }else{
                break;
            }
        }
        krsort($arrhp);
        return $arrhp;
    }
    public function gethpstock($kode,$tglawal,$tglakhir,$saldo,$qtyambil,$cabang,$caraperhitungan,$periode){
        $tglawal = date_2s($tglawal);
        $tglakhir = date_2s($tglakhir);
        $saldostock = $saldo;
        $qtydikeluarkan = $qtyambil;
        $arr = array("hp"=>0,"hptot"=>0,"detailhp"=>array(),"hpdikeluarkan"=>0);
        $arrhp = array();

        //if($periode == "Hari"){


        //untuk mengambil saldo di tgl terakhir
        $tglsebelumnya = "0000-00-00";
        $field = "tgl"; 
        //$where = "tgl < '$tglawal' and kode = '$kode' and cabang = '$cabang'";
        $where = "tgl < '$tglawal' and kode = '$kode'";
        $dbd = $this->select("stock_hp",$field,$where,"","","tgl desc","1");
        if($dbr = $this->getrow($dbd)){
            $tglsebelumnya = $dbr['tgl'];
        }

        //lihat saldo kemarin
        $field = "faktur,tgl,kode,cabang,qty,hp,datetime"; 
        //$where = "tgl = '$tglsebelumnya' and kode = '$kode' and cabang = '$cabang'";
        $where = "tgl = '$tglsebelumnya' and kode = '$kode'";
        $dbd = $this->select("stock_hp",$field,$where,"","","id asc");
        while($dbr = $this->getrow($dbd)){
            $arrhp[] = $dbr;
        }

        //lihat pembelian, produksi hasil, retur jual per tgl periode, stock mutasi
        $tglsave = $tglsebelumnya;
        $field = "faktur,tgl,stock as kode,cabang,debet as qty,hp,datetime_insert datetime";
        //$where = "tgl >= '$tglawal' and tgl <= '$tglakhir' and stock = '$kode' and cabang = '$cabang' and debet > 0 ";
        $where = "tgl >= '$tglawal' and tgl <= '$tglakhir' and stock = '$kode' and debet > 0 ";
        $dbd = $this->select("stock_kartu",$field,$where,"","","tgl,datetime asc, id asc");
        $masukhariini = 0;
        while($dbr = $this->getrow($dbd)){
            $arrhp[] = $dbr;
            $masukhariini += $dbr['qty'];
            $tglsave = $tglakhir;
        }


        //lihat apakah ada mutasi keluar tgl skrg
        $field = "d.stock";
        //$where = "t.tgl >= '$tglawal' and t.tgl <= '$tglakhir' and d.stock = '$kode' and t.cabang = '$cabang'";
        $where = "t.tgl >= '$tglawal' and t.tgl <= '$tglakhir' and d.stock = '$kode'";
        $join = "left join pembelian_retur_total t on t.faktur = d.faktur";
        $dbd = $this->select("pembelian_retur_detail d",$field,$where,$join,"","d.id asc","1");
        if($dbr = $this->getrow($dbd)){
            $tglsave = $tglakhir;
        }

        $field = "d.stock";
        //$where = "t.tgl >= '$tglawal' and t.tgl <= '$tglakhir' and d.stock = '$kode' and t.cabang = '$cabang'";
        $where = "t.tgl >= '$tglawal' and t.tgl <= '$tglakhir' and d.stock = '$kode'";
        $join = "left join penjualan_total t on t.faktur = d.faktur";
        $dbd = $this->select("penjualan_detail d",$field,$where,$join,"","d.id asc","1");
        if($dbr = $this->getrow($dbd)){
            $tglsave = $tglakhir;
        }

        $field = "d.kode";
        //$where = "t.tgl >= '$tglawal' and t.tgl <= '$tglakhir' and d.kode = '$kode' and t.cabang = '$cabang'";
        $where = "t.tgl >= '$tglawal' and t.tgl <= '$tglakhir' and d.kode = '$kode'";
        $join = "left join stock_opname_posting_total t on t.faktur = d.faktur";
        $dbd = $this->select("stock_opname_posting_detail d",$field,$where,$join,"","d.id asc","1");
        if($dbr = $this->getrow($dbd)){
            $tglsave = $tglakhir;
        }
        
        $field = "d.stockfrom as kode";
        //$where = "t.tgl >= '$tglawal' and t.tgl <= '$tglakhir' and d.kode = '$kode' and t.cabang = '$cabang'";
        $where = "d.tgl >= '$tglawal' and d.tgl <= '$tglakhir' and d.stockfrom = '$kode'";
        $join = "";
        $dbd = $this->select("mutasi_stock d",$field,$where,$join,"","d.id asc","1");
        if($dbr = $this->getrow($dbd)){
            $tglsave = $tglakhir;
        }

       // print_r($arrhp);
        if($tglsave == $tglakhir){
            if($caraperhitungan == "F"){//fifo
                krsort($arrhp);
            }else{ //average
                $arrtotqtyavg = 0 ;
                $arrtothpavg = 0 ;
                $arravg = $arrhp;
                $arrhp = array();
                $arrhp[0] = array("faktur"=>"","tgl"=>"","kode"=>"","cabang"=>"","qty"=>"",
                                 "hp"=>"","datetime"=>"" );

                foreach($arravg as $key => $val){
                    $arrtotqtyavg += $val['qty'];
                    $arrtothpavg += $val['qty'] * $val['hp'];
                    if($arrhp[0]['datetime'] == "" || $arrhp[0]['datetime'] <= $val['datetime']){
                        $arrhp[0]['datetime'] = $val['datetime'];
                        $arrhp[0]['tgl'] = $val['tgl'];
                        $arrhp[0]['kode'] = $val['kode'];
                        $arrhp[0]['cabang'] = $val['cabang'];

                    }
                    $arrhp[0]['qty'] = $arrtotqtyavg;
                    $arrhp[0]['hp'] = devide($arrtothpavg,$arrtotqtyavg);

                }

            }

            $arrsave = array();
            foreach($arrhp as $key => $val){
                if($saldo > 0){
                    $qtypertr = min($saldo,$val['qty']);
                    if($qtypertr > 0){
                        $val['qty'] = $qtypertr;
                        $arrsave[] = $val;
                    }
                    $saldo -= $qtypertr;
                }
            }

            if($saldostock == 0){
                $arrsave[] = array("faktur"=>"kosong","tgl"=>$tglsave,"kode"=>$kode,"cabang"=>$cabang,"qty"=>0,"hp"=>0,"datetime"=>date("Y-m-d H:i:s"));
            }
            //if($kode == "1810000036") print_r($arrsave);
            krsort($arrsave);
            //print_r($arrsave);
            //mengurangsi saldo dengan stock di ambil
            foreach($arrsave as $key => $val){
                if($qtydikeluarkan > 0){
                    //$qtydikeluarkan = max($qtydikeluarkan,0);
                    $qtybts = min($val['qty'],$qtydikeluarkan);

                    $arr['hpdikeluarkan'] +=  $qtybts * $val['hp'];
                    $arrsave[$key]['qty'] = $val['qty'] - $qtybts ;
                    $qtydikeluarkan -= $qtybts;
                }

            }


            $this->delete("stock_hp","tgl = '$tglsave' and kode = '$kode'");

            foreach($arrsave as $key => $val){
                $val['tgl'] = $tglsave;
                if($val['qty'] >= 0){
                    if($val['qty'] == 0)$val['hp']=0;
                    $this->insert("stock_hp",$val);
                }
            }
            $arrhp = $arrsave; 
        }

        //hitung hp
        krsort($arrhp);
        $arr['detailhp'] = $arrhp;
        foreach($arrhp as $key => $val){
            $arr['hptot'] += $val['qty'] * $val['hp'];
        }

        return $arr;
    }

    public function getdetailsaldostock($kode,$tgl,$cabang=''){
        $tgl = date_2s($tgl);
        $arr = array("hp"=>0,"hptot"=>0,"detail"=>array(),"qtytot"=>0);

        $arrhp = array();
        //untuk mengambil saldo di tgl terakhir
        $tglsebelumnya = "0000-00-00";
        $field = "tgl"; 
        $where = "tgl <= '$tgl' and kode = '$kode'";
        //if($cabang == '')$where .= " and cabang = '$cabang'";
        $dbd = $this->select("stock_hp",$field,$where,"","","tgl desc","1");
        if($dbr = $this->getrow($dbd)){
            $tglsebelumnya = $dbr['tgl'];
        }

        //lihat saldo
        $field = "faktur,tgl,kode,cabang,qty,hp,datetime"; 
        $where = "tgl = '$tglsebelumnya' and kode = '$kode'";
      //  if($cabang == '')$where .= " and cabang = '$cabang'";
        $dbd = $this->select("stock_hp",$field,$where,"","","id asc");
        while($dbr = $this->getrow($dbd)){
            $arrhp[] = $dbr;
        }



        $arr['detailhp'] = $arrhp;
        foreach($arrhp as $key => $val){
            $arr['hptot'] += $val['qty'] * $val['hp'];
            $arr['qtytot'] += $val['qty'] ;
        }
        $arr['hp'] = devide($arr['hptot'],$arr['qtytot']);


        return $arr;
    }

    public function GetSaldoAkhirHutang($supplier,$tgl,$fkt='',$jenis='H'){
        $cField = "IFNULL(SUM(Debet-Kredit),0) as Saldo" ;
        if($jenis == 'P')$cField = "IFNULL(SUM(Kredit-Debet),0) as Saldo" ;
        $saldo = 0 ;
        $where = "supplier = '$supplier' and Tgl <= '$tgl'";
        if($fkt <> '') $where .= " and fkt = '$fkt'" ;
        if($jenis <> '') $where .= " and jenis = '$jenis'" ;
        $dbData = $this->select("hutang_kartu",$cField,$where);
        if($dbr = $this->getrow($dbData)){
            $saldo = $dbr['Saldo'];
        }
        return $saldo;
    }

    public function GetSaldoAkhirpiutang($customer,$tgl,$fkt='',$jenis='P'){
        $cField = "SUM(Debet-Kredit) as Saldo" ;
        if($jenis == 'U')$cField = "IFNULL(SUM(Kredit-Debet),0) as Saldo" ;
        $saldo = 0 ;
        $where = "customer = '$customer' and Tgl <= '$tgl'";
        if($fkt <> '') $where .= " and fkt = '$fkt'" ;
        if($jenis <> '') $where .= " and jenis = '$jenis'" ;
        $dbData = $this->select("piutang_kartu",$cField,$where);
        if($dbr = $this->getrow($dbData)){
            $saldo = $dbr['Saldo'];
        }
        return $saldo;
    }

    /**Keuangan**/
    public function getsaldoawal($tgl,$rekening,$rekening2='',$penihilan="T"){
        $c = substr($rekening,0,1) ;
        $tgl = date_2s($tgl) ; 
        $tglkemarin = date("Y-m-d",strtotime($tgl)-(24*60*60)) ;
        if($c == "1" || $c == "5" || $c == "6" || $c == "8" || $c == "9"){
            $f = "sum(debet-kredit) saldo" ; 
        }else{
            $f = "sum(kredit-debet) saldo" ;
        }
        $saldo = 0 ;
        if($rekening2 <> ""){
            $where = "rekening >= '$rekening' and rekening <= '$rekening2'";
        }else{
            $where = "rekening like '$rekening%'";
        }
        if($penihilan == "T"){
            $thn = date("Y",strtotime($tgl));
            $fktpenihilan = "TH".$thn;
            $where .= " and faktur not like '$fktpenihilan%'";
        }
        $where .= " and tgl <= '".$tglkemarin."'" ;
        $data = $this->select("keuangan_bukubesar", $f, $where) ;
        if($row = $this->getrow($data)){
            $saldo = $row['saldo'] ;
        }
        return $saldo ;    
    }
    public function getsaldo($tgl,$rekening,$rekening2='',$penihilan="T"){
        $c = substr($rekening,0,1) ;
        $tgl = date_2s($tgl) ; 
        if($c == "1" || $c == "5" || $c == "6" || $c == "8" || $c == "9"){
            $f = "sum(debet-kredit) saldo" ; 
        }else{
            $f = "sum(kredit-debet) saldo" ;
        }
        $saldo = 0 ;
        if($rekening2 <> ""){
            $where = "rekening >= '$rekening' and rekening <= '$rekening2'";
        }else{
            $where = "rekening like '$rekening%'";
        }
        if($penihilan == "T"){
            $thn = date("Y",strtotime($tgl));
            $fktpenihilan = "TH".$thn;
            $where .= " and faktur not like '$fktpenihilan%'";
        }
        $where .= " and tgl <= '".$tgl."'" ;
        $data = $this->select("keuangan_bukubesar", $f, $where) ;
        if($row = $this->getrow($data)){
            $saldo = $row['saldo'] ;
        }
        return $saldo ;    
    }


    public function getdebet($tglawal,$tglakhir,$rekening,$fakturlike = '',$rekening2='',$penihilan="T"){
        $tglawal = date_2s($tglawal) ; 
        $tglakhir = date_2s($tglakhir) ; 
        $f = "ifnull(sum(debet),0) debet" ; 
        $saldo = 0 ;
        if($rekening2 <> ""){
            $where =  "rekening >= '".$rekening."' and rekening <= '".$rekening2."'";
        }else{
            $where =  "rekening like '".$rekening."%'";
        }

        if($penihilan == "T"){
            $thn = date("Y",strtotime($tglakhir));
            $fktpenihilan = "TH".$thn;
            $where .= " and faktur not like '$fktpenihilan%'";
        }
        $where .= " and tgl <= '".$tglakhir."' and tgl >= '".$tglawal."'" ;
        if($fakturlike <> '')$where .= " and faktur like '".$fakturlike."%'";
        $data = $this->select("keuangan_bukubesar", $f, $where) ;
        if($row = $this->getrow($data)){
            $saldo = $row['debet'] ;
        }
        return $saldo ;    
    }

    public function getkredit($tglawal,$tglakhir,$rekening,$fakturlike = '',$rekening2='',$penihilan="T"){
        $tglawal = date_2s($tglawal) ; 
        $tglakhir = date_2s($tglakhir) ; 
        $f = "ifnull(sum(kredit),0) kredit" ; 
        $saldo = 0 ;
        if($rekening2 <> ""){
            $where =  "rekening >= '".$rekening."' and rekening <= '".$rekening2."'";
        }else{
            $where =  "rekening like '".$rekening."%'";
        }
        if($penihilan == "T"){
            $thn = date("Y",strtotime($tglakhir));
            $fktpenihilan = "TH".$thn;
            $where .= " and faktur not like '$fktpenihilan%'";
        }
        $where .= " and tgl <= '".$tglakhir."' and tgl >= '".$tglawal."'" ;
        if($fakturlike <> '')$where .= " and faktur like '".$fakturlike."%'";
        $data = $this->select("keuangan_bukubesar", $f, $where) ;
        if($row = $this->getrow($data)){
            $saldo = $row['kredit'] ;
        }
        return $saldo ;    
    }

    public function loadrekening($rekawal,$rekakhir){
        $where = array();
        $where[]  = "kode >= '$rekawal' and kode <= '$rekakhir'" ;
        $where    = implode(" AND ", $where) ;
        $field = "kode,keterangan,jenis";
        $join = "";
        $dbd      = $this->select("keuangan_rekening", $field, $where, $join, "", "kode ASC") ;
        return $dbd ;
    }

    public function getlr($tglawal,$tglakhir,$level=6){
        $tglkemarin = date("d-m-Y",strtotime($tglawal)-(24*60*60)) ;
        $n = 0;
        //pend opr
        $totpendopr = array("saldoawal"=>0,"debet"=>0,"kredit"=>0,"saldoakhir"=>0,"saldoakhirperiod"=>0);
        $rekawal = $this->getconfig("rekpendoprawal") ;
        $rekakhir = $this->getconfig("rekpendoprakhir") ;
        $dbd    = $this->loadrekening($rekawal,$rekakhir) ;
        while($dbr = $this->getrow($dbd)){
            $vs = $dbr;  
            $vs['saldoawal'] = $this->getsaldoawal($tglawal,$vs['kode']) ; 
            $vs['debet'] = $this->getdebet($tglawal,$tglakhir,$vs['kode']) ;  
            $vs['kredit'] = $this->getkredit($tglawal,$tglakhir,$vs['kode']) ;  
            $vs['saldoakhir'] = $vs['saldoawal'] + $vs['kredit'] - $vs['debet'];
            $vs['saldoakhirperiod'] = $vs['kredit'] - $vs['debet'];

            //sum tot
            if($vs['jenis'] == "D"){
                $totpendopr["saldoawal"] += $vs['saldoawal'];
                $totpendopr["debet"] += $vs['debet'];
                $totpendopr["kredit"] += $vs['kredit'];
                $totpendopr["saldoakhir"] += $vs['saldoakhir'];
                $totpendopr["saldoakhirperiod"] += $vs['saldoakhirperiod'];
            }
            $vs['saldoawal'] = string_2sz($vs['saldoawal']) ; 
            $vs['debet'] = string_2sz($vs['debet']) ; 
            $vs['kredit'] = string_2sz($vs['kredit']) ; 
            $vs['saldoakhir'] = string_2sz($vs['saldoakhir']) ; 
            $vs['saldoakhirperiod'] = string_2sz($vs['saldoakhirperiod']) ; 

            $arrkd = explode(".",$vs['kode']);
            $levelkd = count($arrkd);
            //bold text
            if($vs['jenis'] == "I" and $level > $levelkd){
                foreach($vs as $key => $val){
                    if($key <> "jenis")$vs[$key] = "<b>".$val."</b>";
                }
            }
            //unset($vs['jenis']);

            if($level >= $levelkd){
                $vare[$n++]    = $vs ;
            }
        }

        //HPP
        $tothpp = array("saldoawal"=>0,"debet"=>0,"kredit"=>0,"saldoakhir"=>0,"saldoakhirperiod"=>0);
        $rekawal = $this->getconfig("rekhppawal") ;
        $rekakhir = $this->getconfig("rekhppakhir") ;
        $dbd    = $this->loadrekening($rekawal,$rekakhir) ;
        while($dbr = $this->getrow($dbd)){
            $vs = $dbr;  
            $vs['saldoawal'] = $this->getsaldoawal($tglawal,$vs['kode']) ; 
            $vs['debet'] = $this->getdebet($tglawal,$tglakhir,$vs['kode']) ;  
            $vs['kredit'] = $this->getkredit($tglawal,$tglakhir,$vs['kode']) ; 
            $vs['saldoakhir'] = $vs['saldoawal'] + $vs['debet'] - $vs['kredit'];
            $vs['saldoakhirperiod'] = $vs['debet'] - $vs['kredit'];

            //sum 
            if($vs['jenis'] == "D"){
                $tothpp["saldoawal"] += $vs['saldoawal'];
                $tothpp["debet"] += $vs['debet'];
                $tothpp["kredit"] += $vs['kredit'];
                $tothpp["saldoakhir"] += $vs['saldoakhir'];
                $tothpp["saldoakhirperiod"] += $vs['saldoakhirperiod'];

            }
            $vs['saldoawal'] = string_2sz($vs['saldoawal']) ; 
            $vs['debet'] = string_2sz($vs['debet']) ; 
            $vs['kredit'] = string_2sz($vs['kredit']) ; 
            $vs['saldoakhir'] = string_2sz($vs['saldoakhir']) ; 
            $vs['saldoakhirperiod'] = string_2sz($vs['saldoakhirperiod']) ; 


            $arrkd = explode(".",$vs['kode']);
            $levelkd = count($arrkd);
            //bold text
            if($vs['jenis'] == "I" and $level > $levelkd){
                foreach($vs as $key => $val){
                    if($key <> "jenis")$vs[$key] = "<b>".$val."</b>";
                }
            }
            //unset($vs['jenis']);

            if($level >= $levelkd){
                $vare[$n++]    = $vs ;
            }
        }
        //pend - hpp
        $totpendbruto = array("saldoawal"=>$totpendopr["saldoawal"] - $tothpp["saldoawal"],
                              "debet"=>$totpendopr["debet"] - $tothpp["debet"],
                              "kredit"=>$totpendopr["kredit"] - $tothpp["kredit"],
                              "saldoakhir"=>$totpendopr["saldoakhir"] - $tothpp["saldoakhir"],
                              "saldoakhirperiod"=>$totpendopr["saldoakhirperiod"] - $tothpp["saldoakhirperiod"]);
        $vare[$n++] = array("kode"=>"","keterangan"=>"<b>LABA BRUTO</b>",
                            "saldoawal"=>"<b>".string_2sz($totpendbruto['saldoawal'])."</b>",
                            "debet"=>"<b>".string_2sz($totpendbruto['debet'])."</b>",
                            "kredit"=>"<b>".string_2sz($totpendbruto['kredit'])."</b>",
                            "saldoakhir"=>"<b>".string_2sz($totpendbruto['saldoakhir'])."</b>",
                            "saldoakhirperiod"=>"<b>".string_2sz($totpendbruto['saldoakhirperiod'])."</b>",
                            "jenis"=>"I");


        //by opr
        $totbyopr = array("saldoawal"=>0,"debet"=>0,"kredit"=>0,"saldoakhir"=>0,"saldoakhirperiod"=>0);
        $rekawal = $this->getconfig("rekbyoprawal") ;
        $rekakhir = $this->getconfig("rekbyoprakhir") ;
        $dbd    = $this->loadrekening($rekawal,$rekakhir) ;
        while($dbr = $this->getrow($dbd)){
            $vs = $dbr;  
            $vs['saldoawal'] = $this->getsaldoawal($tglawal,$vs['kode']) ; 
            $vs['debet'] = $this->getdebet($tglawal,$tglakhir,$vs['kode']) ;  
            $vs['kredit'] = $this->getkredit($tglawal,$tglakhir,$vs['kode']) ; 
            $vs['saldoakhir'] = $vs['saldoawal'] + $vs['debet'] - $vs['kredit'];
            $vs['saldoakhirperiod'] = $vs['debet'] - $vs['kredit'];

            //sum 
            if($vs['jenis'] == "D"){
                $totbyopr["saldoawal"] += $vs['saldoawal'];
                $totbyopr["debet"] += $vs['debet'];
                $totbyopr["kredit"] += $vs['kredit'];
                $totbyopr["saldoakhir"] += $vs['saldoakhir'];
                $totbyopr["saldoakhirperiod"] += $vs['saldoakhirperiod'];
            }
            $vs['saldoawal'] = string_2sz($vs['saldoawal']) ; 
            $vs['debet'] = string_2sz($vs['debet']) ; 
            $vs['kredit'] = string_2sz($vs['kredit']) ; 
            $vs['saldoakhir'] = string_2sz($vs['saldoakhir']) ; 
            $vs['saldoakhirperiod'] = string_2sz($vs['saldoakhirperiod']) ; 


            $arrkd = explode(".",$vs['kode']);
            $levelkd = count($arrkd);
            //bold text
            if($vs['jenis'] == "I" and $level > $levelkd){
                foreach($vs as $key => $val){
                    if($key <> "jenis")$vs[$key] = "<b>".$val."</b>";
                }
            }
            //unset($vs['jenis']);

            if($level >= $levelkd){
                $vare[$n++]    = $vs ;
            }
        }

        //pend - by opr
        $totlropr = array("saldoawal"=>$totpendbruto["saldoawal"] - $totbyopr["saldoawal"],
                          "debet"=>$totpendbruto["debet"] - $totbyopr["debet"],
                          "kredit"=>$totpendbruto["kredit"] - $totbyopr["kredit"],
                          "saldoakhir"=>$totpendbruto["saldoakhir"] - $totbyopr["saldoakhir"],
                          "saldoakhirperiod"=>$totpendbruto["saldoakhirperiod"] - $totbyopr["saldoakhirperiod"]);
        $vare[$n++] = array("kode"=>"","keterangan"=>"<b>LABA RUGI OPERASIONAL</b>",
                            "saldoawal"=>"<b>".string_2sz($totlropr['saldoawal'])."</b>",
                            "debet"=>"<b>".string_2sz($totlropr['debet'])."</b>",
                            "kredit"=>"<b>".string_2sz($totlropr['kredit'])."</b>",
                            "saldoakhir"=>"<b>".string_2sz($totlropr['saldoakhir'])."</b>",
                            "saldoakhirperiod"=>"<b>".string_2sz($totlropr['saldoakhirperiod'])."</b>",
                            "jenis"=>"I");

        //pend non opr
        $totpendnonopr = array("saldoawal"=>0,"debet"=>0,"kredit"=>0,"saldoakhir"=>0,"saldoakhirperiod"=>0);
        $rekawal = $this->getconfig("rekpendnonoprawal") ;
        $rekakhir = $this->getconfig("rekpendnonoprakhir") ;
        $dbd    = $this->loadrekening($rekawal,$rekakhir) ;
        while($dbr = $this->getrow($dbd)){
            $vs = $dbr;  
            $vs['saldoawal'] = $this->getsaldoawal($tglawal,$vs['kode']) ; 
            $vs['debet'] = $this->getdebet($tglawal,$tglakhir,$vs['kode']) ;  
            $vs['kredit'] = $this->getkredit($tglawal,$tglakhir,$vs['kode']) ; 
            $vs['saldoakhir'] = $vs['saldoawal'] + $vs['kredit'] - $vs['debet'];
            $vs['saldoakhirperiod'] = $vs['kredit'] - $vs['debet'];

            //sum tot
            if($vs['jenis'] == "D"){
                $totpendnonopr["saldoawal"] += $vs['saldoawal'];
                $totpendnonopr["debet"] += $vs['debet'];
                $totpendnonopr["kredit"] += $vs['kredit'];
                $totpendnonopr["saldoakhir"] += $vs['saldoakhir'];
                $totpendnonopr["saldoakhirperiod"] += $vs['saldoakhirperiod'];
            }
            $vs['saldoawal'] = string_2sz($vs['saldoawal']) ; 
            $vs['debet'] = string_2sz($vs['debet']) ; 
            $vs['kredit'] = string_2sz($vs['kredit']) ; 
            $vs['saldoakhir'] = string_2sz($vs['saldoakhir']) ; 
            $vs['saldoakhirperiod'] = string_2sz($vs['saldoakhirperiod']) ; 

            $arrkd = explode(".",$vs['kode']);
            $levelkd = count($arrkd);
            //bold text
            if($vs['jenis'] == "I" and $level > $levelkd){
                foreach($vs as $key => $val){
                    if($key <> "jenis")$vs[$key] = "<b>".$val."</b>";
                }
            }
            //unset($vs['jenis']);

            if($level >= $levelkd){
                $vare[$n++]    = $vs ;
            }
        }

        //by non opr
        $totbynonopr = array("saldoawal"=>0,"debet"=>0,"kredit"=>0,"saldoakhir"=>0,"saldoakhirperiod"=>0);
        $rekawal = $this->getconfig("rekbynonoprawal") ;
        $rekakhir = $this->getconfig("rekbynonoprakhir") ;
        $dbd    = $this->loadrekening($rekawal,$rekakhir) ;
        while($dbr = $this->getrow($dbd)){
            $vs = $dbr;  
            $vs['saldoawal'] = $this->getsaldoawal($tglawal,$vs['kode']) ; 
            $vs['debet'] = $this->getdebet($tglawal,$tglakhir,$vs['kode']) ;  
            $vs['kredit'] = $this->getkredit($tglawal,$tglakhir,$vs['kode']) ; 
            $vs['saldoakhir'] = $vs['saldoawal'] + $vs['debet'] - $vs['kredit'];
            $vs['saldoakhirperiod'] = $vs['debet'] - $vs['kredit'];

            //sum 
            if($vs['jenis'] == "D"){
                $totbynonopr["saldoawal"] += $vs['saldoawal'];
                $totbynonopr["debet"] += $vs['debet'];
                $totbynonopr["kredit"] += $vs['kredit'];
                $totbynonopr["saldoakhir"] += $vs['saldoakhir'];
                $totbynonopr["saldoakhirperiod"] += $vs['saldoakhirperiod'];
            }
            $vs['saldoawal'] = string_2sz($vs['saldoawal']) ; 
            $vs['debet'] = string_2sz($vs['debet']) ; 
            $vs['kredit'] = string_2sz($vs['kredit']) ; 
            $vs['saldoakhir'] = string_2sz($vs['saldoakhir']) ; 
            $vs['saldoakhirperiod'] = string_2sz($vs['saldoakhirperiod']) ; 


            $arrkd = explode(".",$vs['kode']);
            $levelkd = count($arrkd);
            //bold text
            if($vs['jenis'] == "I" and $level > $levelkd){
                foreach($vs as $key => $val){
                    if($key <> "jenis")$vs[$key] = "<b>".$val."</b>";
                }
            }
            //unset($vs['jenis']);

            if($level >= $levelkd){
                $vare[$n++]    = $vs ;
            }
        }

        //pend - by non opr
        $totlrnonopr = array("saldoawal"=>$totpendnonopr["saldoawal"] - $totbynonopr["saldoawal"],
                             "debet"=>$totpendnonopr["debet"] - $totbynonopr["debet"],
                             "kredit"=>$totpendnonopr["kredit"] - $totbynonopr["kredit"],
                             "saldoakhir"=>$totpendnonopr["saldoakhir"] - $totbynonopr["saldoakhir"],
                             "saldoakhirperiod"=>$totpendnonopr["saldoakhirperiod"] - $totbynonopr["saldoakhirperiod"]);
        $vare[$n++] = array("kode"=>"","keterangan"=>"<b>LABA RUGI NON OPERASIONAL</b>",
                            "saldoawal"=>"<b>".string_2sz($totlrnonopr['saldoawal'])."</b>",
                            "debet"=>"<b>".string_2sz($totlrnonopr['debet'])."</b>",
                            "kredit"=>"<b>".string_2sz($totlrnonopr['kredit'])."</b>",
                            "saldoakhir"=>"<b>".string_2sz($totlrnonopr['saldoakhir'])."</b>",
                            "saldoakhirperiod"=>"<b>".string_2sz($totlrnonopr['saldoakhirperiod'])."</b>",
                            "jenis"=>"I");

        //LR sebelum pajak
        $totlrsblmpjk = array("saldoawal"=>$totlropr["saldoawal"] + $totlrnonopr["saldoawal"],
                              "debet"=>$totlropr["debet"] + $totlrnonopr["debet"],
                              "kredit"=>$totlropr["kredit"] + $totlrnonopr["kredit"],
                              "saldoakhir"=>$totlropr["saldoakhir"] + $totlrnonopr["saldoakhir"],
                              "saldoakhirperiod"=>$totlropr["saldoakhirperiod"] + $totlrnonopr["saldoakhirperiod"]);
        $vare[$n++] = array("kode"=>"","keterangan"=>"<b>LABA RUGI SEBELUM PAJAK</b>",
                            "saldoawal"=>"<b>".string_2sz($totlrsblmpjk['saldoawal'])."</b>",
                            "debet"=>"<b>".string_2sz($totlrsblmpjk['debet'])."</b>",
                            "kredit"=>"<b>".string_2sz($totlrsblmpjk['kredit'])."</b>",
                            "saldoakhir"=>"<b>".string_2sz($totlrsblmpjk['saldoakhir'])."</b>",
                            "saldoakhirperiod"=>"<b>".string_2sz($totlrsblmpjk['saldoakhirperiod'])."</b>",
                            "jenis"=>"I");

        //pajak
        $totpajak = array("saldoawal"=>0,"debet"=>0,"kredit"=>0,"saldoakhir"=>0,"saldoakhirperiod"=>0);
        $rekawal = $this->getconfig("rekpajakawal") ;
        $rekakhir = $this->getconfig("rekpajakakhir") ;
        $dbd    = $this->loadrekening($rekawal,$rekakhir) ;
        while($dbr = $this->getrow($dbd)){
            $vs = $dbr;  
            $vs['saldoawal'] = $this->getsaldoawal($tglawal,$vs['kode']) ; 
            $vs['debet'] = $this->getdebet($tglawal,$tglakhir,$vs['kode']) ;  
            $vs['kredit'] = $this->getkredit($tglawal,$tglakhir,$vs['kode']) ; 
            $vs['saldoakhir'] = $vs['saldoawal'] + $vs['debet'] - $vs['kredit'];
            $vs['saldoakhirperiod'] = $vs['debet'] - $vs['kredit'];

            //sum 
            if($vs['jenis'] == "D"){
                $totpajak["saldoawal"] += $vs['saldoawal'];
                $totpajak["debet"] += $vs['debet'];
                $totpajak["kredit"] += $vs['kredit'];
                $totpajak["saldoakhir"] += $vs['saldoakhir'];
                $totpajak["saldoakhirperiod"] += $vs['saldoakhirperiod'];
            }
            $vs['saldoawal'] = string_2sz($vs['saldoawal']) ; 
            $vs['debet'] = string_2sz($vs['debet']) ; 
            $vs['kredit'] = string_2sz($vs['kredit']) ; 
            $vs['saldoakhir'] = string_2sz($vs['saldoakhir']) ; 
            $vs['saldoakhirperiod'] = string_2sz($vs['saldoakhirperiod']) ; 


            $arrkd = explode(".",$vs['kode']);
            $levelkd = count($arrkd);
            //bold text
            if($vs['jenis'] == "I" and $level > $levelkd){
                foreach($vs as $key => $val){
                    if($key <> "jenis")$vs[$key] = "<b>".$val."</b>";
                }
            }
            //unset($vs['jenis']);

            if($level >= $levelkd){
                $vare[$n++]    = $vs ;
            }
        }

        //LR setelah pajak
        $totlrstlhpjk = array("saldoawal"=>$totlrsblmpjk["saldoawal"] - $totpajak["saldoawal"],
                              "debet"=>$totlrsblmpjk["debet"] - $totpajak["debet"],
                              "kredit"=>$totlrsblmpjk["kredit"] - $totpajak["kredit"],
                              "saldoakhir"=>$totlrsblmpjk["saldoakhir"] - $totpajak["saldoakhir"],
                              "saldoakhirperiod"=>$totlrsblmpjk["saldoakhirperiod"] - $totpajak["saldoakhirperiod"]);
        $vare[$n++] = array("kode"=>"","keterangan"=>"<b>LABA RUGI SETELAH PAJAK</b>",
                            "saldoawal"=>"<b>".string_2sz($totlrstlhpjk['saldoawal'])."</b>",
                            "debet"=>"<b>".string_2sz($totlrstlhpjk['debet'])."</b>",
                            "kredit"=>"<b>".string_2sz($totlrstlhpjk['kredit'])."</b>",
                            "saldoakhir"=>"<b>".string_2sz($totlrstlhpjk['saldoakhir'])."</b>",
                            "saldoakhirperiod"=>"<b>".string_2sz($totlrstlhpjk['saldoakhirperiod'])."</b>",
                            "jenis"=>"I");

        //tampilkan ke grid
        $vare   = array("total"=>count($vare),"records"=>$vare,"lrstlhpjk"=>$totlrstlhpjk) ;
        return $vare;
    }

    function getcfghpp($tgl){
        $tgl = date_2s($tgl);
        $va = array("caraperhitungan"=>"","periode"=>"","bdp"=>"");
        $where = "Tgl <= '$tgl'";
        $field = "*";
        $dbData = $this->select("sys_config_hpp",$field,$where,'','','Tgl desc',1);
        if($dbr = $this->getrow($dbData)){
            $va = $dbr;
        }
        return $va;

    }

    function analisapenjualanproduk($kode,$tglawal,$tglakhir){
        $tglawal = date_2s($tglawal);
        $tglakhir = date_2s($tglakhir);
        $arr = array("penjualan"=>0,"hpp"=>0,"margin"=>0,"persmargin"=>0);
        $field = "sum(d.totalitem) as penjualan,sum(d.hp * d.qty) as hpp";
        $where = "d.stock = '$kode' and t.tgl >= '$tglawal' and t.tgl <= '$tglakhir' and t.status = '1'";
        $join = "left join penjualan_total t on t.faktur = d.faktur";
        $dbd = $this->select("penjualan_detail d",$field,$where,$join,'','');
        if($dbr = $this->getrow($dbd)){
            $arr['penjualan'] += $dbr['penjualan'];
            $arr['hpp'] += $dbr['hpp'];
        }

        $arr['margin'] = $arr['penjualan'] - $arr['hpp'];
        $arr['persmargin'] = devide($arr['margin'],$arr['penjualan']) *100;
        return $arr;
    }

    function gethjstock($kode,$qty,$tgl='0000-00-00'){
        $arr = array("hargajual"=>0,"diskon"=>0);
        //mencari harga utama
        $dbd2 = $this->select("stock_hj","ifnull(hj,0) as hj","kode = '$kode'",'','','qty asc','1');
        if($dbr2 = $this->getrow($dbd2)){
                $arr['hargajual'] = $dbr2['hj'];
        }

        $dbd = $this->select("stock_hj","ifnull(hj,0) as hj","qty >= '$qty' and kode = '$kode'",'','','qty asc','1');
        if($dbr = $this->getrow($dbd)){
            $arr['diskon'] = $arr['hargajual'] - $dbr['hj'];
        }else{
            //jika tidak ditemukan maka mengambil dari daftarharga qty terbesar
            $dbd3 = $this->select("stock_hj","ifnull(hj,0) as hj","kode = '$kode'",'','','qty desc','1');
            if($dbr3 = $this->getrow($dbd2)){
                $arr['diskon'] = $arr['hargajual'] - $dbr3['hj'];
            }

        }

        return $arr;
    }
    
    function gethjbertingkat($cStock){
        $va  = array() ;
        $field   = "hj,qty";
        $where   = "Kode = '$cStock'";
        $dbd   = $this->select("stock_hj h",$field,$where,"","","qty asc");
        $qty = 1;
        while($dbr = $this->getrow($dbd)){
            $va[$dbr['qty']] = array("qtyawal"=>$qty,"qtyakhir"=>$dbr['qty'],"hj"=>$dbr['hj']);
            $qty = $dbr['qty'] + 1;
        }
        return $va;
    }

    function gethjterendah($stock){
        $return  = 0 ;
        $field   = "hj,qty";
        $where   = "kode = '$stock'";
        $dbd   = $this->select("stock_hj h",$field,$where,"","","hj asc","1");
        while($dbr = $this->getrow($dbd)){
            $return  = $dbr['hj'] ;
        }
        return $return;
    }
    
    function gethbterakhir($stock,$tgl){
        $tgl = date_2s($tgl);
        $return  = 0 ;
        $field   = "d.hp";
        $where   = "d.stock = '$stock' and t.status = '1' and t.tgl <= '$tgl'";
        $join    = "left join pembelian_total t on t.faktur = d.faktur";
        $dbd   = $this->select("pembelian_detail d",$field,$where,$join,"","t.tgl desc","1");
        while($dbr = $this->getrow($dbd)){
            $return  = $dbr['hp'] ;
        }
        return $return;
    }
    
    function getsupplierpembelianstockterakhir($stock,$tgl){
        $tgl = date_2s($tgl);
        $return  = 0 ;
        $field   = "t.supplier";
        $where   = "d.stock = '$stock' and t.status = '1' and t.tgl <= '$tgl'";
        $join    = "left join pembelian_total t on t.faktur = d.faktur";
        $dbd   = $this->select("pembelian_detail d",$field,$where,$join,"","t.tgl desc","1");
        while($dbr = $this->getrow($dbd)){
            $return  = $dbr['supplier'] ;
        }
        return $return;
    }
}
?>
