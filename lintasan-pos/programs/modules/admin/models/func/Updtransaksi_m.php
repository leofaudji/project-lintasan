<?php
class Updtransaksi_m extends Bismillah_Model{
    public function __construct(){
        parent::__construct() ;
        $this->load->model('func/perhitungan_m') ;
    }
    public function updjurnal($faktur,$cabang,$tgl='0000-00-00',$rekening,$keterangan,$debet=0,$kredit=0,$datetime='0000-00-00 00:00:00',$username=''){
        $tgl = date_2s($tgl);
        $arr  = array("faktur"=>$faktur,"cabang"=>$cabang,"tgl"=>$tgl,"rekening"=>$rekening,
                      "keterangan"=>sql_2sql($keterangan),"debet"=>string_2n($debet),"kredit"=>string_2n($kredit),
                      "datetime"=>$datetime,"username"=>$username);
        $this->insert("keuangan_jurnal",$arr);
    }

    public function updbukubesar($faktur,$cabang,$tgl='0000-00-00',$rekening,$keterangan,$debet=0,$kredit=0,$datetime='0000-00-00 00:00:00',$username=''){
        if($debet >0 or $kredit > 0){
            $tgl = date_2s($tgl);
            $arr  = array("faktur"=>$faktur,"cabang"=>$cabang,"tgl"=>$tgl,"rekening"=>$rekening,
                          "keterangan"=>sql_2sql($keterangan),"debet"=>string_2n($debet),"kredit"=>string_2n($kredit),
                          "datetime"=>$datetime,"username"=>$username);
            $this->insert("keuangan_bukubesar",$arr);
        }
    }

