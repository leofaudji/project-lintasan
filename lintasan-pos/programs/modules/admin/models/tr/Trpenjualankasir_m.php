<?php
class Trpenjualankasir_m extends Bismillah_Model{

    public function saving($va){
        $gudang = $this->getconfig("pjgudang");
        if($va['total'] == "")$va['total'] = 0;
        if($va['totalpj'] == "")$va['totalpj'] = 0;
        if($va['bayar'] == "")$va['bayar'] = 0;
        if($va['bayar'] == "")$va['diskonnom'] = 0;
        $nTotal = string_2n($va['totalpj']) - string_2n($va['diskonnom']);
        $data    = array("faktur"=>$va['faktur'],"tgl"=>$va['tgl'],"subtotal"=>string_2n($va['total']),"diskon"=>string_2n($va['diskonnom']), 
                         "total"=>string_2n($nTotal),"kas"=>string_2n($va['bayar']),
                         "status"=>"1","gudang"=>$gudang,
                         "cabang"=> getsession($this, "cabang"),"username"=> getsession($this, "username"),
                         "datetime_insert"=>date("Y-m-d H:i:s")) ;
        $where   = "faktur = " . $this->escape($va['faktur']) ;
        $this->update("penjualan_total", $data, $where, "") ;

        //insert detail penjualan
        $vaGrid = json_decode($va['grid2']);
        $this->delete("penjualan_detail", "faktur = '{$va['faktur']}'" ) ;
        foreach($vaGrid as $key => $val){
            $vadetail = array("faktur"=>$va['faktur'],"stock"=>$val->stock,"qty"=>$val->qty,"harga"=>$val->harga,"diskonqty"=>$val->diskon,
                              "jumlah"=>$val->jumlah,
                              "totalitem"=>$val->jumlah,"username"=> getsession($this, "username"));
            $this->insert("penjualan_detail",$vadetail);
        }


        //update kartu stock
        $this->updtransaksi_m->updkartupiutangpenjualan($va['faktur']);
        $this->updtransaksi_m->updkartustockpenjualan($va['faktur']);
        $this->updtransaksi_m->updrekpenjualan($va['faktur']);
    }

    public function getfaktur($l=true){
        $cabang = getsession($this, "cabang") ;
        $key  = "CS".$cabang.date("ymd");
        $n    = $this->getincrement($key, $l,5);
        $faktur    = $key.$n ;
        return $faktur ;
    }

    public function loadgrid3($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        //$where[]	= "jenis = 'P'" ;
        if($search !== "") $where[]	= "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;
        $where 	 = implode(" AND ", $where) ;
        $dbd      = $this->select("stock", "kode,keterangan,satuan", $where, "", "", "kode ASC", $limit) ;
        $dba      = $this->select("stock", "id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getdata($kode,$qty){
        $data = array() ;
        if($d = $this->getval("*", "kode = " . $this->escape($kode) ." or barcode = ". $this->escape($kode), "stock")){
            $arrhj = $this->perhitungan_m->gethjstock($d['kode'],$qty);
            $d['hargajual'] = $arrhj['hargajual'];
            $d['diskon'] = $arrhj['diskon'];
            $data = $d;
        }
        return $data ;
    }

    public function seekcustomer($search){
        $where = "kode LIKE '{$search}%' OR nama LIKE '%{$search}%'" ;
        $dbd      = $this->select("customer", "*", $where, "", "", "nama ASC", '50') ;
        return array("db"=>$dbd) ;
    }
    
    public function getdatadetailsj($fktsj){
        $field = "d.stock,s.keterangan as namastock,d.qty,s.satuan,s.hargajual as harga,(s.hargajual * qty) as jumlah";
        $where = "d.faktur = '$fktsj'";
        $join  = "left join stock s on s.kode = d.stock";
        $dbd   = $this->select("sj_detail d", $field, $where, $join) ;
        return $dbd ;
    }

    public function loadgrid4($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "(p.faktur LIKE '{$search}%' OR s.nama LIKE '%{$search}%')" ;
        $where[]	= "p.status = '1' and b.faktur is null" ;
        $where 	 = implode(" AND ", $where) ;
        $field = "p.faktur,p.tgl,s.nama as customer";
        $join ="left join customer s on s.kode = p.customer left join penjualan_total b on b.sj = p.faktur";
        $dbd      = $this->select("sj_total p", $field, $where, $join, "", "p.faktur asc", $limit) ;
        $dba      = $this->select("sj_total p", "p.id", $where, $join) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getdatasj($fktsj){
        $data = array() ;
        $where	= "p.faktur = '$fktsj'" ;
        $field = "p.faktur,p.tgl,p.customer,s.nama as namacustomer";
        $join ="left join customer s on s.kode = p.customer";
        $dbd      = $this->select("sj_total p", $field, $where, $join, "", "p.faktur DESC") ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }
}
?>
