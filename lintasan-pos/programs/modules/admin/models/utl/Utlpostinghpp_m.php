<?php
class  Utlpostinghpp_m extends Bismillah_Model{

    public function seekcabang($search){
        $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%')" ;
        $dbd      = $this->select("cabang", "*", $where, "", "", "keterangan ASC", '50') ;
        return array("db"=>$dbd) ;
    }


    public function postinghpp($va){
        $tgl = date_2s($va['tgl']);
        $vaGrid = json_decode($va['grid2']);
        //$this->delete("jurnal", "faktur = '{$va['faktur']}'" ) ;
    }

    public function loadgrid($va){
        $where = array();
        $where 	 = implode(" AND ", $where) ;
        $join    = "left join stock_group g on g.kode = s.stock_group";
        $f       = "s.kode,s.keterangan,s.satuan,s.stock_group,g.keterangan as ketgroup" ; 
        $dbd     = $this->select("stock s", $f, $where, $join, "", "s.stock_group ASC") ;

        $row     = 0 ;
        $dba     = $this->select("stock s", "COUNT(s.id) id", $where) ;
        if($dbra = $this->getrow($dba)){
            $row = $dbra['id'] ;
        }
        return array("db"=>$dbd, "rows"=> $row ) ;

    }
    
    public function loadgridgol($va){

        $where 	 = "s.stock_group = '{$va['kode']}'" ;
        $join    = "left join stock_group g on g.kode = s.stock_group";
        $f       = "s.kode,s.keterangan,s.satuan,s.stock_group,g.keterangan as ketgroup" ; 
        $dbd     = $this->select("stock s", $f, $where, $join, "", "s.stock_group ASC") ;

        $row     = 0 ;
        $dba     = $this->select("stock s", "COUNT(s.id) id", $where) ;
        if($dbra = $this->getrow($dba)){
            $row = $dbra['id'] ;
        }
        return array("db"=>$dbd, "rows"=> $row ) ;

    }
}
?>