    public function updrekjurnal($faktur){
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;
        $where    = "faktur = '$faktur'";
        $join     = "";
        $field    = "faktur,cabang,tgl,rekening,keterangan,debet,kredit,datetime,username";
        $dbd      = $this->select("keuangan_jurnal", $field, $where, $join, "", "debet desc") ;
        while( $dbr = $this->getrow($dbd) ){
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr['rekening'],$dbr['keterangan'],$dbr['debet'],$dbr['kredit'],$dbr['datetime'],$dbr['username']);
        }
    }
    public function updkartustock($faktur,$stock,$tgl='0000-00-00',$gudang,$cabang,$keterangan,$debet=0,$kredit=0,$hp=0,$username='',$datetime='0000-00-00 00:00:00'){
        if($debet >0 or $kredit > 0){
            if($username == '')$username = getsession($this, "username");
            $vainsert = array("faktur"=>$faktur,"stock"=>$stock,"tgl"=>$tgl,"keterangan"=>$keterangan,"debet"=>$debet,"kredit"=>$kredit,
                              "gudang"=>$gudang,"cabang"=>$cabang,"hp"=>$hp,"username"=>$username,"datetime_insert"=>$datetime);
            $this->insert("stock_kartu",$vainsert);
        }

    }

    public function updkartuhutang($faktur,$fkt,$supplier,$tgl='0000-00-00',$cabang,$keterangan,$debet=0,$kredit=0,$username='',$datetime='0000-00-00 00:00:00',$jenis='H'){
        if($debet >0 or $kredit > 0){
            if($username == '')$username = getsession($this, "username");
            if($datetime == '0000-00-00 00:00:00')$datetime = date("Y-m-d H:i:s");
            $vainsert = array("faktur"=>$faktur,"fkt"=>$fkt,"supplier"=>$supplier,"tgl"=>$tgl,
                              "keterangan"=>$keterangan,"debet"=>$debet,"kredit"=>$kredit,"jenis"=>$jenis,
                              "cabang"=>$cabang,"username"=>$username,"datetime"=>$datetime);
            $this->insert("hutang_kartu",$vainsert);
        }
    }

    public function updkartupiutang($faktur,$fkt,$customer,$tgl='0000-00-00',$cabang,$keterangan,$debet=0,$kredit=0,$username='',$datetime='0000-00-00 00:00:00',$jenis='P'){
        if($debet >0 or $kredit > 0){
            if($username == '')$username = getsession($this, "username");
            if($datetime == '0000-00-00 00:00:00')$datetime = date("Y-m-d H:i:s");
            $vainsert = array("faktur"=>$faktur,"fkt"=>$fkt,"customer"=>$customer,"tgl"=>$tgl,
                              "keterangan"=>$keterangan,"debet"=>$debet,"kredit"=>$kredit,"jenis"=>$jenis,
                              "cabang"=>$cabang,"username"=>$username,"datetime"=>$datetime);
            $this->insert("piutang_kartu",$vainsert);
        }
    }
    /********************pembelian*******************************/
    public function updkartustockreturpembelian($faktur){
        $this->delete("stock_kartu", "faktur = '$faktur'" ) ;
        $field      = "d.id,d.faktur,d.stock,d.harga,d.qty,d.totalitem,t.username,t.tgl,t.gudang,t.cabang,s.nama,t.datetime";
        $where      = "d.faktur = '$faktur'";
        $join       = "left join pembelian_retur_total t on t.faktur = d.faktur left join supplier s on s.kode = t.supplier";

        $dbd        = $this->select("pembelian_retur_detail d", $field, $where, $join, "") ;
        while($dbr  = $this->getrow($dbd)){
            $hp = 0;
            $keterangan = "Retur pembelian stock ".$dbr['nama'];
            $cfghpp = $this->perhitungan_m->getcfghpp($dbr['tgl']);
            $saldoqty = $this->perhitungan_m->GetSaldoAkhirStock($dbr['stock'],$dbr['tgl']) ;
            $arrhp = $this->perhitungan_m->gethpstock($dbr['stock'],$dbr['tgl'],$dbr['tgl'],$saldoqty,$dbr['qty'],$dbr['cabang'],
                                                      $cfghpp['caraperhitungan'],$cfghpp['periode']);
            $hp = devide($arrhp['hpdikeluarkan'],$dbr['qty']);
            $this->edit("pembelian_retur_detail",array("hp"=>$hp),"id = '{$dbr['id']}'");
            if($dbr['totalitem'] > 0 and $dbr['qty'] > 0) $hp = $dbr['totalitem'] / $dbr['qty'];
            $this->updkartustock($faktur,$dbr['stock'],$dbr['tgl'],$dbr['gudang'],$dbr['cabang'],$keterangan,0,$dbr['qty'],
                                 $hp,$dbr['username'],$dbr['datetime']);
        }
    }

    public function updkartustockpembelian($faktur){
        $this->delete("stock_kartu", "faktur = '$faktur'" ) ;
        $field = "d.id,d.faktur,d.stock,d.harga,d.qty,d.totalitem,d.username,t.tgl,t.gudang,t.cabang,t.datetime_insert as datetime,t.persppn";
        $where = "d.faktur = '$faktur'";
        $join = "left join pembelian_total t on t.faktur = d.faktur";
        $keterangan = "pembelian stock fkt[".$faktur."]";
        $dbd      = $this->select("pembelian_detail d", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $hp = 0;
            if($dbr['totalitem'] > 0 and $dbr['qty'] > 0){
                $hp = devide($dbr['totalitem'] ,$dbr['qty']);
                $hp += $hp * devide($dbr['persppn'],100);
            }
            $this->edit("pembelian_detail",array("hp"=>$hp),"id = '{$dbr['id']}'");
            $this->updkartustock($faktur,$dbr['stock'],$dbr['tgl'],$dbr['gudang'],$dbr['cabang'],$keterangan,$dbr['qty'],
                                 0,$hp,$dbr['username'],$dbr['datetime']);

            $cfghpp = $this->perhitungan_m->getcfghpp($dbr['tgl']);
            $saldoqty = $this->perhitungan_m->GetSaldoAkhirStock($dbr['stock'],$dbr['tgl'],"",$dbr['cabang']) ;
            $arrhp = $this->perhitungan_m->gethpstock($dbr['stock'],$dbr['tgl'],$dbr['tgl'],$saldoqty,0,$dbr['cabang'],
                                                      $cfghpp['caraperhitungan'],$cfghpp['periode']);
        }
    }

    public function updrekpembelian($faktur){
        $rekkas = getsession($this, "rekkas") ;
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;
        $field = "t.faktur,t.tgl,t.cabang,s.nama,t.subtotal,t.diskon,t.pembulatan,t.ppn,t.total,t.hutang,t.kas,t.username,t.datetime_insert datetime";
        $where = "t.faktur = '$faktur'";
        $join = "left join supplier s on s.kode = t.supplier";
        $dbd      = $this->select("pembelian_total t", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $vapersd = array();
            $f = "d.stock,d.harga,d.qty,d.jumlah,d.totalitem,g.keterangan,g.rekpersd,s.stock_group,d.hp";
            $w = "d.faktur = '$faktur'";
            $j = "left join stock s on s.kode = d.stock left join stock_group g on g.kode = s.stock_group";
            $dbd2      = $this->select("pembelian_detail d", $f, $w, $j, "") ;
            $jmlperd = 0 ;
            while($dbr2 = $this->getrow($dbd2)){
                if(!isset($vapersd[$dbr2['stock_group']]))$vapersd[$dbr2['stock_group']] = array("jml"=>0,"rekpersd"=>$dbr2['rekpersd'],"keterangan"=>$dbr2['keterangan']);
                $vapersd[$dbr2['stock_group']]['jml'] += $dbr2['hp'] * $dbr2['qty'];
                $jmlperd += $dbr2['hp'] * $dbr2['qty'];
            }

            foreach($vapersd as $key => $val){
                $ket= "Persd. Pembelian ".$val['keterangan'];
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$val['rekpersd'],$ket,$val['jml'],0,$dbr['datetime'],$dbr['username']);
            }

            $ket= "Pembulatan Pembelian ".$dbr['nama'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekselisih"),$ket,$dbr['pembulatan'],0,$dbr['datetime'],$dbr['username']);

            $ket= "Hutang Pembelian ".$dbr['nama'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekpbhut"),$ket,0,$dbr['hutang'],$dbr['datetime'],$dbr['username']);

            $ket= "Disc. Pembelian ".$dbr['nama'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekpbdisc"),$ket,0,$dbr['diskon'],$dbr['datetime'],$dbr['username']);



            //$ket= "PPn Pembelian ".$dbr['nama'];
            //$this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekpbppn"),$ket,$dbr['ppn'],0,$dbr['datetime'],$dbr['username']);

            $selisih = ($jmlperd) - ($dbr['hutang'] + $dbr['diskon'] - $dbr['pembulatan']);
            $ket= "Selisih Pembelian ".$dbr['nama'];
            if($selisih < 0){
                $selisih = $selisih * -1;
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekselisih"),$ket,$selisih,0,$dbr['datetime'],$dbr['username']);
            }else if($selisih > 0){
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekselisih"),$ket,0,$selisih,$dbr['datetime'],$dbr['username']);
            }
        }
    }

    public function updkartuhutangpembelian($faktur){
        $rekkas = getsession($this, "rekkas") ;
        $this->delete("hutang_kartu", "faktur = '$faktur'" ) ;
        $field = "t.faktur,t.tgl,t.cabang,s.nama as namasupplier,t.supplier,t.subtotal,t.diskon,t.ppn,t.total,t.hutang,t.kas,
                    t.username,t.datetime_insert datetime";
        $where = "t.faktur = '$faktur'";
        $join = "left join supplier s on s.kode = t.supplier";
        $dbd      = $this->select("pembelian_total t", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $keterangan = "Hut Pembelian [".$faktur."] an ".$dbr['namasupplier'];
            $this->updkartuhutang($faktur,$faktur,$dbr['supplier'],$dbr['tgl'],$dbr['cabang'],$keterangan,
                                  $dbr['hutang'],0,$dbr['username'],$dbr['datetime']);
        }
    }

    public function updkartuhutangreturpembelian($faktur){
        $rekkas = getsession($this, "rekkas") ;
        $this->delete("hutang_kartu", "faktur = '$faktur'" ) ;
        $field = "t.faktur,t.tgl,t.cabang,s.nama as namasupplier,t.supplier,t.subtotal,t.total,
                    t.username,t.datetime";
        $where = "t.faktur = '$faktur'";
        $join = "left join supplier s on s.kode = t.supplier";
        $dbd      = $this->select("pembelian_retur_total t", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $keterangan = "Retur Pembelian [".$faktur."] an ".$dbr['namasupplier'];
            $this->updkartuhutang($faktur,$faktur,$dbr['supplier'],$dbr['tgl'],$dbr['cabang'],$keterangan,
                                  0,$dbr['total'],$dbr['username'],$dbr['datetime']);
        }
    }

    public function updrekreturpembelian($faktur){
        $rekkas = getsession($this, "rekkas") ;
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;
        $field = "t.faktur,t.tgl,t.cabang,s.nama,t.subtotal,t.total,t.username,t.datetime";
        $where = "t.faktur = '$faktur'";
        $join = "left join supplier s on s.kode = t.supplier";
        $dbd      = $this->select("pembelian_retur_total t", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $vapersd = array();
            $f = "d.stock,d.harga,d.qty,d.jumlah,d.totalitem,g.keterangan,g.rekpersd,s.stock_group,d.hp";
            $w = "d.faktur = '$faktur'";
            $j = "left join stock s on s.kode = d.stock left join stock_group g on g.kode = s.stock_group";
            $dbd2      = $this->select("pembelian_retur_detail d", $f, $w, $j, "") ;
            $persd = 0 ;
            while($dbr2 = $this->getrow($dbd2)){
                if(!isset($vapersd[$dbr2['stock_group']]))$vapersd[$dbr2['stock_group']] = array("jml"=>0,"rekpersd"=>$dbr2['rekpersd'],"keterangan"=>$dbr2['keterangan']);
                $vapersd[$dbr2['stock_group']]['jml'] += $dbr2['qty'] * $dbr2['hp'];
                $persd += $dbr2['qty'] * $dbr2['hp'];
            }

            foreach($vapersd as $key => $val){
                $ket= "Persd. Retur Pembelian ".$val['keterangan'];
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$val['rekpersd'],$ket,0,$val['jml'],$dbr['datetime'],$dbr['username']);
            }

            $ket= "Retur Pembelian ".$dbr['nama'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekpbhut"),$ket,$dbr['total'],0,$dbr['datetime'],$dbr['username']);

            $selisih = $dbr['total'] - $persd;
            $ket= "Selisih Retur Pembelian ".$dbr['nama'];
            if($selisih < 0){
                $selisih = $selisih * -1;
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekselisih"),$ket,$selisih,0,$dbr['datetime'],$dbr['username']);
            }else if($selisih > 0){
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekselisih"),$ket,0,$selisih,$dbr['datetime'],$dbr['username']);
            }

        }
    }

    public function updrekhutangpelunasan($faktur){
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;
        $field = "t.faktur,t.tgl,t.cabang,t.username,t.datetime,s.nama as namasupplier,b.rekening,b.keterangan as ketrekkasbank,
                t.kasbank,t.subtotal,t.diskon,t.pembulatan,t.persekot,t.kdtrpersekot,k.keterangan as ketpersekot,
                k.rekening as rekkdtrpersekot,k.dk as dktrpersekot";
        $where = "t.faktur = '$faktur'";
        $join = "left join supplier s on s.kode = t.supplier left join bank b on b.kode = t.rekkasbank left join kodetransaksi k on k.kode = t.kdtrpersekot";
        $dbd      = $this->select("hutang_pelunasan_total t", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $ket = "Pelunasan Hutang an ".$dbr['namasupplier'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekpbhut"),$ket,$dbr['subtotal'],0,$dbr['datetime'],$dbr['username']);
            $ket = "Pembulatan Pelunasan Hutang an ".$dbr['namasupplier'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekpbhutpembulatan"),$ket,$dbr['pembulatan'],0,$dbr['datetime'],$dbr['username']);
            $ket = "Pelunasan Hutang an ".$dbr['namasupplier']." - ".$dbr['ketrekkasbank'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr['rekening'],$ket,0,$dbr['kasbank'],$dbr['datetime'],$dbr['username']);
            $ket = "Diskon Pelunasan Hutang an ".$dbr['namasupplier'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekpbhutdisc"),$ket,0,$dbr['diskon'],$dbr['datetime'],$dbr['username']);
            if($dbr['persekot'] > 0){
                $ket = $dbr['ketpersekot']." an ".$dbr['namasupplier'];
                $dpskt = 0;
                $kpskt = 0;
                if($dbr['dktrpersekot'] == "K"){
                    $kpskt = $dbr['persekot'];
                }else if($dbr['dktrpersekot'] == "D"){
                    $dpskt = $dbr['persekot'];
                }
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr['rekkdtrpersekot'],$ket,$dpskt,$kpskt,$dbr['datetime'],$dbr['username']);
            }

        }
    }

    public function updkartuhutangpelunasan($faktur){
        $this->delete("hutang_kartu", "faktur = '$faktur'" ) ;
        $field = "d.faktur,d.fkt,d.jumlah,d.jenis,t.tgl,t.cabang,t.username,t.datetime,s.nama as namasupplier,t.supplier";
        $where = "d.faktur = '$faktur'";
        $join = "left join hutang_pelunasan_total t on t.faktur = d.faktur left join supplier s on s.kode = t.supplier";
        $dbd      = $this->select("hutang_pelunasan_detail d", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $keterangan = "Pelunasan Hutang [".$faktur."] an ".$dbr['namasupplier'];
            $debet = 0 ;
            $kredit = $dbr['jumlah'];
            if($dbr['jenis'] == 'Retur Pembelian'){
                $debet = $dbr['jumlah'] ;
                $kredit = 0;
            }
            $this->updkartuhutang($faktur,$dbr['fkt'],$dbr['supplier'],$dbr['tgl'],$dbr['cabang'],$keterangan,
                                  $debet,$kredit,$dbr['username'],$dbr['datetime'],"H");
        }

        // update kartu persekot
        $field = "t.faktur,t.tgl,t.cabang,t.username,t.datetime,s.nama as namasupplier,b.rekening,b.keterangan as ketrekkasbank,
                t.kasbank,t.subtotal,t.diskon,t.pembulatan,t.persekot,t.kdtrpersekot,k.keterangan as ketpersekot,
                k.rekening as rekkdtrpersekot,k.dk as dktrpersekot,t.supplier";
        $where = "t.faktur = '$faktur'";
        $join = "left join supplier s on s.kode = t.supplier left join bank b on b.kode = t.rekkasbank left join kodetransaksi k on k.kode = t.kdtrpersekot";
        $dbd      = $this->select("hutang_pelunasan_total t", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $keterangan = $dbr['ketpersekot'];
            $debet = 0;
            $kredit = 0 ;
            if($dbr['dktrpersekot'] == "K"){
                $debet = $dbr['persekot'] ;

            }else if($dbr['dktrpersekot'] == "D"){
                $kredit = $dbr['persekot'] ;
            }
            $this->updkartuhutang($faktur,$faktur,$dbr['supplier'],$dbr['tgl'],$dbr['cabang'],$keterangan,
                                  $debet,$kredit,$dbr['username'],$dbr['datetime'],"P");
        }
    }


    /***************************************************/

    /********************penjualan*******************************/
    public function updkartustockpenjualan($faktur){
        $field = "d.id,d.faktur,d.stock,d.harga,d.qty,d.totalitem,d.username,t.tgl,t.gudang,t.cabang,t.datetime_insert";
        $where = "d.faktur = '$faktur'";
        $join = "left join penjualan_total t on t.faktur = d.faktur";
        $keterangan = "Penjualan kasir fkt[".$faktur."]";
        $dbd      = $this->select("penjualan_detail d", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $hp = 0;
            $cfghpp = $this->perhitungan_m->getcfghpp($dbr['tgl']);
            $saldoqty = $this->perhitungan_m->GetSaldoAkhirStock($dbr['stock'],$dbr['tgl'],"",$dbr['cabang']) ;
            $arrhp = $this->perhitungan_m->gethpstock($dbr['stock'],$dbr['tgl'],$dbr['tgl'],$saldoqty,$dbr['qty'],$dbr['cabang'],
                                                      $cfghpp['caraperhitungan'],$cfghpp['periode']);
            $hp = devide($arrhp['hpdikeluarkan'],$dbr['qty']);
            $this->edit("penjualan_detail",array("hp"=>$hp),"id = {$dbr['id']}");
            $this->updkartustock($faktur,$dbr['stock'],$dbr['tgl'],$dbr['gudang'],$dbr['cabang'],
                                 $keterangan,0,$dbr['qty'],$hp,$dbr['username'],$dbr['datetime_insert']);
        }
    }

    public function updrekpenjualan($faktur){
        $rekkas = getsession($this, "rekkas") ;
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;
        $field = "t.faktur,t.tgl,t.cabang,s.nama,t.subtotal,t.total,t.kas,t.piutang,
                  t.username,t.datetime_update datetime,g.rekpj,t.ppn,t.diskon";
        $where = "t.faktur = '$faktur'";
        $join = "left join customer s on s.kode = t.customer left join customer_golongan g on g.kode = s.golongan";
        $dbd      = $this->select("penjualan_total t", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $vapersd = array();
            $ket= "Kas Penjualan ".$dbr['nama'];
            $byrkas = min($dbr['kas'],$dbr['total']);
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$rekkas,$ket,$byrkas,0,$dbr['datetime'],$dbr['username']);
            $ket = "diskon penjualan";
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekpjpiutangdisc"),$ket,$dbr['diskon'],0,$dbr['datetime'],$dbr['username']);
            $ket= "Pitang Penjualan ".$dbr['nama'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekpjpiutang"),$ket,$dbr['piutang'],0,$dbr['datetime'],$dbr['username']);
            $ket= "Penjualan ".$dbr['nama'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr['rekpj'],$ket,0,$dbr['subtotal'],$dbr['datetime'],$dbr['username']);
            $ket= "PPN Penjualan ".$dbr['nama'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekpjppn"),$ket,0,$dbr['ppn'],$dbr['datetime'],$dbr['username']);

            //hitung hpp
            $vapersd = array();
            $f = "d.stock,d.harga,d.qty,d.jumlah,d.totalitem,g.keterangan,g.rekpersd,s.stock_group,g.rekhpp,g.rekpj,d.hp";
            $w = "d.faktur = '$faktur'";
            $j = "left join stock s on s.kode = d.stock left join stock_group g on g.kode = s.stock_group";
            $dbd2      = $this->select("penjualan_detail d", $f, $w, $j, "") ;
            while($dbr2 = $this->getrow($dbd2)){
                if(!isset($vapersd[$dbr2['stock_group']]))$vapersd[$dbr2['stock_group']] = array("jml"=>0,"hpp"=>0,"rekpersd"=>$dbr2['rekpersd'],"rekhpp"=>$dbr2['rekhpp'],"rekpj"=>$dbr2['rekpj'],"keterangan"=>$dbr2['keterangan']);
                $vapersd[$dbr2['stock_group']]['jml'] += $dbr2['totalitem'];
                $vapersd[$dbr2['stock_group']]['hpp'] += $dbr2['hp'] * $dbr2['qty'];
            }

            foreach($vapersd as $key => $val){
                $ket= "HPP ".$val['keterangan'];
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$val['rekhpp'],$ket,$val['hpp'],0,$dbr['datetime'],$dbr['username']);
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$val['rekpersd'],$ket,0,$val['hpp'],$dbr['datetime'],$dbr['username']);
            }

        }
    }

    public function updkartupiutangpenjualan($faktur){
        $rekkas = getsession($this, "rekkas") ;
        $this->delete("piutang_kartu", "faktur = '$faktur'" ) ;
        $field = "t.faktur,t.tgl,t.cabang,s.nama as namacustomer,t.customer,t.subtotal,t.diskon,t.ppn,t.total,t.piutang,t.kas,
                    t.username,t.datetime_update datetime";
        $where = "t.faktur = '$faktur'";
        $join = "left join customer s on s.kode = t.customer";
        $dbd      = $this->select("penjualan_total t", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $keterangan = "Piutang Penjualan [".$faktur."] an ".$dbr['namacustomer'];
            $this->updkartupiutang($faktur,$faktur,$dbr['customer'],$dbr['tgl'],$dbr['cabang'],$keterangan,
                                   $dbr['piutang'],0,$dbr['username'],$dbr['datetime']);
        }
    }

    public function updkartupiutangreturpenjualan($faktur){
        $this->delete("piutang_kartu", "faktur = '$faktur'" ) ;
        $field = "t.faktur,t.tgl,t.cabang,s.nama as namacustomer,t.customer,t.subtotal,t.total,
                    t.username,t.datetime";
        $where = "t.faktur = '$faktur'";
        $join = "left join customer s on s.kode = t.customer";
        $dbd      = $this->select("penjualan_retur_total t", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $keterangan = "Retur Penjualan [".$faktur."] an ".$dbr['namacustomer'];
            $this->updkartupiutang($faktur,$faktur,$dbr['customer'],$dbr['tgl'],$dbr['cabang'],$keterangan,
                                   0,$dbr['total'],$dbr['username'],$dbr['datetime']);
        }
    }

    public function updkartustockreturpenjualan($faktur){
        $this->delete("stock_kartu", "faktur = '$faktur'" ) ;
        $field      = "d.faktur,d.stock,d.harga,d.qty,d.jumlah,t.username,t.tgl,t.gudang,t.cabang,s.nama,t.datetime";
        $where      = "d.faktur = '$faktur'";
        $join       = "left join penjualan_retur_total t on t.faktur = d.faktur left join customer s on s.kode = t.customer";

        $dbd        = $this->select("penjualan_retur_detail d", $field, $where, $join, "") ;
        while($dbr  = $this->getrow($dbd)){
            $hp = 0;
            $keterangan = "retur penjualan stock ".$dbr['nama'];
            if($dbr['jumlah'] > 0 and $dbr['qty'] > 0) $hp = $dbr['jumlah'] / $dbr['qty'];
            $this->updkartustock($faktur,$dbr['stock'],$dbr['tgl'],$dbr['gudang'],$dbr['cabang'],$keterangan,$dbr['qty'],0,
                                 $hp,$dbr['username'],$dbr['datetime']);

            $cfghpp = $this->perhitungan_m->getcfghpp($dbr['tgl']);
            $saldoqty = $this->perhitungan_m->GetSaldoAkhirStock($dbr['stock'],$dbr['tgl'],"",$dbr['cabang']) ;
            $arrhp = $this->perhitungan_m->gethpstock($dbr['stock'],$dbr['tgl'],$dbr['tgl'],$saldoqty,0,$dbr['cabang'],
                                                      $cfghpp['caraperhitungan'],$cfghpp['periode']);
        }
    }

    public function updrekreturpenjualan($faktur){
        $rekkas = getsession($this, "rekkas") ;
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;
        $field = "t.faktur,t.tgl,t.cabang,s.nama,t.subtotal,t.total,t.username,t.datetime,g.rekrj";
        $where = "t.faktur = '$faktur'";
        $join = "left join customer s on s.kode = t.customer left join customer_golongan g on g.kode = s.golongan";
        $dbd      = $this->select("penjualan_retur_total t", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $vapersd = array();

            $ket= "Retur Penjualan ".$dbr['nama'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr['rekrj'],$ket,$dbr['total'],0,$dbr['datetime'],$dbr['username']);


            $ket= "Piutang Retur Penjualan ".$dbr['nama'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekpjpiutang"),$ket,0,$dbr['total'],$dbr['datetime'],$dbr['username']);


        }
    }

    public function updkartupiutangpelunasan($faktur){
        $this->delete("piutang_kartu", "faktur = '$faktur'" ) ;
        $field = "d.faktur,d.fkt,d.jumlah,d.jenis,t.tgl,t.cabang,t.username,t.datetime,s.nama as namacustomer,
                  t.customer";
        $where = "d.faktur = '$faktur'";
        $join = "left join piutang_pelunasan_total t on t.faktur = d.faktur left join customer s on s.kode = t.customer";
        $dbd      = $this->select("piutang_pelunasan_detail d", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $keterangan = "Pelunasan Piutang [".$faktur."] an ".$dbr['namacustomer'];
            $debet = 0 ;
            $kredit = $dbr['jumlah'];
            if($dbr['jenis'] == 'Retur Penjualan'){
                $debet = $dbr['jumlah'] ;
                $kredit = 0;
            }
            $this->updkartupiutang($faktur,$dbr['fkt'],$dbr['customer'],$dbr['tgl'],$dbr['cabang'],$keterangan,
                                   $debet,$kredit,$dbr['username'],$dbr['datetime'],"P");
        }


        //ups karytu uang muka
        $field = "t.faktur,t.tgl,t.cabang,t.username,t.datetime,s.nama as namacustomer,b.rekening,b.keterangan as ketrekkasbank,
                t.kasbank,t.subtotal,t.diskon,t.pembulatan,t.uangmuka,t.kdtruangmuka,k.keterangan as ketuangmuka,t.customer,
                k.rekening as rekkdtruangmuka,k.dk as dktruangmuka";
        $where = "t.faktur = '$faktur'";
        $join = "left join customer s on s.kode = t.customer left join bank b on b.kode = t.rekkasbank  left join kodetransaksi k on k.kode = t.kdtruangmuka";
        $dbd      = $this->select("piutang_pelunasan_total t", $field, $where, $join, "") ;

        while($dbr = $this->getrow($dbd)){
            $keterangan = $dbr['ketuangmuka'];
            $debet = 0;
            $kredit = 0 ;
            if($dbr['dktruangmuka'] == "K"){
                $kredit = $dbr['uangmuka'] ;

            }else if($dbr['dktruangmuka'] == "D"){
                $debet = $dbr['uangmuka'] ;
            }
            $this->updkartupiutang($faktur,$faktur,$dbr['customer'],$dbr['tgl'],$dbr['cabang'],$keterangan,
                                   $debet,$kredit,$dbr['username'],$dbr['datetime'],"U");
        }
    }

    public function updrekpiutangpelunasan($faktur){
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;
        $field = "t.faktur,t.tgl,t.cabang,t.username,t.datetime,s.nama as namacustomer,b.rekening,b.keterangan as ketrekkasbank,
                t.kasbank,t.subtotal,t.diskon,t.pembulatan,t.uangmuka,t.kdtruangmuka,k.keterangan as ketuangmuka,
                k.rekening as rekkdtruangmuka,k.dk as dktruangmuka";
        $where = "t.faktur = '$faktur'";
        $join = "left join customer s on s.kode = t.customer left join bank b on b.kode = t.rekkasbank  left join kodetransaksi k on k.kode = t.kdtruangmuka";
        $dbd      = $this->select("piutang_pelunasan_total t", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $ket = "Pelunasan Piutang an ".$dbr['namacustomer']." - ".$dbr['ketrekkasbank'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr['rekening'],$ket,$dbr['kasbank'],0,$dbr['datetime'],$dbr['username']);
            $ket = "Pemnbulatan Pelunasan Piutang an ".$dbr['namacustomer']." - ".$dbr['ketrekkasbank'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekpjpiutangpembulatan"),$ket,$dbr['pembulatan'],0,$dbr['username']);
            $ket = "Pelunasan Piutang an ".$dbr['namacustomer'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekpjpiutang"),$ket,0,$dbr['subtotal'],$dbr['datetime'],$dbr['username']);
            $ket = "Diskon Pelunasan Piutang an ".$dbr['namacustomer'];
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekpjpiutangdisc"),$ket,0,$dbr['diskon'],$dbr['datetime'],$dbr['username']);
            if($dbr['uangmuka'] > 0){
                $ket = $dbr['ketuangmuka']." an ".$dbr['namacustomer'];
                $dum = 0;
                $kum = 0;
                if($dbr['dktruangmuka'] == "K"){
                    $kum = $dbr['uangmuka'];
                }else if($dbr['dktruangmuka'] == "D"){
                    $dum = $dbr['uangmuka'];
                }
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr['rekkdtruangmuka'],$ket,$dum,$kum,$dbr['datetime'],$dbr['username']);
            }

        }
    }
    /***************************************************/
    /**********Proses Produksi*****************************************/
    public function updkartustockperintahproduksi($faktur){
        $this->delete("stock_kartu", "faktur = '$faktur'" ) ;
        $field      = "b.id,b.faktur,b.tgl,b.cabang,b.username,b.datetime,b.bb,b.btkl,b.bop";
        $where      = "b.faktur = '$faktur' and b.status = '1' and b.perbaikan = 'Y'";
        $join       = "";
        $dbd        = $this->select("produksi_total b", $field, $where, $join, "") ;
        while($dbr  = $this->getrow($dbd)){

            $keterangan = "Pengambilan produk proses perbaikan produksi [".$dbr['faktur']."]";
            $cfghpp = $this->perhitungan_m->getcfghpp($dbr['tgl']);

            //select produk yg diperbaiki
            $where2 = "p.fakturproduksi = '{$dbr['faktur']}'";
            $field2 = "p.stock,p.qty,p.gudangperbaikan as gudang";
            $dbd2        = $this->select("produksi_produk p", $field2, $where2, "") ;
            while($dbr2  = $this->getrow($dbd2)){
                $saldoqty = $this->perhitungan_m->GetSaldoAkhirStock($dbr2['stock'],$dbr['tgl'],"",$dbr['cabang']) ;
                $arrhp = $this->perhitungan_m->gethpstock($dbr2['stock'],$dbr['tgl'],$dbr['tgl'],$saldoqty,$dbr2['qty'],$dbr['cabang'],
                                                          $cfghpp['caraperhitungan'],$cfghpp['periode']);
                $hp =  devide($arrhp['hpdikeluarkan'],$dbr2['qty']);
                //edit nilai hp
                $this->edit("produksi_produk",array("hargapokokperbaikan"=>$hp,"jumlahperbaikan"=>$arrhp['hpdikeluarkan']),"fakturproduksi = '{$dbr['faktur']}' and stock = '{$dbr2['stock']}'");
                $this->updkartustock($faktur,$dbr2['stock'],$dbr['tgl'],$dbr2['gudang'],$dbr['cabang'],$keterangan,0,$dbr2['qty'],
                                     $hp,$dbr['username'],$dbr['datetime']);

            }
        }
    }
    public function updrekperintahproduksi($faktur){
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;
        $field      = "b.id,b.faktur,b.tgl,b.cabang,b.username,b.datetime,b.bb,b.btkl,b.bop";
        $where      = "b.faktur = '$faktur' and b.status = '1'";
        $join       = "";
        $dbd        = $this->select("produksi_total b", $field, $where, $join, "") ;
        while($dbr  = $this->getrow($dbd)){
            $ket = "Perintah Produksi BDP BTKL";
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekprbdpbtkl"),$ket,$dbr['btkl'],0,$dbr['datetime'],$dbr['username']);
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekprbtkldibebankan"),$ket,0,$dbr['btkl'],$dbr['datetime'],$dbr['username']);

            $ket = "Perintah Produksi BDP BOP";
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekprbdpbop"),$ket,$dbr['bop'],0,$dbr['datetime'],$dbr['username']);
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekprbopdibebankan"),$ket,0,$dbr['bop'],$dbr['datetime'],$dbr['username']);

            $where2 = "p.fakturproduksi = '{$dbr['faktur']}'";
            $field2 = "p.stock,p.qty,p.gudangperbaikan as gudang,p.jumlahperbaikan,g.rekpersd";
            $join2 = "left join stock s on s.kode = p.stock left join stock_group g on g.kode = s.stock_group";
            $dbd2        = $this->select("produksi_produk p", $field2, $where2, $join2) ;
            while($dbr2  = $this->getrow($dbd2)){
                $ket = "Perbaikan Produk BDP BBB";
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekprbdpbbb"),$ket,$dbr2['jumlahperbaikan'],0,$dbr['datetime'],$dbr['username']);
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr2['rekpersd'],$ket,0,$dbr2['jumlahperbaikan'],$dbr['datetime'],$dbr['username']);
            }
        }
    }
    public function updkartustockprosesproduksi($faktur){
        $this->delete("stock_kartu", "faktur = '$faktur'" ) ;

        $field      = "b.id,b.faktur,b.fakturproduksi,b.tgl,b.cabang,b.gudang,b.stock,b.qty,b.username,b.datetime";
        $where      = "b.faktur = '$faktur' and b.status = '1'";
        $join       = "";
        $dbd        = $this->select("produksi_bb b", $field, $where, $join, "") ;
        while($dbr  = $this->getrow($dbd)){
            $hp = 0;
            $keterangan = "Pengambilan unutk proses produksi [".$dbr['fakturproduksi']."]";
            $cfghpp = $this->perhitungan_m->getcfghpp($dbr['tgl']);
            $saldoqty = $this->perhitungan_m->GetSaldoAkhirStock($dbr['stock'],$dbr['tgl'],"",$dbr['cabang']) ;
            $arrhp = $this->perhitungan_m->gethpstock($dbr['stock'],$dbr['tgl'],$dbr['tgl'],$saldoqty,$dbr['qty'],$dbr['cabang'],
                                                      $cfghpp['caraperhitungan'],$cfghpp['periode']);
            $hp = devide($arrhp['hpdikeluarkan'],$dbr['qty']);
            //edit nilai hp
            $this->edit("produksi_bb",array("hp"=>$hp,"hptotkeluar"=>$arrhp['hpdikeluarkan']),"id = '{$dbr['id']}'");
            $this->updkartustock($faktur,$dbr['stock'],$dbr['tgl'],$dbr['gudang'],$dbr['cabang'],$keterangan,0,$dbr['qty'],
                                 $hp,$dbr['username'],$dbr['datetime']);


        }
    }
    public function updrekprosesproduksi($faktur){
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;
        $field      = "b.faktur,b.fakturproduksi,b.tgl,b.cabang,b.gudang,b.stock,b.qty,b.username,b.datetime,g.rekpersd,b.hp,b.hptotkeluar";
        $where      = "b.faktur = '$faktur' and b.status = '1'";
        $join       = "left join stock s on s.kode = b.stock left join stock_group g on g.kode = s.stock_group";
        $dbd        = $this->select("produksi_bb b", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $jumlahproduksi = $dbr['hptotkeluar'];
            //$persdbrgproduksi = $dbr['hptotkeluar'];
            $ket = "Pengambilan unutk proses produksi [".$dbr['fakturproduksi']."]";
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekprbdpbbb"),$ket,$jumlahproduksi,0,$dbr['datetime'],$dbr['username']);
            $ket = "Pengambilan unutk proses produksi [".$dbr['fakturproduksi']."]";
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr['rekpersd'],$ket,0,$jumlahproduksi,$dbr['datetime'],$dbr['username']);
            //$selisih = ($persdbrgproduksi) - ($jumlahproduksi);
            // $ket= "Selisih proses produksi  [".$dbr['fakturproduksi']."]";
            /*if($selisih > 0){
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekselisih"),$ket,$selisih,0,$dbr['datetime'],$dbr['username']);
            }else if($selisih < 0){
				$selisih = $selisih * -1;
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekselisih"),$ket,0,$selisih,$dbr['datetime'],$dbr['username']);
            }
			*/
        }
    }
    /***************************************************/
    /**********Hasil Produksi*****************************************/
    public function updkartustockhasilproduksi($faktur){
        $this->delete("stock_kartu", "faktur = '$faktur'" ) ;
        $field      = "b.faktur,b.fakturproduksi,b.tgl,b.cabang,b.gudang,b.stock,b.qty,
                        b.username,b.datetime,t.btkl,t.bop,sum(h.hp * h.qty) as bb, sum(h.hptotkeluar) as bb2";
        $where      = "b.faktur = '$faktur' and b.status = '1'";
        $join       = "left join produksi_total t on t.faktur = b.fakturproduksi "; 
        $join       .= "left join produksi_bb h on h.fakturproduksi = t.faktur and h.status = '1'";
        $dbd        = $this->select("produksi_hasil b", $field, $where, $join, "") ;
        while($dbr  = $this->getrow($dbd)){

            $perbaikan = 0;
            $where2 = "p.fakturproduksi = '{$dbr['fakturproduksi']}'";
            $field2 = "p.stock,p.qty,p.gudangperbaikan as gudang,p.jumlahperbaikan,g.rekpersd";
            $join2 = "left join stock s on s.kode = p.stock left join stock_group g on g.kode = s.stock_group";
            $dbd2        = $this->select("produksi_produk p", $field2, $where2, $join2) ;
            while($dbr2  = $this->getrow($dbd2)){
                $perbaikan += $dbr2['jumlahperbaikan'];
            }

            $tothp = $perbaikan + $dbr['btkl'] + $dbr['bop'] + $dbr['bb2'];
            $hp = devide($tothp,$dbr['qty']);
            $keterangan = "Hasil produksi [".$dbr['fakturproduksi']."]";
            $this->edit("produksi_hasil",array("hp"=>$hp),"faktur = " . $this->escape($faktur));
            $this->updkartustock($faktur,$dbr['stock'],$dbr['tgl'],$dbr['gudang'],$dbr['cabang'],$keterangan,$dbr['qty'],0,
                                 $hp,$dbr['username'],$dbr['datetime']);
            $cfghpp = $this->perhitungan_m->getcfghpp($dbr['tgl']);
            $saldoqty = $this->perhitungan_m->GetSaldoAkhirStock($dbr['stock'],$dbr['tgl'],"",$dbr['cabang']) ;
            $arrhp = $this->perhitungan_m->gethpstock($dbr['stock'],$dbr['tgl'],$dbr['tgl'],$saldoqty,0,$dbr['cabang'],
                                                      $cfghpp['caraperhitungan'],$cfghpp['periode']);

        }
    }
    public function updrekhasilproduksi($faktur){
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;
        $field      = "b.faktur,b.fakturproduksi,b.tgl,b.cabang,b.gudang,b.stock,b.qty,b.username,
                        b.datetime,g.rekpersd,b.hp,t.btkl,t.bop,sum(h.hp * h.qty) as bb, sum(h.hptotkeluar) as bb2";
        $where      = "b.faktur = '$faktur' and b.status = '1'";
        $join       = "left join stock s on s.kode = b.stock left join stock_group g on g.kode = s.stock_group ";
        $join       .=  "left join produksi_total t on t.faktur = b.fakturproduksi ";
        $join       .=  "left join produksi_bb h on h.fakturproduksi = t.faktur and h.status = '1' ";
        $dbd        = $this->select("produksi_hasil b", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $cfghpp = $this->perhitungan_m->getcfghpp($dbr['tgl']);
            
            $perbaikan = 0;
            $where2 = "p.fakturproduksi = '{$dbr['fakturproduksi']}'";
            $field2 = "p.stock,p.qty,p.gudangperbaikan as gudang,p.jumlahperbaikan,g.rekpersd";
            $join2 = "left join stock s on s.kode = p.stock left join stock_group g on g.kode = s.stock_group";
            $dbd2        = $this->select("produksi_produk p", $field2, $where2, $join2) ;
            while($dbr2  = $this->getrow($dbd2)){
                $perbaikan += $dbr2['jumlahperbaikan'];
            }

            $jumlahproduksi = $dbr['btkl'] + $dbr['bop'] + $dbr['bb2'] + $perbaikan;
            $persdbrgproduksi = $dbr['qty'] * $dbr['hp'];
            $ket = "Hasil produksi [".$dbr['fakturproduksi']."]";
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr['rekpersd'],$ket,$persdbrgproduksi,0,$dbr['datetime'],$dbr['username']);
            $ket = "Perbaikan produksi [".$dbr['fakturproduksi']."]";
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekprbdpbbb"),$ket,0,$perbaikan,$dbr['datetime'],$dbr['username']);
            $ket = "BBB Hasil produksi [".$dbr['fakturproduksi']."]";
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekprbdpbbb"),$ket,0,$dbr['bb2'],$dbr['datetime'],$dbr['username']);
            $ket = "BTKL Hasil produksi [".$dbr['fakturproduksi']."]";
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekprbdpbtkl"),$ket,0,$dbr['btkl'],$dbr['datetime'],$dbr['username']);
            $ket = "BOP Hasil produksi [".$dbr['fakturproduksi']."]";
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekprbdpbop"),$ket,0,$dbr['bop'],$dbr['datetime'],$dbr['username']);

            $selisih = ($persdbrgproduksi) - ($jumlahproduksi);
            $ket= "Selisih hasil produksi  [".$dbr['fakturproduksi']."]";
            if($selisih < 0){
                $selisih = $selisih * -1;
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekselisih"),$ket,$selisih,0,$dbr['datetime'],$dbr['username']);
            }else if($selisih > 0){
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$this->getconfig("rekselisih"),$ket,0,$selisih,$dbr['datetime'],$dbr['username']);
            }
        }
    }
    /***************************************************/
    /************Mutasi kas***************************************/
    public function updrekmutasikas($faktur){
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;
        $field      = "t.faktur,t.tgl,t.diberiterima,r.keterangan as ketrekening,t.rekening,t.keterangan,t.debet,t.kredit,
                        t.cabang,t.datetime,t.username";
        $where      = "t.faktur = '$faktur' and t.status = '1'";
        $join       = "left join keuangan_rekening r on r.kode = t.rekening";
        $dbd        = $this->select("kas_mutasi_total t", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr['rekening'],$dbr['keterangan'],
                                $dbr['debet'],$dbr['kredit'],$dbr['datetime'],$dbr['username']);

            //jurnal lawan ambil dari detail
            $f      = "d.faktur,d.rekening,d.keterangan,d.debet,d.kredit";
            $w     = "d.faktur = '$faktur'";
            $j      = "";
            $dbd2        = $this->select("kas_mutasi_detail d", $f, $w, $j, "") ;
            while($dbr2 = $this->getrow($dbd2)){
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr2['rekening'],$dbr2['keterangan'],
                                    $dbr2['debet'],$dbr2['kredit'],$dbr['datetime'],$dbr['username']);
            }
        }
    }
    /***************************************************/
    /************Mutasi bank***************************************/
    public function updrekmutasibank($faktur){
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;
        $field      = "t.faktur,t.tgl,t.diberiterima,r.keterangan as ketrekening,b.rekening,t.keterangan,t.debet,t.kredit,
                        t.cabang,t.datetime,t.username";
        $where      = "t.faktur = '$faktur' and t.status = '1'";
        $join       = "left join bank b on b.kode = t.bank left join keuangan_rekening r on r.kode = b.rekening";
        $dbd        = $this->select("bank_mutasi_total t", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr['rekening'],$dbr['keterangan'],
                                $dbr['debet'],$dbr['kredit'],$dbr['datetime'],$dbr['username']);

            //jurnal lawan ambil dari detail
            $f      = "d.faktur,d.rekening,d.keterangan,d.debet,d.kredit";
            $w     = "d.faktur = '$faktur'";
            $j      = "";
            $dbd2        = $this->select("bank_mutasi_detail d", $f, $w, $j, "") ;
            while($dbr2 = $this->getrow($dbd2)){
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr2['rekening'],$dbr2['keterangan'],
                                    $dbr2['debet'],$dbr2['kredit'],$dbr['datetime'],$dbr['username']);
            }
        }
    }
    /***************************************************/
    /************Mutasi BG***************************************/
    public function updrekmutasibg($faktur){
        //  echo("alert('dfkg');");
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;
        $field      = "t.faktur,t.tgl,t.diberiterima,r.keterangan as ketrekening,t.rekening,t.keterangan,t.debet,t.kredit,
                        t.cabang,t.datetime,t.username";
        $where      = "t.faktur = '$faktur' and t.status = '1'";
        $join       = "left join keuangan_rekening r on r.kode = t.rekening";
        $dbd        = $this->select("bg_mutasi_total t", $field, $where, $join, "") ;
        while($dbr = $this->getrow($dbd)){
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr['rekening'],$dbr['keterangan'],
                                $dbr['debet'],$dbr['kredit'],$dbr['datetime'],$dbr['username']);

            //jurnal lawan ambil dari detail
            $f      = "d.faktur,b.rekening,d.nobgcek,d.norekening,d.bgcek,d.debet,d.kredit";
            $w     = "d.faktur = '$faktur'";
            $j      = "left join bank b on b.kode = d.bank";
            $dbd2        = $this->select("bg_mutasi_detail d", $f, $w, $j, "") ;
            while($dbr2 = $this->getrow($dbd2)){
                $keterangan = "BG / Cek ".$dbr2['bgcek']." ".$dbr2['nobgcek'];
                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr2['rekening'],$keterangan,
                                    $dbr2['debet'],$dbr2['kredit'],$dbr['datetime'],$dbr['username']);
            }
        }
    }
    /***************************************************/
    /************Mutasi Persekot***************************************/
    public function updkartuhutangpersekot($faktur){
        $this->delete("hutang_kartu", "faktur = '$faktur'" ) ;

        $field = "t.faktur,t.tgl,k.keterangan as ketkdtr,t.kodetransaksi,t.cabang,t.jumlah,t.supplier,s.nama as namasupplier,k.dk,t.username,t.datetime";
        $where = "t.faktur = '$faktur'";
        $join  = "left join kodetransaksi k on k.kode = t.kodetransaksi";
        $join  .= " left join supplier s on s.kode = t.supplier";
        $dbd   = $this->select("persekot_mutasi_total t", $field, $where, $join) ;
        while($dbr = $this->getrow($dbd)){
            $keterangan = $dbr['ketkdtr'] . " [".$faktur."] an ".$dbr['namasupplier'];
            $debet = $dbr['jumlah'] ;
            $kredit = 0;
            if($dbr['dk'] == 'D'){
                $debet = 0 ;
                $kredit = $dbr['jumlah'];
            }
            $this->updkartuhutang($faktur,$faktur,$dbr['supplier'],$dbr['tgl'],$dbr['cabang'],
                                  $keterangan,$debet,$kredit,$dbr['username'],$dbr['datetime'],"P");
        }
    }

    public function updrekmutasipersekot($faktur){
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;

        $field = "t.faktur,t.tgl,k.keterangan as ketkdtr,t.kodetransaksi,t.cabang,t.jumlah,t.supplier,s.nama as namasupplier,
                  k.dk,t.username,t.datetime,k.rekening";
        $where = "t.faktur = '$faktur'";
        $join  = "left join kodetransaksi k on k.kode = t.kodetransaksi";
        $join  .= " left join supplier s on s.kode = t.supplier";
        $dbd   = $this->select("persekot_mutasi_total t", $field, $where, $join) ;
        while($dbr = $this->getrow($dbd)){
            $keterangan = $dbr['ketkdtr'] . " [".$faktur."] an ".$dbr['namasupplier'];

            $debet = 0 ;
            $kredit = $dbr['jumlah'];
            if($dbr['dk'] == 'D'){
                $debet = $dbr['jumlah'] ;
                $kredit = 0;
            }
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr['rekening'],$keterangan,
                                $debet,$kredit,$dbr['datetime'],$dbr['username']);

            $f = "d.faktur,r.kode,concat(d.rekening,'-',r.keterangan) as ketrekening,d.jumlah,d.rekening";
            $w = "d.faktur = '$faktur'";
            $j  = "left join keuangan_rekening r on r.kode = d.rekening";
            $d   = $this->select("persekot_mutasi_detail d", $f, $w, $j) ;
            while($dbr2 = $this->getrow($d)){
                $debet2 = 0 ;
                $kredit2 = $dbr2['jumlah'];
                if($dbr['dk'] == 'K'){
                    $debet2 = $dbr2['jumlah'] ;
                    $kredit2 = 0;
                }

                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr2['rekening'],$keterangan,
                                    $debet2,$kredit2,$dbr['datetime'],$dbr['username']);
            }
        }
    }

    /***************************************************/
    /************Mutasi Uang Muka Penjualan***************************************/
    public function updkartuhutanguangmuka($faktur){
        $this->delete("piutang_kartu", "faktur = '$faktur'" ) ;

        $field = "t.faktur,t.tgl,k.keterangan as ketkdtr,t.kodetransaksi,t.cabang,t.jumlah,t.customer,s.nama as namacustomer,k.dk,t.username,t.datetime";
        $where = "t.faktur = '$faktur'";
        $join  = "left join kodetransaksi k on k.kode = t.kodetransaksi";
        $join  .= " left join customer s on s.kode = t.customer";
        $dbd   = $this->select("uangmuka_mutasi_total t", $field, $where, $join) ;
        while($dbr = $this->getrow($dbd)){
            $keterangan = $dbr['ketkdtr'] . " [".$faktur."] an ".$dbr['namacustomer'];
            $debet = $dbr['jumlah'] ;
            $kredit = 0;
            if($dbr['dk'] == 'K'){
                $debet = 0 ;
                $kredit = $dbr['jumlah'];
            }
            $this->updkartupiutang($faktur,$faktur,$dbr['customer'],$dbr['tgl'],$dbr['cabang'],
                                   $keterangan,$debet,$kredit,$dbr['username'],$dbr['datetime'],"U");
        }
    }

    public function updrekmutasiuangmuka($faktur){
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;

        $field = "t.faktur,t.tgl,k.keterangan as ketkdtr,t.kodetransaksi,t.cabang,t.jumlah,t.customer,s.nama as namacustomer,
                  k.dk,t.username,t.datetime,k.rekening";
        $where = "t.faktur = '$faktur'";
        $join  = "left join kodetransaksi k on k.kode = t.kodetransaksi";
        $join  .= " left join customer s on s.kode = t.customer";
        $dbd   = $this->select("uangmuka_mutasi_total t", $field, $where, $join) ;
        while($dbr = $this->getrow($dbd)){
            $keterangan = $dbr['ketkdtr'] . " [".$faktur."] an ".$dbr['namacustomer'];

            $debet = 0 ;
            $kredit = $dbr['jumlah'];
            if($dbr['dk'] == 'D'){
                $debet = $dbr['jumlah'] ;
                $kredit = 0;
            }
            $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr['rekening'],$keterangan,
                                $debet,$kredit,$dbr['datetime'],$dbr['username']);

            $f = "d.faktur,r.kode,concat(d.rekening,'-',r.keterangan) as ketrekening,d.jumlah,d.rekening";
            $w = "d.faktur = '$faktur'";
            $j  = "left join keuangan_rekening r on r.kode = d.rekening";
            $d   = $this->select("uangmuka_mutasi_detail d", $f, $w, $j) ;
            while($dbr2 = $this->getrow($d)){
                $debet2 = 0 ;
                $kredit2 = $dbr2['jumlah'];
                if($dbr['dk'] == 'K'){
                    $debet2 = $dbr2['jumlah'] ;
                    $kredit2 = 0;
                }

                $this->updbukubesar($dbr['faktur'],$dbr['cabang'],$dbr['tgl'],$dbr2['rekening'],$keterangan,
                                    $debet2,$kredit2,$dbr['datetime'],$dbr['username']);
            }
        }
    }

    /***************************************************/
    /**********Opname stock*****************************************/
    public function updkartustockopname($faktur){
        $this->delete("stock_kartu", "faktur = '$faktur'" ) ;
        $field      = "t.faktur,d.kode,d.saldosistem,d.saldoreal,t.username,t.cabang,t.gudang,t.datetime,t.tgl";
        $where      = "d.faktur = '$faktur' and t.status = '1'";
        $join       = "left join stock_opname_posting_total t on t.faktur = d.faktur "; 
        $dbd        = $this->select("stock_opname_posting_detail d", $field, $where, $join, "") ;
        while($dbr  = $this->getrow($dbd)){
            //STOCK HP DI HAPUS DULU
            $this->delete("stock_hp", "tgl = '{$dbr['tgl']}' and kode = '{$dbr['kode']}' and cabang = '{$dbr['cabang']}'" ) ;

            $cfghpp = $this->perhitungan_m->getcfghpp($dbr['tgl']);

            $keterangan = "Opname Stock [".$dbr['faktur']."]";
            //$this->edit("produksi_hasil",array("hp"=>$hp),"faktur = " . $this->escape($faktur));
            $hp = 0 ;
            $hptot = 0 ;
            $debet = 0;
            $kredit = $dbr['saldosistem'];
            if($dbr['saldosistem'] < 0){
                $kredit = 0;
                $debet = $dbr['saldosistem'] * -1;
            }
            if($kredit > 0){
                $arrhp = $this->perhitungan_m->getsaldohpstock($dbr['kode'],$dbr['tgl'],$dbr['cabang']);

                $arrdata = $arrhp['detailhp'];
                $hptot = $arrhp['hptot'];
                $saldosistem = $kredit ;
                //stock dikeluarkan sesuai saldo yang ada di stock_hp dan saldo sistem
                foreach($arrdata as $key => $val){
                    if($saldosistem > 0){
                        $qtydikeluarkan = min($saldosistem,$val['qty']);
                        $this->updkartustock($faktur,$dbr['kode'],$dbr['tgl'],$dbr['gudang'],$dbr['cabang'],$keterangan,0,$qtydikeluarkan,
                                             $val['hp'],$dbr['username'],$dbr['datetime']);
                        $saldosistem -= $qtydikeluarkan;
                    }
                }
                //apabila dari proses sebelumnya masihada sisa dan tak terdeteksi hpnya atau tidak masuk daklam data hp maka di keluarakan dengan hp 0
                if($saldosistem > 0){

                    $keterangan = "Opname Stock Selisih [".$dbr['faktur']."]";
                    $this->updkartustock($faktur,$dbr['kode'],$dbr['tgl'],$dbr['gudang'],$dbr['cabang'],$keterangan,0,$saldosistem,
                                         0,$dbr['username'],$dbr['datetime']);

                }
            }else{
                $this->updkartustock($faktur,$dbr['kode'],$dbr['tgl'],$dbr['gudang'],$dbr['cabang'],$keterangan,$debet,0,
                                     0,$dbr['username'],$dbr['datetime']);

            }

            $hprealtot = 0 ;
            if($dbr['saldoreal'] > 0){
                $this->delete("stock_hp","kode = '{$dbr['kode']}' and tgl = '{$dbr['tgl']}' and cabang = '{$dbr['cabang']}'");
                $arrhist = $arrhp = $this->perhitungan_m->gethistorydebetsaldo($dbr['kode'],$dbr['tgl'],$dbr['cabang'],$dbr['saldoreal']);
                foreach($arrhist as $key => $val){
                    $hprealtot += $val['hp'] * $val['qty'];
                    $this->updkartustock($faktur,$dbr['kode'],$dbr['tgl'],$dbr['gudang'],$dbr['cabang'],$keterangan, $val['qty'],0,
                                         $val['hp'],$dbr['username'],$dbr['datetime']);
                    $val = array("faktur"=>$faktur,"tgl"=>$dbr['tgl'],"kode"=>$dbr['kode'],
                                 "cabang"=>$dbr['cabang'],"qty"=>$val['qty'],"hp"=>$val['hp'],"datetime"=>$dbr['datetime']);
                    $this->insert("stock_hp",$val);
                }
            }else{
                $val = array("faktur"=>$faktur,"tgl"=>$dbr['tgl'],"kode"=>$dbr['kode'],
                             "cabang"=>$dbr['cabang'],"qty"=>0,"hp"=>0,"datetime"=>$dbr['datetime']);
                $this->insert("stock_hp",$val);

            }


            $this->edit("stock_opname_posting_detail",array("nilaipersdsistem"=>$hptot,"nilaipersdreal"=>$hprealtot),"faktur = '$faktur' and kode ='{$dbr['kode']}'" );
            /*$arrhp = $this->perhitungan_m->gethpstock($dbr['stock'],$dbr['tgl'],$dbr['tgl'],$saldoqty,0,$dbr['cabang'],
                                                      $cfghpp['caraperhitungan'],$cfghpp['periode']);*/

        }
    }
    public function updrekstockopname($faktur){
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;
        $vajurnal   =  array();
        $field      = "t.faktur,d.kode,d.saldosistem,d.saldoreal,t.username,t.cabang,
                        t.gudang,t.datetime,t.tgl,d.nilaipersdsistem,d.nilaipersdreal,s.stock_group,g.rekpersd,g.keterangan as ketgol";
        $where      = "d.faktur = '$faktur' and t.status = '1'";
        $join       = "left join stock_opname_posting_total t on t.faktur = d.faktur left join stock s on s.kode = d.kode"; 
        $join       .= " left join stock_group g on g.kode = s.stock_group"; 
        $dbd        = $this->select("stock_opname_posting_detail d", $field, $where, $join, "") ;
        while($dbr  = $this->getrow($dbd)){
            if(!isset($vajurnal[$dbr['stock_group']])){
                $vajurnal[$dbr['stock_group']] = array("tgl"=>$dbr['tgl'],"cabang"=>$dbr['cabang'],
                                                       "rekpersd"=>$dbr['rekpersd'],"keterangan"=>$dbr['ketgol'],
                                                       "debet"=>0,"kredit"=>0,
                                                       "rekselisihopname"=>$this->getconfig("rekselisihopname"),
                                                       "username"=>$dbr['username'],"datetime"=>$dbr['datetime']);
            }
            $vajurnal[$dbr['stock_group']]['debet'] += $dbr['nilaipersdreal'];
            $vajurnal[$dbr['stock_group']]['kredit'] += $dbr['nilaipersdsistem'];
        }

        //upd bukubesar opname
        $arrjurnal = array();
        foreach($vajurnal as $key => $val){
            $selisih = $val['debet'] - $val['kredit'];
            $debet = $selisih;
            $kredit = 0;
            if($selisih < 0){
                $debet = 0;
                $kredit = $selisih * -1;
            }
            $keterangan = "selisih stock opname real dengan sistem";
            $this->updbukubesar($faktur,$val['cabang'],$val['tgl'],$val['rekpersd'],$keterangan,
                                $debet,$kredit,$val['datetime'],$val['username']);
            $this->updbukubesar($faktur,$val['cabang'],$val['tgl'],$val['rekselisihopname'],$keterangan,
                                $kredit,$debet,$val['datetime'],$val['username']);

            if(!isset($arrjurnal[$val['rekpersd']])){
                $arrjurnal[$val['rekpersd']] = array("cabang"=>$val['cabang'],"tgl"=>$val['tgl'],"saldoreal"=>0,
                                                     "username"=>$val['username'],"datetime"=>$val['datetime'],
                                                     "rekselisihopname"=>$val['rekselisihopname']);
            }
            $arrjurnal[$val['rekpersd']]['saldoreal'] += $val['debet'];
        }

        //jurnal selisih neraca dan real
        foreach($arrjurnal as $key => $val){
            $saldoneraca = $this->perhitungan_m->getsaldo($val['tgl'],$key);
            $selisih = $val['saldoreal'] - $saldoneraca;
            $debet = $selisih;
            $kredit = 0;
            if($selisih < 0){
                $debet = 0;
                $kredit = $selisih * -1;
            }

            $keterangan = "selisih stock opname real dengan neraca";
            $this->updbukubesar($faktur,$val['cabang'],$val['tgl'],$key,$keterangan,
                                $debet,$kredit,$val['datetime'],$val['username']);
            $this->updbukubesar($faktur,$val['cabang'],$val['tgl'],$val['rekselisihopname'],$keterangan,
                                $kredit,$debet,$val['datetime'],$val['username']);
        }



    } 
    /***************************************************/
    /**********Mutasi Stock*****************************************/

    public function updkartustockmutasistock($faktur){
        $this->delete("stock_kartu", "faktur = '$faktur'" ) ;
        $field = "m.faktur as faktur,m.tgl,m.gudangfrom,g1.keterangan ketgudangfrom,m.stockfrom,s1.keterangan namastockfrom, s1.satuan satuanfrom,
                  s1.barcode as barcodefrom,m.qtyfrom,m.gudangto,g2.keterangan ketgudangto,m.stockto,s2.keterangan namastockto,
                  s2.satuan satuanto,s2.barcode as barcodeto,m.qtyto,m.username,m.datetime";
        $where = "m.faktur = '$faktur'";
        $join = "left join gudang g1 on g1.kode = m.gudangfrom left join gudang g2 on g2.kode = m.gudangto
                 left join stock s1 on s1.kode = m.stockfrom left join stock s2 on s2.kode = m.stockto";
        $data = $this->select("mutasi_stock m", $field, $where, $join);

        if($dbr=$this->getrow($data)){
            $hp = 0;
            
            //proses stok from
            $cfghpp = $this->perhitungan_m->getcfghpp($dbr['tgl']);
            $saldoqty = $this->perhitungan_m->GetSaldoAkhirStock($dbr['stockfrom'],$dbr['tgl'],"","") ;
            $arrhp = $this->perhitungan_m->gethpstock($dbr['stockfrom'],$dbr['tgl'],$dbr['tgl'],$saldoqty,$dbr['qtyfrom'],"",
                                                      $cfghpp['caraperhitungan'],$cfghpp['periode']);

            $hp = devide($arrhp['hpdikeluarkan'],$dbr['qtyfrom']);
            $keterangan = "mutasi stock ke ".$dbr['stockto']." ".$dbr['namastockto'];
            $this->updkartustock($faktur,$dbr['stockfrom'],$dbr['tgl'],$dbr['gudangfrom'],"",
                                 $keterangan,0,$dbr['qtyfrom'],$hp,$dbr['username'],$dbr['datetime']);
            
            //proses stock to
            $hpto = devide($arrhp['hpdikeluarkan'],$dbr['qtyto']);
            $keterangan = "mutasi stock dari ".$dbr['stockfrom']." ".$dbr['namastockfrom'];
            $this->updkartustock($faktur,$dbr['stockto'],$dbr['tgl'],$dbr['gudangto'],"",
                                 $keterangan,$dbr['qtyto'],0,$hpto,$dbr['username'],$dbr['datetime']);

            $saldoqty = $this->perhitungan_m->GetSaldoAkhirStock($dbr['stockto'],$dbr['tgl'],"","") ;
            $arrhp = $this->perhitungan_m->gethpstock($dbr['stockto'],$dbr['tgl'],$dbr['tgl'],$saldoqty,0,"",
                                                      $cfghpp['caraperhitungan'],$cfghpp['periode']);

            $this->edit("mutasi_stock",array("hpfrom"=>$hp,"hpto"=>$hpto),"faktur = '$faktur'");
        }
    }

    public function updrekmutasistock($faktur){
        $this->delete("keuangan_bukubesar", "faktur = '$faktur'" ) ;
        $field = "m.faktur,m.tgl,m.gudangfrom,g1.keterangan ketgudangfrom,m.stockfrom,s1.keterangan namastockfrom, s1.satuan satuanfrom,
                  s1.barcode as barcodefrom,m.qtyfrom,m.gudangto,g2.keterangan ketgudangto,m.stockto,s2.keterangan namastockto,
                  s2.satuan satuanto,s2.barcode as barcodeto,m.qtyto,m.username,m.datetime,m.hpfrom,m.hpto,
                  sg1.rekpersd rekpersdfrom,sg2.rekpersd rekpersdto";
        $where = "m.faktur = '$faktur'";
        $join = "left join gudang g1 on g1.kode = m.gudangfrom left join gudang g2 on g2.kode = m.gudangto
                 left join stock s1 on s1.kode = m.stockfrom left join stock s2 on s2.kode = m.stockto
                 left join stock_group sg1 on sg1.kode = s1.stock_group left join stock_group sg2 on sg2.kode = s2.stock_group";
        $data = $this->select("mutasi_stock m", $field, $where, $join);
        if($dbr=$this->getrow($data)){
            $tothpfrom = $dbr['qtyfrom'] * $dbr['hpfrom'];
            $keterangan = "mutasi stock";
            $this->updbukubesar($dbr['faktur'],"",$dbr['tgl'],$dbr['rekpersdfrom'],$keterangan,
                                    0,$tothpfrom,$dbr['datetime'],$dbr['username']);

            $tothpto = $dbr['qtyto'] * $dbr['hpto'];
            $keterangan = "mutasi stock";
            $this->updbukubesar($dbr['faktur'],"",$dbr['tgl'],$dbr['rekpersdto'],$keterangan,
                                    $tothpto,0,$dbr['datetime'],$dbr['username']);

            $selisih = $tothpfrom - $tothpto;
            $debet = $selisih;
            $kredit = 0 ;
            if($selisih < 0){
                $debet = 0;
                $kredit = $selisih * -1;
            }
            $keterangan = "selisih mutasi stock";
            $this->updbukubesar($dbr['faktur'],"",$dbr['tgl'],$this->getconfig("rekselisih"),$keterangan,
                                    $debet,$kredit,$dbr['datetime'],$dbr['username']);

        }
    }

    /***************************************************/
    /**********Posting*****************************************/
    public function postingharian($tglawal,$tglakhir,$cabang){
        $tglawal = date_2s($tglawal);
        $tglakhir = date_2s($tglakhir);
        $this->delete("stock_kartu", "tgl >= '$tglawal' and tgl <= '$tglakhir'" ) ;
        $this->delete("stock_hp", "tgl >= '$tglawal' and tgl <= '$tglakhir'" ) ;
        $this->delete("keuangan_bukubesar", "tgl >= '$tglawal' and tgl <= '$tglakhir'" ) ;

        //PEMBELIAN
        $where = "tgl >= '$tglawal' and tgl <= '$tglakhir' and status = '1'";
        $dbd      = $this->select("pembelian_total","faktur", $where, "", "") ;
        while($dbr = $this->getrow($dbd)){
            $this->updkartustockpembelian($dbr['faktur']);
            $this->updrekpembelian($dbr['faktur']);
        }

        //RETUR PEMBELIAN
        $where = "tgl >= '$tglawal' and tgl <= '$tglakhir' and status = '1'";
        $dbd      = $this->select("pembelian_retur_total","faktur", $where, "", "") ;
        while($dbr = $this->getrow($dbd)){
            $this->updkartustockreturpembelian($dbr['faktur']);
            $this->updrekreturpembelian($dbr['faktur']);
        }

        //PELUNASAN HUTANG
        $where = "tgl >= '$tglawal' and tgl <= '$tglakhir'  and status = '1'";
        $dbd      = $this->select("hutang_pelunasan_total","faktur", $where, "", "") ;
        while($dbr = $this->getrow($dbd)){
            $this->updrekhutangpelunasan($dbr['faktur']);

        }

        //mutasi stock
        $where = "tgl >= '$tglawal' and tgl <= '$tglakhir' and status = '1'";
        $dbd      = $this->select("mutasi_stock","*",$where, "", "") ;
        while($dbr = $this->getrow($dbd)){
            //print_r($dbr);
            $faktur = $dbr['faktur'];
            //echo("alert('".$faktur."');");
            $this->updkartustockmutasistock($faktur);
            $this->updrekmutasistock($faktur);
        }

        //PENJUALAN PRODUK
        $where = "tgl >= '$tglawal' and tgl <= '$tglakhir' and status = '1'";
        $dbd      = $this->select("penjualan_total","faktur", $where, "", "") ;
        while($dbr = $this->getrow($dbd)){
            $this->updkartustockpenjualan($dbr['faktur']);
            $this->updrekpenjualan($dbr['faktur']);
        }

        //RETUR PENJUALAN PRODUK
        $where = "tgl >= '$tglawal' and tgl <= '$tglakhir' and status = '1'";
        $dbd      = $this->select("penjualan_retur_total","faktur", $where, "", "") ;
        while($dbr = $this->getrow($dbd)){
            $this->updkartustockreturpenjualan($dbr['faktur']);
            $this->updrekreturpenjualan($dbr['faktur']);
        }

        //stock opname
        $where = "tgl >= '$tglawal' and tgl <= '$tglakhir' and status = '1'";
        $dbd      = $this->select("stock_opname_posting_total","faktur", $where, "", "faktur") ;
        while($dbr = $this->getrow($dbd)){
            $this->updkartustockopname($dbr['faktur']);
            $this->updrekstockopname($dbr['faktur']);
        }

        //PELUNASAN PIUTANG
        $where = "tgl >= '$tglawal' and tgl <= '$tglakhir' and status = '1'";
        $dbd      = $this->select("piutang_pelunasan_total","faktur", $where, "", "") ;
        while($dbr = $this->getrow($dbd)){
            $this->updrekpiutangpelunasan($dbr['faktur']);
        }

        //JURNAL
        $where = "tgl >= '$tglawal' and tgl <= '$tglakhir'";
        $dbd      = $this->select("keuangan_jurnal","faktur", $where, "", "faktur") ;
        while($dbr = $this->getrow($dbd)){
            $this->updrekjurnal($dbr['faktur']);
        }

        //Mutasi Kas
        $where = "tgl >= '$tglawal' and tgl <= '$tglakhir' and status = '1'";
        $dbd      = $this->select("kas_mutasi_total","faktur", $where, "", "faktur") ;
        while($dbr = $this->getrow($dbd)){
            $this->updrekmutasikas($dbr['faktur']);
        }

    }
    /***************************************************/
}
?>
