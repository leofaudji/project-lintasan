<?php
class Mstkreditcaraperhitungan_m extends Bismillah_Model{  
 
   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $customer = getsession($this,"customer") ; 
      $where 	 = array("customer = '$customer'") ; 
      if($search !== "") $where[]	= "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "id,kode,keterangan" ; 
      $dbd      = $this->select("kredit_cara_perhitungan", $f, $where, "", "", "kode ASC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("kredit_cara_perhitungan", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }
      return array("db"=>$dbd, "rows"=> $row ) ;
   }  
 
   public function saving($va, $id){ 
      $f    = $va ; 
      $w    = "id = " . $this->escape($id) ; 
      $f['customer'] = getsession($this,"customer") ; 
      $this->update("kredit_cara_perhitungan", $f, $w) ;
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ;   
      $d    = $this->getval("id,kode,keterangan", $w, "kredit_cara_perhitungan") ;
      return !empty($d) ? $d : false ;
   }
}
?>
