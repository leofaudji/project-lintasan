<?php
class Trcetakbarcode_m extends Bismillah_Model{


    public function loadgrid3($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        //$where[]	= "jenis = 'P'" ;
        if($search !== "") $where[]	= "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;
        $where 	 = implode(" AND ", $where) ;
        $dbd      = $this->select("stock", "kode,keterangan,satuan", $where, "", "", "kode ASC", $limit) ;
        $dba      = $this->select("stock", "id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getdata($kode){
        $data = array() ;
        if($d = $this->getval("*", "kode = " . $this->escape($kode) ." or barcode = ". $this->escape($kode), "stock")){
            $arrhj = $this->perhitungan_m->gethjstock($d['kode'],1);
            $d['hargajual'] = $arrhj['hargajual'];
            $data = $d;
        }
        return $data ;
    }
}
?>
