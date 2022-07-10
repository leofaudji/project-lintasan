<?php
class Mstbankkas_m extends Bismillah_Model{

   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ; 
      if($search !== "") $where[]	= "(b.keterangan LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $join = "left join keuangan_rekening r on r.kode = b.rekening";
      $f        = "b.id,b.kode,b.keterangan,b.rekening,r.keterangan as ketrekening" ; 
      $dbd      = $this->select("bank b", $f, $where, $join, "", "b.kode ASC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("bank b", "COUNT(b.id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }
      return array("db"=>$dbd, "rows"=> $row ) ;
   } 

   public function saving($va, $id){ 
      $data    = array("kode"=>$va['kode'],"keterangan"=>$va['keterangan'],"rekening"=>$va['rekening']) ;
      $where   = "kode = " . $this->escape($va['kode']) ;
      $this->update("bank", $data, $where, "") ;
   }

   public function getdata($kode=''){
      $where 	 = "b.kode = " . $this->escape($kode);
      $join     = "left join keuangan_rekening r on r.kode = b.rekening";
      $field    = "b.id,b.kode,b.keterangan,b.rekening,r.keterangan as ketrekening";
      $dbd      = $this->select("bank b", $field, $where, $join, "", "b.kode ASC","1") ;
	  return $dbd;
   }

   public function seekrekening($search){
      $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%') and Jenis = 'D'" ;
      $dbd      = $this->select("keuangan_rekening", "*", $where, "", "", "keterangan ASC", '50') ;
      return array("db"=>$dbd) ;
   }
}
?>
