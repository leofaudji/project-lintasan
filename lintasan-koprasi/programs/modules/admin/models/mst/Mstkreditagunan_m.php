<?php
class Mstkreditagunan_m extends Bismillah_Model{  
 
   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $customer = getsession($this, "customer")  ;
      $where 	 = array("customer = '$customer'") ; 
      if($search !== "") $where[]	= "(keterangan LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "id,kode,keterangan,data_kategori" ; 
      $dbd      = $this->select("mst_jenis_agunan", $f, $where, "", "", "kode ASC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("mst_jenis_agunan", "COUNT(id) id", $where) ; 
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }   
      return array("db"=>$dbd, "rows"=> $row ) ; 
   }  

   public function saving($va, $id){ 
      $f    = $va ; 
      $f['customer'] = getsession($this, "customer")  ;
      $w    = "id = " . $this->escape($id) ; 
      $this->update("mst_jenis_agunan", $f, $w) ;
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ;  
      $d    = $this->getval("id,kode,keterangan,data_kategori", $w, "mst_jenis_agunan") ;
      return !empty($d) ? $d : false ;
   }
}
?>
