<?php
class  Rptpenyusutanasetinv_m extends Bismillah_Model{

   public function loadgrid($va){ 
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;  
      $where = array();
      if($search !== "") $where[]   = "(a.kode LIKE '{$search}%' OR a.keterangan LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;  

      $join     = "left join aset_golongan g on g.kode = a.golongan left join cabang c on c.kode = a.cabang";
      $field    = "a.kode,a.keterangan,a.golongan,g.keterangan as ketgolongan,a.cabang, c.keterangan as ketcabang,a.lama,a.tglperolehan,a.hargaperolehan,a.unit,
                    a.jenispenyusutan,a.tarifpenyusutan,a.residu";
      $dbd      = $this->select("aset a", $field, $where, $join, "", "a.golongan asc,a.kode ASC",$limit) ;

      $row      = 0 ;
      $dba      = $this->select("aset a", "COUNT(a.id) id", $where) ;
      if($dbra  = $this->getrow($dba)){   
         $row   = $dbra['id'] ;
      } 

      return array("db"=>$dbd, "rows"=> $row ) ;
   }  
}
?>
