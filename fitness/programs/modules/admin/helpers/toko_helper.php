<?php
   function getbrg_jenis($i){
      $r    = "Biasa" ;
      if($i == 1) $r = "Konsiyasi" ;
      return $r ; 
   }

   function statuspelanggan($key){
     $va = array("IU"=>"Umum","ID"=>"Khusus Diskon","IP"=>"Pelajar","MH"=>"Member Harian",
                 "MB"=>"Member Bulanan","KF"=>"Kry. Fitness","KC"=>"Kry. Cathering","MD"=>"Member 2 Mingguan") ;
     return $va[$key] ;
   } 
?>
