<?php

class Rptmarginpenjualanproduk_m extends Bismillah_Model{

    public function loadgrid($va){
        $where      = "s.jenis = 'P'" ;
        $field      = "s.kode,s.keterangan,s.satuan,s.stock_group";
        $cJoin      = "";
        $dbd        = $this->select("stock s", $field, $where, $cJoin ,"", "s.kode") ;
        $dba        = $this->select("stock s", "s.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }
    
}
