<?php
class Trjurnal_m extends Bismillah_Model{
   public function getfaktur($l=true){
      $k       = "JR" . date("ymd") ;  
      return $k . $this->getincrement($k, $l, 4) ; 
   }

   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $username = getsession($this,"username") ;
      $where    = array("username = '$username'") ;
      if($search !== "") $where[]   = "(rekening LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;  
      $f        = "*" ; 
      $dbd      = $this->select("keuangan_jurnal_tmp", $f, $where, "", "", "id DESC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("keuangan_jurnal_tmp", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){ 
         $row   = $dbra['id'] ;
      } 
 
      return array("db"=>$dbd, "rows"=> $row ) ; 
   }

   public function saving($va, $id){  
      $f    = $va ; 
      $w    = "id = " . $this->escape($id) ;      
      $f['tgl'] = date_2s($f['tgl']) ;
      $f['datetime'] = date_now() ;
      $f['username'] = getsession($this,"username") ;
      $this->update("keuangan_jurnal_tmp", $f, $w) ;      
   }
 
}
?>
