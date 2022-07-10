<?php
class Trpelunasanpiutang_m extends Bismillah_Model{
    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%' or s.nama = '%{$search}%'" ;
        $where[] = "t.status = '1' and t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "t.faktur,t.tgl,s.nama as customer,t.subtotal,t.diskon,t.pembulatan,t.kasbank,t.uangmuka";
        $join     = "left join customer s on s.Kode = t.customer";
        $dbd      = $this->select("piutang_pelunasan_total t", $field, $where, $join, "", "t.tgl asc,t.faktur ASC", $limit) ;
        $dba      = $this->select("piutang_pelunasan_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function saving($faktur, $va){
        if(!isset($va['kdtruangmuka'])) $va['kdtruangmuka'] = "";
        if(!isset($va['bankkas'])) $va['bankkas'] = "";
        $faktur         = getsession($this, "sspelunasanpiutang_faktur", "");
        $va['faktur']   = $faktur !== "" ? $faktur : $this->getfaktur() ;
        $data           = array("faktur"=>$va['faktur'],
                                "tgl"=>$va['tgl'],
                                "customer"=>$va['customer'],
                                "cabang"=> getsession($this, "cabang"),
                                "penjualan"=>string_2n($va['penjualan']),
                                "retur"=>string_2n($va['retur']),
                                "subtotal"=>string_2n($va['subtotal']),
                                "diskon"=>string_2n($va['diskon']),
                                "pembulatan"=>string_2n($va['pembulatan']),
                                "kasbank"=>string_2n($va['tfkas']),
                                "uangmuka"=>string_2n($va['uangmuka']),
                                "rekkasbank"=>$va['bankkas'],
                                "kdtruangmuka"=>$va['kdtruangmuka'],
                                "status"=>"1",
                                "username"=> getsession($this, "username"),
                                "datetime"=>date("Y-m-d H:i:s")) ;
        $where          = "faktur = " . $this->escape($va['faktur']) ;
        $this->update("piutang_pelunasan_total", $data, $where, "") ;

        //insert detail pelunsan
        $vaGrid = json_decode($va['grid2']);
        $this->delete("piutang_pelunasan_detail", "faktur = '{$va['faktur']}'" ) ;
        foreach($vaGrid as $key => $val){
            if($val->no <> "" and string_2n($val->pelunasan) > 0){
                $vadetail = array("faktur"=>$va['faktur'],
                              "fkt"=>$val->faktur,
                              "jumlah"=>string_2n($val->pelunasan),
                              "jenis"=>$val->jenis);
                $this->insert("piutang_pelunasan_detail",$vadetail);
            }
        }
        //update transaksi
        $this->updtransaksi_m->updkartupiutangpelunasan($va['faktur']);
        $this->updtransaksi_m->updrekpiutangpelunasan($va['faktur']);
    }

    public function getdatatotal($faktur){
        $data  = array() ;
        $field = "t.faktur,t.tgl,t.customer,s.nama as namacustomer,t.penjualan,t.retur,t.subtotal,
                  t.uangmuka,t.kdtruangmuka,k.keterangan as ketuangmuka,k.dk as dktruangmuka,
                  t.kasbank,t.rekkasbank,b.keterangan as ketrekkasbank,t.diskon,t.pembulatan";
        $where = "t.faktur = '$faktur'";
        $join  = "left join customer s on s.kode = t.customer left join bank b on b.kode = t.rekkasbank  left join kodetransaksi k on k.kode = t.kdtruangmuka";
        $dbd   = $this->select("piutang_pelunasan_total t", $field, $where, $join) ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }


    public function deleting($faktur){
        $this->delete("keuangan_bukubesar", "faktur = " . $this->escape($faktur)) ;
        $this->delete("stock_kartu", "faktur = " . $this->escape($faktur)) ;
        $this->delete("piutang_kartu", "faktur = " . $this->escape($faktur)) ;
        $this->edit("piutang_pelunasan_total",array("status"=>2),"faktur = " . $this->escape($faktur));
    }

    public function seekcustomer($search){
        $where = "kode LIKE '{$search}%' OR nama LIKE '%{$search}%'" ;
        $dbd      = $this->select("customer", "*", $where, "", "", "nama ASC", '50') ;
        return array("db"=>$dbd) ;
    }

    public function seekbankkas($search){
        $where = "kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%'" ;
        $dbd      = $this->select("bank", "*", $where, "", "", "keterangan ASC", '50') ;
        return array("db"=>$dbd) ;
    }
    
    public function seekkodetransaksi($search){
        $where = "kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%'" ;
        $dbd      = $this->select("kodetransaksi", "*", $where, "", "", "keterangan ASC", '50') ;
        return array("db"=>$dbd) ;
    }

    public function getfaktur($l=true){
        $cabang = getsession($this, "cabang") ;
        $key  = "PP".$cabang.date("ymd");
        $n    = $this->getincrement($key, $l,5);
        $faktur    = $key.$n ;
        return $faktur ;
    }

    public function loadpiutangpenjualan($va){
        $where = "t.customer = '{$va['customer']}' and t.tgl <= '{$va['tgl']}'" ;
        $join = "left join piutang_kartu k on k.fkt = t.faktur and k.tgl <= '{$va['tgl']}' left join piutang_pelunasan_detail d on d.fkt = t.faktur and d.faktur = '{$va['faktur']}'";
        $field = "t.faktur,t.tgl,t.customer,t.total,sum(k.debet-k.kredit) as saldo,d.jumlah as pelunasan";
        $dbd      = $this->select("penjualan_total t", $field, $where, $join, "t.faktur having saldo <> 0 or pelunasan <> 0", "t.tgl,t.faktur ASC") ;
        return array("db"=>$dbd) ;
    }
    
    public function loadpiutangreturpenjualan($va){
        $where = "t.customer = '{$va['customer']}' and t.tgl <= '{$va['tgl']}'" ;
        $join = "left join hutang_kartu k on k.fkt = t.faktur and k.tgl <= '{$va['tgl']}' left join piutang_pelunasan_detail d on d.fkt = t.faktur and d.faktur = '{$va['faktur']}'";
        $field = "t.faktur,t.tgl,t.customer,t.total,sum(k.kredit-k.debet) as saldo,d.jumlah as pelunasan";
        $dbd      = $this->select("penjualan_retur_total t", $field, $where, $join, "t.faktur having saldo <> 0", "t.tgl,t.faktur ASC") ;
        return array("db"=>$dbd) ;
    }

    public function getdata($kode){
        $data = array() ;
        if($d = $this->getval("*", "kode = " . $this->escape($kode), "stock")){
            $data = $d;
        }
        return $data ;
    }
}
?>
