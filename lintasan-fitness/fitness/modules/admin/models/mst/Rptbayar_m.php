   <?php
class Rptbayar_m extends Bismillah_Model{

   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where    = array("pb.pelanggan = '".$va['pelanggan']."'") ;
      if($search !== "") $where[]   = "(pb.pelanggan LIKE '{$search}%' OR pb.keterangan LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;  
      $f        = "pb.*,p.nama" ;   
      $join     = "left join pelanggan p on p.kode = pb.pelanggan"  ;
      $dbd      = $this->select("pelanggan_bayar pb ", $f, $where, $join, "", "pb.tgl ASC", $limit) ;

      $row      = 0 ; 
      $dba      = $this->select("pelanggan_bayar pb", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){    
         $row   = $dbra['id'] ;
      } 

      return array("db"=>$dbd, "rows"=> $row ) ;
   }
   
}
?>
