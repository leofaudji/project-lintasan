<?php

class Rptkartuhutang_m extends Bismillah_Model{

    public function loadgrid($va){
        $where      = array() ;
        $where[]    = "k.supplier = '{$va['supplier']}' and k.tgl >= '{$va['tglAwal']}' and k.tgl <= '{$va['tglAkhir']}' and k.jenis = 'H'";
        $where      = implode(" AND ", $where) ;
        $field      = "k.faktur,k.tgl,k.keterangan,k.debet,k.kredit";
        $cJoin      = "";
        $dbd        = $this->select("hutang_kartu k", $field, $where, $cJoin ,"", "k.tgl ASC,k.faktur asc") ;
        $dba        = $this->select("hutang_kartu k", "k.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getdata($kode){
        $data = array() ;
        if($d = $this->getval("*", "kode = " . $this->escape($kode), "supplier")){
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
        $dbd      = $this->select("supplier", "kode,nama,alamat", $where, "", "", "kode ASC", $limit) ;
        $dba      = $this->select("supplier", "id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

}
