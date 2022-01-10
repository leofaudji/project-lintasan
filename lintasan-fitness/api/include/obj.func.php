<?php
 
if (!function_exists('session_is_registered')) {
  function session_is_registered($cName){
    return isset($_SESSION[$cName]) ;
  } 
}

if (!function_exists('session_register')) {
  function session_register($cName){
    $_SESSION[$cName] = "" ;
  }
}

if (!function_exists('split')){     
  function split($cSep,$cString,$nLimit=2147483647){
    //$cSep = str_replace('\','',$cSep) ; 
    return explode($cSep,$cString,$nLimit) ;
  }
} 
 
function GetSetting($cKey,$cDefault = ''){  
  $cKey = md5(session_id() . __FILE__ . strtolower($cKey)) ;
  if(!session_is_registered($cKey)){
    session_register($cKey) ;
    $_SESSION[$cKey] = $cDefault ;
  }
  return $_SESSION[$cKey] ;  
}

function SaveSetting($cKey,$cValue){
  $cKey = md5(session_id() . __FILE__ . strtolower($cKey)) ;
  if(!session_is_registered($cKey)){
    session_register($cKey) ;
  }
  $_SESSION[$cKey] = $cValue ;
}

  function snow(){  
    return date("Y-m-d H:i:s",time()) ;
  }
  
  function acfg($kode){
    global $objdb ;
    $c = "" ;
    $data = $objdb->Browse("keuangan_config","keterangan","kode = '$kode'") ; 
    if($row = $objdb->GetRow($data)){
      $c = $row['keterangan'] ;
    }
    return $c ;
  }
  
  function GetNIP($cID){
    global $objdb ;
    $cRetval = "" ;
    $dbData = $objdb->Browse("pelanggan","kode","kodefinger = '$cID'") ;
    if($dbRow = $objdb->GetRow($dbData)){
      $cRetval = $dbRow['kode'] ;
    } 
    return $cRetval ;
  }
  
  function insertAbsensi($pelanggan,$tgl,$jam,$status,$keterangan,$mode,$cabang,$pin,$datetime){
    global $objdb ;  
    $va = array("pelanggan"=>GetNIP($pelanggan),"tgl"=>$tgl,"tglabsen"=>$tgl,"jam"=>$jam,"status"=>$status,
                "keterangan"=>$keterangan,"mode"=>$mode,"cabang"=>$cabang,"pin"=>$pin,"datetime"=>$datetime) ;    
    $objdb->Insert("absensi",$va) ;         
  }

?>
