<?php

class Rptreturpenjualan_m extends Bismillah_Model{

    public function loadgrid($va){
        $limit      = $va['offset'].",".$va['limit'] ;
        $search     = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search     = $this->escape_like_str($search) ;
        $where      = array() ;
        if($search !== "") $where[] = "t.faktur LIKE '%{$search}%'" ;
        $where[]    = "t.tgl >= '{$va['tglAwal']}' and t.tgl <= '{$va['tglAkhir']}'";
        $where[]    = "t.status = '1'";
        $where      = implode(" AND ", $where) ;
        $field      = "t.faktur,t.tgl,t.total,s.nama as customer";
        $cJoin      = "LEFT JOIN customer s on s.Kode = t.customer";
        $dbd        = $this->select("penjualan_retur_total t", $field, $where, $cJoin ,"", "t.faktur ASC", $limit) ;
        $dba        = $this->select("penjualan_retur_total t", "id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getDetail($cFaktur){
        $cField = "s.kode, p.faktur,s.keterangan,p.jumlah,p.harga,p.qty,s.satuan, t.Tgl, sp.nama as customer";
        $cJoin  = "LEFT JOIN stock s ON s.kode = p.stock
                   Left JOIN penjualan_retur_total t on t.faktur = p.faktur
                   LEFT JOIN customer sp on sp.kode = t.customer" ;
        $cWhere = "p.faktur = '".$cFaktur."'" ;
        $dbData = $this->select("penjualan_retur_detail p",$cField,$cWhere,$cJoin) ;
        return $dbData ;
    }

    public function GetDataPerFaktur($faktur){
        $data  = array() ;
        $cField = "p.faktur, SUM(t.subtotal) as subtotal,SUM(t.total) as total,  t.Tgl, s.nama as customer";
        $cWhere = "p.faktur = '".$faktur."'" ;
        $vaJoin = "LEFT JOIN penjualan_retur_total t ON t.faktur = p.faktur
                   LEFT JOIN customer s on s.kode = t.customer" ;
        $dbData = $this->select("penjualan_retur_detail p",$cField,$cWhere,$vaJoin) ;
        if($dbr = $this->getrow($dbData)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getTotal($dTglAwal,$dTglAkhir){
        $cField = "t.faktur,  t.tgl, t.cabang, t.gudang,  t.total,  s.nama as customer" ;
        $cWhere = "tgl >= '".$dTglAwal."' AND tgl <= '".$dTglAkhir."' and status = '1'" ;
        $cJoin  = "LEFT JOIN customer s on s.Kode = t.customer" ;
        $dbData = $this->select("penjualan_retur_total t",$cField,$cWhere,$cJoin);
        return $dbData ;
    }

}
