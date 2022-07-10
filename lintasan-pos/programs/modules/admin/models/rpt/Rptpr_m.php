<?php

class Rptpr_m extends Bismillah_Model{

    public function loadgrid($va){
        $limit      = $va['offset'].",".$va['limit'] ;
        $search     = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search     = $this->escape_like_str($search) ;
        $where      = array() ;
        if($search !== "") $where[] = "t.faktur LIKE '%{$search}%'" ;
        $where[]    = "t.tgl >= '{$va['tglAwal']}' and t.tgl <= '{$va['tglAkhir']}'";
        $where[]    = "t.status = '1'";
        $where      = implode(" AND ", $where) ;
        $field      = "t.faktur,t.tgl,s.keterangan as gudang";
        $cJoin      = "LEFT JOIN gudang s on s.Kode = t.gudang";
        $dbd        = $this->select("pr_total t", $field, $where, $cJoin ,"", "t.faktur ASC", $limit) ;
        $dba        = $this->select("pr_total t", "id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getDetailPR($cFaktur){
        $cField = "s.kode, p.faktur,s.keterangan,p.qty,s.satuan, t.Tgl";
        $cJoin  = "LEFT JOIN stock s ON s.kode = p.stock
                   Left JOIN pr_total t on t.faktur = p.faktur" ;
        $cWhere = "p.faktur = '".$cFaktur."'" ;
        $dbData = $this->select("pr_detail p",$cField,$cWhere,$cJoin) ;
        return $dbData ;
    }

    public function GetDataPerFaktur($faktur){
        $data  = array() ;
        $cField = "p.faktur,  t.Tgl, s.keterangan as gudang";
        $cWhere = "p.faktur = '".$faktur."'" ;
        $vaJoin = "LEFT JOIN pr_total t ON t.faktur = p.faktur
                   LEFT JOIN gudang s on s.kode = t.gudang" ;
        $dbData = $this->select("pr_detail p",$cField,$cWhere,$vaJoin) ;
        if($dbr = $this->getrow($dbData)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getTotalPR($dTglAwal,$dTglAkhir){
        $cField = "t.faktur,  t.tgl, t.cabang, t.gudang,  s.keterangan as gudang" ;
        $cWhere = "t.tgl >= '".$dTglAwal."' AND t.tgl <= '".$dTglAkhir."'" ;
        $cJoin  = "LEFT JOIN gudang s on s.Kode = t.gudang" ;
        $dbData = $this->select("pr_total t",$cField,$cWhere,$cJoin);
        return $dbData ;
    }

}
