<?php
class Rpthpproduksistock_m extends Bismillah_Model{
    public function seekstock($search){
        $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%') and jenis = 'P'" ;
        $dbd      = $this->select("stock", "*", $where, "", "", "kode ASC", '50') ;
        return array("db"=>$dbd) ;
    }
}
?>
