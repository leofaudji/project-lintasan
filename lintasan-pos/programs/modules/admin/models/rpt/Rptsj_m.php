<?php

class Rptsj_m extends Bismillah_Model{

    public function loadgrid($va){
        $limit      = $va['offset'].",".$va['limit'] ;
        $search     = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search     = $this->escape_like_str($search) ;
        $where      = array() ;
        if($search !== "") $where[] = "t.faktur LIKE '%{$search}%'" ;
        $where[]    = "t.tgl >= '{$va['tglAwal']}' and t.tgl <= '{$va['tglAkhir']}'";
        $where[]    = "t.status = '1'";
        $where      = implode(" AND ", $where) ;
        $field      = "t.faktur,t.do,t.tgl,t.petugaspengirim,t.nopol,s.nama as customer,t.kernet";
        $cJoin      = "LEFT JOIN customer s on s.Kode = t.customer";
        $dbd        = $this->select("sj_total t", $field, $where, $cJoin ,"", "t.faktur ASC", $limit) ;
        $dba        = $this->select("sj_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getDetailSJ($cFaktur){
        $cField = "s.kode, p.faktur,t.do,s.keterangan,p.qty,s.satuan, t.Tgl,t.petugaspengirim,t.nopol,t.kernet,
                    sp.nama as customer";
        $cJoin  = "LEFT JOIN stock s ON s.kode = p.stock
                   Left JOIN sj_total t on t.faktur = p.faktur
                   LEFT JOIN customer sp on sp.kode = t.customer" ;
        $cWhere = "p.faktur = '".$cFaktur."'" ;
        $dbData = $this->select("sj_detail p",$cField,$cWhere,$cJoin) ;
        return $dbData ;
    }

    public function GetDataPerFaktur($faktur){
        $data  = array() ;
        $cField = "p.faktur,t.do, t.Tgl, t.petugaspengirim,t.nopol,s.nama as customer,t.kernet";
        $cWhere = "p.faktur = '".$faktur."'" ;
        $vaJoin = "LEFT JOIN sj_total t ON t.faktur = p.faktur
                   LEFT JOIN customer s on s.kode = t.customer" ;
        $dbData = $this->select("sj_detail p",$cField,$cWhere,$vaJoin) ;
        if($dbr = $this->getrow($dbData)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getTotalSJ($dTglAwal,$dTglAkhir){
        $cField = "t.faktur, t.do, t.tgl, t.cabang,t.petugaspengirim,t.nopol,t.kernet, s.nama as customer" ;
        $cWhere = "t.tgl >= '".$dTglAwal."' AND t.tgl <= '".$dTglAkhir."'" ;
        $cJoin  = "LEFT JOIN customer s on s.Kode = t.customer" ;
        $dbData = $this->select("sj_total t",$cField,$cWhere,$cJoin);
        return $dbData ;
    }

}
