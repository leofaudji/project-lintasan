<?php

class Rptsaldostock_m extends Bismillah_Model{

    public function loadgrid($va){
        $where      = "" ;
        $field      = "s.kode,s.keterangan,s.satuan,s.stock_group";
        $cJoin      = "";
        $dbd        = $this->select("stock s", $field, $where, $cJoin ,"", "s.stock_group,s.kode") ;
        $dba        = $this->select("stock s", "s.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }
    
    public function seekcabang($search){
        $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%')" ;
        $dbd      = $this->select("cabang", "*", $where, "", "", "keterangan ASC", '50') ;
        return array("db"=>$dbd) ;
    }
}
