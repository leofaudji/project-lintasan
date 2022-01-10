<?php
  $vaPath = pathinfo(__FILE__) ;
  require_once './include/obj.php' ;

  global $objdb ;
  $cRequest = empty($_POST['cCode']) ? "" : $_POST['cCode'];
  
  $vaResponse = array("MTI"=>"000","MSG"=>"Request kosong");
  $respon = "kosong" ;
  if($cRequest != ""){
    $cRequest = $cRequest;
    $vaResponse = array("MTI"=>"998","MSG"=>"Request salah!");   
    $vaRequest = json_decode($cRequest,true);
    if(isset($vaRequest)){  
      $vaValue = json_decode($cRequest,true);
      unset($vaValue['MTI']) ;
      switch($vaRequest['MTI']){  
       case "00" :         
          $vaResponse  = $vaValue ; //$vaRequest ;
          insertAbsensi($vaResponse['pelanggan'],$vaResponse['tgl'],$vaResponse['jam'],$vaResponse['status'],
                        $vaResponse['keterangan'],$vaResponse['mode'],$vaResponse['cabang'],$vaResponse['pin'],
                        $vaResponse['datetime']) ;   
          $respon = "sukses <br>" ;              
       break;   
       default :
          $vaResponse = array("MTI"=>"999","MSG"=>"MTI tidak sesuai");
          $respon = "gagal" ;
       break;
      }
    }     
  }
  echo $respon ;  