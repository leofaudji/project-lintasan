<?php
class Rptlr_m extends Bismillah_Model{
   public function loadrekening($rekawal,$rekakhir){
        $where = array();
        $where[]	= "kode >= '$rekawal' and kode <= '$rekakhir'" ;
        $where 	 = implode(" AND ", $where) ;
        $field = "kode,keterangan,jenis";
        $join = "";
        $dbd      = $this->select("keuangan_rekening", $field, $where, $join, "", "kode ASC") ;
        return $dbd ;
   }
}
?>
