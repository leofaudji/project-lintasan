<?php
class Mstgroupstock_m extends Bismillah_Model{

   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ; 
      if($search !== "") $where[]	= "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $dbd      = $this->select("stock_group", "*", $where, "", "", "kode ASC", $limit) ;
      $dba      = $this->select("stock_group", "id", $where) ;

      return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
   }

   public function saving($kode, $va){
      if(!isset($va['rekpj'])) $va['rekpj'] = "";
      if(!isset($va['rekhpp'])) $va['rekhpp'] = "";
      if(!isset($va['rekpersd'])) $va['rekpersd'] = "";

      $data    = array("kode"=>$va['kode'], "keterangan"=>$va['keterangan'],"rekpersd"=>$va['rekpersd'],"rekpj"=>$va['rekpj'],
                       "rekhpp"=>$va['rekhpp'],"username"=> getsession($this, "username")) ;
      $where   = "kode = " . $this->escape($kode) ;
      $this->update("stock_group", $data, $where, "") ;
   }

   public function getdata($kode){
      $data = array() ;
		if($d = $this->getval("*", "kode = " . $this->escape($kode), "stock_group")){
         $data = $d;
		}
		return $data ;
   }

   public function deleting($kode){
      $this->delete("stock_group", "kode = " . $this->escape($kode)) ;
   }
    
   public function seekrekbypeny($search){
      $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%') and Jenis = 'D'" ;
      $dbd      = $this->select("keuangan_rekening", "*", $where, "", "", "keterangan ASC", '50') ;
      return array("db"=>$dbd) ;
   }

}
?>
