<?php

class oSyslog{
  function SaveSyslog($cMessage, $cProgram="",$cFasility="142") {
    if($cProgram == ""){
      $cProgram = "sis_php" ;
      $_c = str_replace($_SERVER["DOCUMENT_ROOT"] . "/","",$_SERVER ['SCRIPT_FILENAME']) ;
      $vaPrg = explode("/",$_c) ;
      if(isset($vaPrg [0])) $cProgram = $vaPrg [0] ;
    }
    $n = $cFasility%8 ;
    openlog($cProgram, LOG_NDELAY, LOG_LOCAL1);
    syslog($n, $cMessage);
  }
  
  function GetHostIP(){
    $cIP = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : "" ;
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
      $cIP = $_SERVER['HTTP_X_FORWARDED_FOR'] ;
    }
    return $cIP ;
  } 

  function GetSetting(){

  }
  
  function _gAgent(){  
    $cRetval = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "unknow"  ;
    return $cRetval ;
  }
  
  function SaveClickMenuLog($va){
    $_va = array("MTI"=>"03","DT"=>date("Ymdhis"),"UID"=>self::GetSetting("cSession_UserName"),"IP"=>self::GetHostIP(),"Mnu"=>$va['cMenuNumber'],"MnuTitle"=>$va['cMenuTitle'],"BR"=>self::_gAgent()) ;
    self::SaveSyslog(json_encode($_va)) ;
  }
  
  function SaveCloseForm($va){
    $_va = array("MTI"=>"08","DT"=>date("Ymdhis"),"UID"=>self::GetSetting("cSession_UserName"),"IP"=>self::GetHostIP(),"BR"=>self::_gAgent()) ;
    if(isset($va ['_MENU_'])){
      $_va ["Mnu"] = $va['_MENU_'] ;
    }
    self::SaveSyslog(json_encode($_va)) ;
  }
  
  function SaveLog_DBInsert($cTableName,$vaField){
    $_va = array("MTI"=>"04","DT"=>date("Ymdhis"),"UID"=>self::GetSetting("cSession_UserName"),"IP"=>self::GetHostIP(),"BR"=>self::_gAgent()) ;
    if(isset($_POST['_MENU_'])){
      $_va ['Mnu'] = $_POST['_MENU_'] ;
    }
    $_va ['Table'] = $cTableName ;  
    $_va ['Field'] = $vaField ;
    self::SaveSyslog(json_encode($_va)) ;
  }
  
  function SaveLog_DBEdit($cTableName,$vaField,$cMTI="05"){
    foreach($vaField as $vaRow){
      $_va = array("MTI"=>$cMTI,"DT"=>date("Ymdhis"),"UID"=>self::GetSetting("cSession_UserName"),"IP"=>self::GetHostIP(),"BR"=>self::_gAgent()) ;
      if(isset($_POST['_MENU_'])){
        $_va ['Mnu'] = $_POST['_MENU_'] ;
      }
      $_va ['Table'] = $cTableName ;  
      $_va ['Field'] = $vaRow ;
      self::SaveSyslog(json_encode($_va)) ;
    }
  }
  
  function SaveLog_Login(){
    $_va = array("MTI"=>"01","DT"=>date("Ymdhis"),"UID"=>self::GetSetting("cSession_UserName"),"IP"=>self::GetHostIP(),"BR"=>self::_gAgent()) ;
    self::SaveSyslog(json_encode($_va)) ;
  }
  
  function SaveLog_Logout(){
    $_va = array("MTI"=>"02","DT"=>date("Ymdhis"),"UID"=>self::GetSetting("cSession_UserName"),"IP"=>self::GetHostIP(),"BR"=>self::_gAgent()) ;
    self::SaveSyslog(json_encode($_va)) ;
  }
  
  function SaveLog_Message($cMessage){
    $_va = array("MTI"=>"99","DT"=>date("Ymdhis"),"UID"=>self::GetSetting("cSession_UserName"),"IP"=>self::GetHostIP(),"BR"=>self::_gAgent(),"Message"=>$cMessage) ;
    self::SaveSyslog(json_encode($_va)) ;
  }
}

?>