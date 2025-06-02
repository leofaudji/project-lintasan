<?php
   function getbrg_jenis($i){
      $r    = "Biasa" ;
      if($i == 1) $r = "Konsiyasi" ;
      return $r ; 
   }

   function statuspelanggan($key){
     $va = array("U"=>"Umum","D"=>"Diskon Khusus","P"=>"Pelajar") ;
     return $va[$key] ;
   } 
?>
