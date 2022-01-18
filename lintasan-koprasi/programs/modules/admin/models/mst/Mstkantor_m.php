<?php
class Mstkantor_m extends Bismillah_Model{  
 
   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ; 
      if($search !== "") $where[]	= "(keterangan LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "*" ; 
      $dbd      = $this->select("mst_kantor", $f, $where, "", "", "kode ASC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("mst_kantor", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }   
      return array("db"=>$dbd, "rows"=> $row ) ;
   }  

   public function saving($va, $id){ 
      $f    = $va ;  
      $w    = "id = " . $this->escape($id) ; 
      $this->update("mst_kantor", $f, $w) ;
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ;  
      $d    = $this->getval("id,kode,keterangan,alamat,telepon", $w, "mst_kantor") ;
      return !empty($d) ? $d : false ;
   }
}
?>
