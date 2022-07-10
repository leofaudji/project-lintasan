<?php

class Rptpo_m extends Bismillah_Model{

    public function loadgrid($va){
        $limit      = $va['offset'].",".$va['limit'] ;
        $search     = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search     = $this->escape_like_str($search) ;
        $where      = array() ;
        if($search !== "") $where[] = "t.faktur LIKE '%{$search}%'" ;
        $where[]    = "t.tgl >= '{$va['tglAwal']}' and t.tgl <= '{$va['tglAkhir']}'";
        $where[]    = "t.status = '1'";
        $where      = implode(" AND ", $where) ;
        $field      = "t.faktur,t.tgl,t.total,s.nama as supplier,t.fktpr";
        $cJoin      = "LEFT JOIN supplier s on s.Kode = t.supplier";
        $dbd        = $this->select("po_total t", $field, $where, $cJoin ,"", "t.faktur ASC", $limit) ;
        $dba        = $this->select("po_total t", "id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getDetailPO($cFaktur){
        $cField = "s.kode, p.faktur,s.keterangan,p.spesifikasi,p.jumlah,p.harga,
                   p.qty,s.satuan, t.Tgl, sp.nama as supplier,t.fktpr";
        $cJoin  = "LEFT JOIN stock s ON s.kode = p.stock
                   Left JOIN po_total t on t.faktur = p.faktur
                   LEFT JOIN supplier sp on sp.kode = t.supplier" ;
        $cWhere = "p.faktur = '".$cFaktur."'" ;
        $dbData = $this->select("po_detail p",$cField,$cWhere,$cJoin) ;
        return $dbData ;
    }

    public function GetDataPerFaktur($faktur){
        $data  = array() ;
        $cField = "p.faktur,t.total,t.Tgl,s.nama as supplier,t.fktpr";
        $cWhere = "p.faktur = '".$faktur."'" ;
        $vaJoin = "LEFT JOIN po_total t ON t.faktur = p.faktur
                   LEFT JOIN supplier s on s.kode = t.supplier" ;
        $dbData = $this->select("po_detail p",$cField,$cWhere,$vaJoin,"") ;
        if($dbr = $this->getrow($dbData)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getTotalPO($dTglAwal,$dTglAkhir){
        $cField = "t.faktur,  t.tgl, t.cabang, t.gudang,  t.total,  s.nama as supplier,t.fktpr" ;
        $cWhere = "tgl >= '".$dTglAwal."' AND tgl <= '".$dTglAkhir."'" ;
        $cJoin  = "LEFT JOIN supplier s on s.Kode = t.supplier" ;
        $dbData = $this->select("po_total t",$cField,$cWhere,$cJoin);
        return $dbData ;
    }

}
