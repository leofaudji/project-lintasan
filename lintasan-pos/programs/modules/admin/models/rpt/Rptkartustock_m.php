<?php

class Rptkartustock_m extends Bismillah_Model{

    public function loadgrid($va){
        $where      = array() ;
        $where[]    = "k.stock = '{$va['stock']}' and k.tgl >= '{$va['tglAwal']}' and k.tgl <= '{$va['tglAkhir']}'";
        $where      = implode(" AND ", $where) ;
        $field      = "k.faktur,k.tgl,k.keterangan,k.debet,k.kredit,k.hp";
        $cJoin      = "";
        $dbd        = $this->select("stock_kartu k", $field, $where, $cJoin ,"", "k.tgl ASC,k.id asc") ;
        $dba        = $this->select("stock_kartu k", "k.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }
    
    public function getdata($kode){
        $data = array() ;
        if($d = $this->getval("*", "kode = " . $this->escape($kode), "stock")){
            $data = $d;
        }
        return $data ;
    }
    
    public function loadgrid2($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;

        $where 	 = implode(" AND ", $where) ;
        $dbd      = $this->select("stock", "kode,keterangan,satuan", $where, "", "", "kode ASC", $limit) ;
        $dba      = $this->select("stock", "id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

}
