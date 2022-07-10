<?php

class Rptpelunasanhutang_m extends Bismillah_Model{

    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%' or s.nama = '%{$search}%'" ;
        $where[] = "t.status = '1' and t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "t.faktur,t.tgl,s.nama as supplier,t.subtotal,t.diskon,t.pembulatan,t.kasbank,t.pembelian,
                    t.retur,b.keterangan as ketrekkasbank,t.persekot";
        $join     = "left join supplier s on s.Kode = t.supplier left join bank b on b.kode = t.rekkasbank";
        $dbd      = $this->select("hutang_pelunasan_total t", $field, $where, $join, "", "t. faktur ASC", $limit) ;
        $dba      = $this->select("hutang_pelunasan_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getDetail($cFaktur){
        $cField = "p.fkt,p.jumlah,p.jenis";
        $cJoin  = "" ;
        $cWhere = "p.faktur = '".$cFaktur."'" ;
        $dbData = $this->select("hutang_pelunasan_detail p",$cField,$cWhere,$cJoin) ;
        return $dbData ;
    }

    public function getdetailpelunasanhutang($cFaktur){
        $cField = "p.fkt,p.jumlah,p.jenis";
        $cJoin  = "" ;
        $cWhere = "p.faktur = '".$cFaktur."'" ;
        $dbData = $this->select("hutang_pelunasan_detail p",$cField,$cWhere,$cJoin) ;
        return $dbData ;
    }

    public function GetDataPerFaktur($faktur){
        $data  = array() ;
        $field = "t.faktur,t.tgl,t.supplier,s.nama as namasupplier,t.pembelian,t.retur,t.subtotal,t.kasbank,t.rekkasbank,
                    b.keterangan as ketrekkasbank,t.diskon,t.pembulatan,t.persekot";
        $where = "t.faktur = '$faktur'";
        $join  = "left join supplier s on s.kode = t.supplier left join bank b on b.kode = t.rekkasbank";
        $dbd   = $this->select("hutang_pelunasan_total t", $field, $where, $join) ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getTotalpelunasanhutang($tglawal,$tglakhir){
        $field = "t.faktur,t.tgl,t.supplier,s.nama as namasupplier,t.pembelian,t.retur,t.subtotal,t.kasbank,t.rekkasbank,
                    b.keterangan as ketrekkasbank,t.diskon,t.pembulatan,t.persekot";
        $where = "t.tgl >= '".$tglawal."' AND t.tgl <= '".$tglakhir."' and status = '1'" ;
        $join  = "left join supplier s on s.kode = t.supplier left join bank b on b.kode = t.rekkasbank";
        $dbd   = $this->select("hutang_pelunasan_total t", $field, $where, $join) ;
        return $dbd ;
    }

}
