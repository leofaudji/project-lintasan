<?php

class Rptindexpenjualanstock_m extends Bismillah_Model{

    public function loadgrid($va){
        $where      = "" ;
        $field      = "s.id,s.kode,s.keterangan,s.satuan,s.stock_group,ifnull(sum(k.kredit),0) as qtypj";
        $cJoin      = "left join stock_kartu k on k.stock = s.kode and k.tgl >='{$va['tglawal']}' 
                        and k.tgl <='{$va['tglakhir']}' and faktur like 'CS%'";
        $dbd        = $this->select("stock s", $field, $where, $cJoin ,"s.id", "s.stock_group,s.kode") ;
        $dba        = $this->select("stock s", "s.id", $where,$cJoin) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }
    
    public function seeksupplier($search){
        $where = "(kode LIKE '%{$search}%' OR nama LIKE '%{$search}%')" ;
        $dbd      = $this->select("supplier", "*", $where, "", "", "nama ASC", '50') ;
        return array("db"=>$dbd) ;
    }
}
