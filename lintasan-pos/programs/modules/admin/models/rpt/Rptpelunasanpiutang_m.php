<?php

class Rptpelunasanpiutang_m extends Bismillah_Model{

    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%' or s.nama = '%{$search}%'" ;
        $where[] = "t.status = '1' and t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "t.faktur,t.tgl,s.nama as customer,t.subtotal,t.diskon,t.pembulatan,t.penjualan,t.kasbank,t.retur,
                    b.keterangan as ketrekkasbank,t.uangmuka";
        $join     = "left join customer s on s.kode = t.customer  left join bank b on b.kode = t.rekkasbank";
        $dbd      = $this->select("piutang_pelunasan_total t", $field, $where, $join, "", "t. faktur ASC", $limit) ;
        $dba      = $this->select("piutang_pelunasan_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getDetail($cFaktur){
        $cField = "p.fkt,p.jumlah,p.jenis";
        $cJoin  = "" ;
        $cWhere = "p.faktur = '".$cFaktur."'" ;
        $dbData = $this->select("piutang_pelunasan_detail p",$cField,$cWhere,$cJoin) ;
        return $dbData ;
    }

    public function getdetailpelunasanpiutang($cFaktur){
        $cField = "p.fkt,p.jumlah,p.jenis";
        $cJoin  = "" ;
        $cWhere = "p.faktur = '".$cFaktur."'" ;
        $dbData = $this->select("piutang_pelunasan_detail p",$cField,$cWhere,$cJoin) ;
        return $dbData ;
    }

    public function GetDataPerFaktur($faktur){
        $data  = array() ;
        $field = "t.faktur,t.tgl,t.customer,s.nama as namacustomer,t.penjualan,t.retur,t.subtotal,t.kasbank,t.rekkasbank,
                    b.keterangan as ketrekkasbank,t.diskon,t.pembulatan,t.uangmuka";
        $where = "t.faktur = '$faktur'";
        $join  = "left join customer s on s.kode = t.customer left join bank b on b.kode = t.rekkasbank";
        $dbd   = $this->select("piutang_pelunasan_total t", $field, $where, $join) ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getTotalpelunasanpiutang($tglawal,$tglakhir){
        $field = "t.faktur,t.tgl,t.customer,s.nama as namacustomer,t.penjualan,t.retur,t.subtotal,t.kasbank,t.rekkasbank,
                    b.keterangan as ketrekkasbank,t.diskon,t.pembulatan,t.uangmuka";
        $where = "t.tgl >= '".$tglawal."' AND tgl <= '".$tglakhir."' and status = '1'" ;
        $join  = "left join customer s on s.kode = t.customer left join bank b on b.kode = t.rekkasbank";
        $dbd   = $this->select("piutang_pelunasan_total t", $field, $where, $join) ;
        return $dbd ;
    }

}
