<?php
class Rptanalisaratiokeu_m extends Bismillah_Model{
    public function seekrekening($search){
        $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%')" ;
        $dbd      = $this->select("keuangan_rekening", "*", $where, "", "", "kode ASC", '50') ;
        return array("db"=>$dbd) ;
    }
}
?>
