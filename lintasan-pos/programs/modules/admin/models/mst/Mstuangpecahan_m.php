<?php
class Mstuangpecahan_m extends Bismillah_Model{

   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ; 
      if($search !== "") $where[]	= "(u.pecahan LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $join = "";
      $f        = "u.kode,u.pecahan,u.jenis" ; 
      $dbd      = $this->select("uang_pecahan u", $f, $where, $join, "", "u.jenis,u.pecahan ASC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("uang_pecahan u", "COUNT(u.id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }
      return array("db"=>$dbd, "rows"=> $row ) ;
   } 

   public function saving($va, $id){ 
      $data    = array("kode"=>$va['kode'],"pecahan"=>string_2n($va['pecahan']),"jenis"=>$va['jenis']) ;
      $where   = "kode = " . $this->escape($va['kode']) ;
      $this->update("uang_pecahan", $data, $where, "") ;
   }

   public function getdata($kode=''){
      $where 	 = "u.kode = " . $this->escape($kode);
      $join     = "";
      $field    = "u.kode,u.pecahan,u. jenis";
      $dbd      = $this->select("uang_pecahan u", $field, $where, $join, "", "u.jenis,u.pecahan ASC","1") ;
	  return $dbd;
   }
}
?>
