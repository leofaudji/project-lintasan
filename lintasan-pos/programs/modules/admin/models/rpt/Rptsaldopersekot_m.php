<?php

class Rptsaldopersekot_m extends Bismillah_Model{

    public function loadgrid($va){
        $where      = "" ;
        $field      = "s.kode,s.nama,s.alamat";
        $cJoin      = "";
        $dbd        = $this->select("supplier s", $field, $where, $cJoin ,"", "s.Kode") ;
        $dba        = $this->select("supplier s", "s.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }
}
