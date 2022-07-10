<?php
class Config_m extends Bismillah_Model{
    public function seekrekening($search){
        $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%')" ;
        $dbd      = $this->select("keuangan_rekening", "*", $where, "", "", "kode ASC", '50') ;
        return array("db"=>$dbd) ;
    }

    public function seekgudang($search){
        $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%')" ;
        $dbd      = $this->select("gudang", "*", $where, "", "", "kode ASC", '50') ;
        return array("db"=>$dbd) ;
    }

}
?>
