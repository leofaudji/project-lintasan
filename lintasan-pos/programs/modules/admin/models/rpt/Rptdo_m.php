<?php

class Rptdo_m extends Bismillah_Model{

    public function loadgrid($va){
        $limit      = $va['offset'].",".$va['limit'] ;
        $search     = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search     = $this->escape_like_str($search) ;
        $where      = array() ;
        if($search !== "") $where[] = "t.faktur LIKE '%{$search}%'" ;
        $where[]    = "t.tgl >= '{$va['tglAwal']}' and t.tgl <= '{$va['tglAkhir']}'";
        $where[]    = "t.status = '1'";
        $where      = implode(" AND ", $where) ;
        $field      = "t.faktur,t.tgl,s.nama as customer";
        $cJoin      = "LEFT JOIN customer s on s.Kode = t.customer";
        $dbd        = $this->select("do_total t", $field, $where, $cJoin ,"", "t.faktur ASC", $limit) ;
        $dba        = $this->select("do_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getDetailDO($cFaktur){
        $cField = "s.kode, p.faktur,s.keterangan,p.qty,s.satuan, t.Tgl, sp.nama as customer";
        $cJoin  = "LEFT JOIN stock s ON s.kode = p.stock
                   Left JOIN do_total t on t.faktur = p.faktur
                   LEFT JOIN customer sp on sp.kode = t.customer" ;
        $cWhere = "p.faktur = '".$cFaktur."'" ;
        $dbData = $this->select("do_detail p",$cField,$cWhere,$cJoin) ;
        return $dbData ;
    }

    public function GetDataPerFaktur($faktur){
        $data  = array() ;
        $cField = "p.faktur, t.Tgl, s.nama as customer";
        $cWhere = "p.faktur = '".$faktur."'" ;
        $vaJoin = "LEFT JOIN do_total t ON t.faktur = p.faktur
                   LEFT JOIN customer s on s.kode = t.customer" ;
        $dbData = $this->select("do_detail p",$cField,$cWhere,$vaJoin) ;
        if($dbr = $this->getrow($dbData)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getTotalDO($dTglAwal,$dTglAkhir){
        $cField = "t.faktur,  t.tgl, t.cabang,   s.nama as customer" ;
        $cWhere = "t.tgl >= '".$dTglAwal."' AND t.tgl <= '".$dTglAkhir."'" ;
        $cJoin  = "LEFT JOIN customer s on s.Kode = t.customer" ;
        $dbData = $this->select("do_total t",$cField,$cWhere,$cJoin);
        return $dbData ;
    }

}
