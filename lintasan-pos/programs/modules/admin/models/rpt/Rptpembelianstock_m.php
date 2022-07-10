<?php

class Rptpembelianstock_m extends Bismillah_Model{

    public function loadgrid($va){
        $limit      = $va['offset'].",".$va['limit'] ;
        $search     = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search     = $this->escape_like_str($search) ;
        $where      = array() ;
        if($search !== "") $where[] = "t.faktur LIKE '%{$search}%'" ;
        $where[]    = "t.tgl >= '{$va['tglAwal']}' and t.tgl <= '{$va['tglAkhir']}'";
        $where[]    = "t.status = '1'";
        $where      = implode(" AND ", $where) ;
        $field      = "t.faktur,t.tgl,t.subtotal,t.diskon,t.ppn,t.total,s.nama as supplier,t.fktpo";
        $cJoin      = "LEFT JOIN supplier s on s.Kode = t.supplier";
        $dbd        = $this->select("pembelian_total t", $field, $where, $cJoin ,"", "t.faktur ASC", $limit) ;
        $dba        = $this->select("pembelian_total t", "id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getDetailPembelian($cFaktur){
        $cField = "s.Kode as KodeStock, p.faktur,s.keterangan,p.jumlah as pembelian,p.harga as HargaSatuan,p.qty,
                    s.satuan,p.diskonitem as hargadiskon,p.totalitem as total, t.Tgl, sp.nama as supplier";
        $cJoin  = "LEFT JOIN stock s ON s.kode = p.stock
                   Left JOIN pembelian_total t on t.faktur = p.faktur
                   LEFT JOIN supplier sp on sp.kode = t.supplier" ;
        $cWhere = "p.faktur = '".$cFaktur."'" ;
        $dbData = $this->select("pembelian_detail p",$cField,$cWhere,$cJoin) ;
        return $dbData ;
    }

    public function GetDataPerFaktur($faktur){
        $data  = array() ;
        $cField = "p.faktur,SUM(t.subtotal) as subtotal, SUM(t.total) as total, SUM(t.diskon) as diskon,
                   SUM(t.ppn) as ppn, t.Tgl, s.nama as supplier,t.persppn,t.fktpo";
        $cWhere = "p.faktur = '".$faktur."'" ;
        $vaJoin = "LEFT JOIN pembelian_total t ON t.faktur = p.faktur
                   LEFT JOIN supplier s on s.kode = t.supplier" ;
        $dbData = $this->select("pembelian_detail p",$cField,$cWhere,$vaJoin) ;
        if($dbr = $this->getrow($dbData)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getTotalPembelian($dTglAwal,$dTglAkhir){
        $cField = "t.faktur,  t.tgl, t.cabang, t.gudang, t.subtotal, t.diskon, t.ppn, t.total,
                t.hutang,  s.nama as supplier,t.fktpo" ;
        $cWhere = "tgl >= '".$dTglAwal."' AND tgl <= '".$dTglAkhir."' and status = '1'" ;
        $cJoin  = "LEFT JOIN supplier s on s.Kode = t.supplier" ;
        $dbData = $this->select("pembelian_total t",$cField,$cWhere,$cJoin);
        return $dbData ;
    }

}
