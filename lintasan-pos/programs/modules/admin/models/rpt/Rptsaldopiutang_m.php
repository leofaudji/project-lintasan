<?php

class Rptsaldopiutang_m extends Bismillah_Model{

    public function loadgrid($va){
        $where      = "" ;
        $field      = "s.kode,s.nama,s.alamat";
        $cJoin      = "";
        $dbd        = $this->select("customer s", $field, $where, $cJoin ,"", "s.Kode") ;
        $dba        = $this->select("customer s", "s.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }
}
