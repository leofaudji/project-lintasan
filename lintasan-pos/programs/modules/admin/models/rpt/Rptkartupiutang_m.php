<?php

class Rptkartupiutang_m extends Bismillah_Model{

    public function loadgrid($va){
        $where      = array() ;
        $where[]    = "k.customer = '{$va['customer']}' and k.tgl >= '{$va['tglAwal']}' and k.tgl <= '{$va['tglAkhir']}' and k.jenis = 'P'";
        $where      = implode(" AND ", $where) ;
        $field      = "k.faktur,k.tgl,k.keterangan,k.debet,k.kredit";
        $cJoin      = "";
        $dbd        = $this->select("piutang_kartu k", $field, $where, $cJoin ,"", "k.tgl ASC,k.faktur asc") ;
        $dba        = $this->select("piutang_kartu k", "k.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getdata($kode){
        $data = array() ;
        if($d = $this->getval("*", "kode = " . $this->escape($kode), "customer")){
            $data = $d;
        }
        return $data ;
    }

    public function loadgrid2($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "(kode LIKE '{$search}%' OR nama LIKE '%{$search}%')" ;

        $where 	 = implode(" AND ", $where) ;
        $dbd      = $this->select("customer", "kode,nama,alamat", $where, "", "", "kode ASC", $limit) ;
        $dba      = $this->select("customer", "id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

}
