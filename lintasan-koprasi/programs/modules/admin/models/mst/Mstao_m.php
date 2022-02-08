<?php
class Mstao_m extends Bismillah_Model{  
 
   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $id_kantor = getsession($this, "id_kantor")  ;
      $where 	 = array("id_kantor = '$id_kantor'") ; 
      if($search !== "") $where[]	= "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "id,id_kantor,kode,keterangan" ; 
      $dbd      = $this->select("mst_ao", $f, $where, "", "", "kode ASC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("mst_ao", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }   
      return array("db"=>$dbd, "rows"=> $row ) ;
   }  

   public function saving($va, $id){ 
      $f    = $va ; 
      $id_kantor = getsession($this, "id_kantor")  ;
      $f['id_kantor'] = $id_kantor ; 
      $w    = "id = " . $this->escape($id) ; 
      $this->update("mst_ao", $f, $w) ;
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ;  
      $d    = $this->getval("id,kode,keterangan", $w, "mst_ao") ;
      return !empty($d) ? $d : false ;
   }
}
?>
