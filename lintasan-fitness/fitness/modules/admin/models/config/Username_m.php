<?php
class Username_m extends Bismillah_Model{
   public function loadgrid($va){
      $limit	= $va['offset'].",".$va['limit'] ; //limit
		$dbd     = $this->select("sys_username", "username, fullname", "", "", "", "username DESC", $limit) ;
      $dba     = $this->select("sys_username", "username") ;

      return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
   }
} 
?>
