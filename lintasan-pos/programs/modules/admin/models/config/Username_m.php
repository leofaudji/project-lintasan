<?php
class Username_m extends Bismillah_Model{
   public function loadgrid($va){
      $limit	= $va['offset'].",".$va['limit'] ; //limit
		$dbd     = $this->select("sys_username", "username, fullname", "", "", "", "username DESC", $limit) ;
      $dba     = $this->select("sys_username", "username") ;

      return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
   }

    
    public function seeklevel($search){
        $where = "(code LIKE '%{$search}%' OR name LIKE '%{$search}%')" ;
        $dbd      = $this->select("sys_username_level", "code as kode, name as keterangan", $where, "", "", "name ASC", '50') ;
        return array("db"=>$dbd) ;
    }
    
    public function seekrekening($search){
        $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%') and jenis = 'D'" ;
        $dbd      = $this->select("keuangan_rekening", "*", $where, "", "", "keterangan ASC", '50') ;
        return array("db"=>$dbd) ;
    }
    
    public function seekgudang($search){
        $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%')" ;
        $dbd      = $this->select("gudang", "*", $where, "", "", "keterangan ASC", '50') ;
        return array("db"=>$dbd) ;
    }
}
?>
