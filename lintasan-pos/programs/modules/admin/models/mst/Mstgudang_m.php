<?php
class Mstgudang_m extends Bismillah_Model{

   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ; 
      if($search !== "") $where[]	= "(keterangan LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "id,kode,keterangan" ; 
      $dbd      = $this->select("gudang", $f, $where, "", "", "kode ASC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("gudang", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }
      return array("db"=>$dbd, "rows"=> $row ) ;
   } 

   public function saving($va, $id){ 
      $data    = array("kode"=>$va['kode'],"keterangan"=>$va['keterangan']) ;
      $where   = "kode = " . $this->escape($va['kode']) ;
      $this->update("gudang", $data, $where, "") ;
   }

   public function getdata($kode=''){
      /*$w    = "kode = " . $this->escape($kode) ;  
      $d    = $this->getval("id,kode,keterangan", $w, "aset_golongan") ;
      return !empty($d) ? $d : false ;*/
      $where 	 = "kode = " . $this->escape($kode);
      $join     = "";
      $field    = "kode,keterangan";
      $dbd      = $this->select("gudang", $field, $where, $join, "", "kode ASC","1") ;
	  return $dbd;
   }

}
?>
