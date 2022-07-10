<?php
class Trpelunasanhutang_m extends Bismillah_Model{
    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%' or s.nama = '%{$search}%'" ;
        $where[] = "t.status = '1' and t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "t.faktur,t.tgl,s.nama as supplier,t.subtotal,t.diskon,t.pembulatan,t.kasbank,t.persekot";
        $join     = "left join supplier s on s.Kode = t.supplier";
        $dbd      = $this->select("hutang_pelunasan_total t", $field, $where, $join, "", "t.tgl,t.faktur ASC", $limit) ;
        $dba      = $this->select("hutang_pelunasan_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    } 

    public function saving($faktur, $va){
        if(!isset($va['kdtrpskt'])) $va['kdtrpskt'] = "";
        if(!isset($va['bankkas'])) $va['bankkas'] = "";
        $faktur         = getsession($this, "sspelunasanhutang_faktur", "");
        $va['faktur']   = $faktur !== "" ? $faktur : $this->getfaktur() ;
        $data           = array("faktur"=>$va['faktur'],
                                "tgl"=>$va['tgl'],
                                "supplier"=>$va['supplier'],
                                "cabang"=> getsession($this, "cabang"),
                                "pembelian"=>string_2n($va['pembelian']),
                                "retur"=>string_2n($va['retur']),
                                "subtotal"=>string_2n($va['subtotal']),
                                "kasbank"=>string_2n($va['tfkas']),
                                "diskon"=>string_2n($va['diskon']),
                                "pembulatan"=>string_2n($va['pembulatan']),
                                "persekot"=>string_2n($va['persekot']),
                                "rekkasbank"=>$va['bankkas'],
                                "kdtrpersekot"=>$va['kdtrpskt'],
                                "status"=>"1",
                                "username"=> getsession($this, "username"),
                                "datetime"=>date("Y-m-d H:i:s")) ;
        $where          = "faktur = " . $this->escape($faktur) ;
        $this->update("hutang_pelunasan_total", $data, $where, "") ;

        //insert detail pelunsan
        $vaGrid = json_decode($va['grid2']);
        $this->delete("hutang_pelunasan_detail", "faktur = '{$va['faktur']}'" ) ;
        foreach($vaGrid as $key => $val){
            if($val->no <> "" and string_2n($val->pelunasan) > 0){
                $vadetail = array("faktur"=>$va['faktur'],
                              "fkt"=>$val->faktur,
                              "jumlah"=>string_2n($val->pelunasan),
                              "jenis"=>$val->jenis);
                $this->insert("hutang_pelunasan_detail",$vadetail);
            }
        }
        //update transaksi
        $this->updtransaksi_m->updkartuhutangpelunasan($va['faktur']);
        $this->updtransaksi_m->updrekhutangpelunasan($va['faktur']);
    }

    public function getdatatotal($faktur){
        $data  = array() ;
        $field = "t.faktur,t.tgl,t.supplier,s.nama as namasupplier,t.pembelian,t.retur,
                    t.persekot,t.kdtrpersekot,k.keterangan as ketpersekot,k.dk as dktrpersekot,
                  t.subtotal,t.kasbank,t.rekkasbank,t.diskon,t.pembulatan,
                    b.keterangan as ketrekkasbank";
        $where = "t.faktur = '$faktur'";
        $join  = "left join supplier s on s.kode = t.supplier left join bank b on b.kode = t.rekkasbank left join kodetransaksi k on k.kode = t.kdtrpersekot";
        $dbd   = $this->select("hutang_pelunasan_total t", $field, $where, $join) ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }


    public function deleting($faktur){
        $this->delete("keuangan_bukubesar", "faktur = " . $this->escape($faktur)) ;
        $this->delete("stock_kartu", "faktur = " . $this->escape($faktur)) ;
        $this->delete("hutang_kartu", "faktur = " . $this->escape($faktur)) ;
        $this->edit("hutang_pelunasan_total",array("status"=>2),"faktur = " . $this->escape($faktur));
    }

    public function seeksupplier($search){
        $where = "kode LIKE '{$search}%' OR nama LIKE '%{$search}%'" ;
        $dbd      = $this->select("supplier", "*", $where, "", "", "nama ASC", '50') ;
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

    public function getDataStock($cKodeStock){
        $cWhere = "kode = '$cKodeStock' or barcode = '$cKodeStock'";
        $dbData = $this->select("stock","Kode,Keterangan,Satuan",$cWhere);
        return $dbData ;
    }

    public function getfaktur($l=true){
        $cabang = getsession($this, "cabang") ;
        $key  = "PH".$cabang.date("ymd");
        $n    = $this->getincrement($key, $l,5);
        $faktur    = $key.$n ;
        return $faktur ;
    }

    public function loadhutpembelian($va){
        $where = "t.supplier = '{$va['supplier']}' and t.tgl <= '{$va['tgl']}'" ;
        $join = "left join hutang_kartu k on k.fkt = t.faktur and k.tgl <= '{$va['tgl']}' left join hutang_pelunasan_detail d on d.fkt = t.faktur and d.faktur = '{$va['faktur']}'";
        $field = "t.faktur,t.tgl,t.supplier,t.total,sum(k.debet-k.kredit) as saldo,d.jumlah as pelunasan";
        $dbd      = $this->select("pembelian_total t", $field, $where, $join, "t.faktur having saldo <> 0 or pelunasan <> 0", "t.tgl,t.faktur ASC") ;
        return array("db"=>$dbd) ;
    }
    
    public function loadhutreturpembelian($va){
        $where = "t.supplier = '{$va['supplier']}' and t.tgl <= '{$va['tgl']}'" ;
        $join = "left join hutang_kartu k on k.fkt = t.faktur and k.tgl <= '{$va['tgl']}' left join hutang_pelunasan_detail d on d.fkt = t.faktur and d.faktur = '{$va['faktur']}'";
        $field = "t.faktur,t.tgl,t.supplier,t.total,sum(k.kredit-k.debet) as saldo,d.jumlah as pelunasan";
        $dbd      = $this->select("pembelian_retur_total t", $field, $where, $join, "t.faktur having saldo <> 0", "t.tgl,t.faktur ASC") ;
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
