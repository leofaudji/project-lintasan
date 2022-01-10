<?php

class oDB extends oFunc {
	
  static $Error = "" ;
  protected static $dbCon = null ;
	protected static $lConnect = false ;
	
  static function Connect($cIP,$cUserName,$cPassword,$cDatabase){
    self::$dbCon = mysqli_connect($cIP,$cUserName,$cPassword,$cDatabase) ;		
    if(mysqli_connect_errno()){
			self::$lConnect = false ;
      return false ;
    }
		self::$lConnect = true ;
    return true ;
  }
  
  static function GetRow($dbData){
    if(empty(self::$Error) && self::$lConnect){
      $va = mysqli_fetch_assoc($dbData) ;
      if(!empty($va) && is_array($va)){
        foreach($va as $key=>$value){
          $va [$key] = str_replace("'","\'",str_replace('"','\"',str_replace("\\","\\\\",$value))) ; 
        }
      }
      return $va ;
    }else{
      //echo(self::$Error) ; 
      //return self::$Error ;
    }
  }
  
  static function Rows($dbData){
    return mysqli_num_rows($dbData) ;
  }
  
  static function Cols($dbData){
    return mysqli_num_fields($dbData) ;
  }
  
  static function GetInsertID(){
    return mysqli_insert_id(self::$dbCon) ;
  }
  
  static function SelectDB($cDatabase){
    return mysqli_select_db(self::$dbCon,$cDatabase) ;
  }

  static function FetchArray($dbData){
    return mysqli_fetch_array($dbData) ;
  }

  static function FetchAssoc($dbData){
    return mysqli_fetch_assoc($dbData) ;
  }

  static function SQLError(){
    return mysqli_error(self::$dbCon) ;
  }

  static function NumRows($dbData){
    return mysqli_num_rows($dbData) ;
  }

  static function SQLClose(){ 
    return mysqli_close(self::$dbCon) ;
  }
  
  static function LastInsertID(){
    return mysqli_insert_id(self::$dbCon) ;        
  }

  static function AffectedRows(){
    return mysqli_affected_rows(self::$dbCon) ;        
  }

  static function SQLErrorList(){
    return mysqli_error_list(self::$dbCon) ;        
  } 
  
  
  static function SQL($cSQL){
		$dbData = mysqli_query(self::$dbCon,$cSQL) ;
    self::$Error = mysqli_error(self::$dbCon) ;
    return $dbData ;
    //self::SQLClose(); 
  }

  static function ABrowse($cTableName,$cFieldList = "*",$cWhere = "",$vaJoin = array(),$cGroupBy = "",$cOrderBy = "",$cLimit = ""){
    $dbData = self::Browse($cTableName,$cFieldList,$cWhere,$vaJoin,$cGroupBy,$cOrderBy,$cLimit) ;
    $nRow = 0 ;
    $vaArray = array(); 
    while($dbRow = self::GetRow($dbData)){
      $vaArray [++$nRow] = $dbRow ;
    }
    return $vaArray ;
  }

  static function Browse($cTableName,$cFieldList = "*",$cWhere = "",$vaJoin = array(),$cGroupBy = "",$cOrderBy = "",$cLimit = ""){
    $cTableName = strtolower($cTableName) ;
    if(trim($cWhere) <> "" && substr(strtoupper(trim($cWhere)),0,5) <> "WHERE") $cWhere = "Where $cWhere " ;
    if(trim($cGroupBy) <> "") $cGroupBy = "Group By $cGroupBy " ;
    if(trim($cOrderBy) <> "") $cOrderBy = "Order By $cOrderBy " ;
    if(trim($cLimit) <> "") $cLimit = "Limit $cLimit" ;
    $cJoin = "" ;
    if(!empty($vaJoin) && is_array($vaJoin)){
      foreach($vaJoin as $key=>$value){
        $cJoin .= $value . " " ;
      }
    }
    $cSQL = "Select $cFieldList from $cTableName $cJoin $cWhere $cGroupBy $cOrderBy $cLimit" ;
    return self::SQL($cSQL) ;
  }
  
  static function Insert($cTableName,$vaArray,$lSaveLog = true){
    $cTableName = strtolower($cTableName) ;
    $cField = "" ;
    $cValue = "" ;
    foreach($vaArray as $key=>$value){
      $cField .= $key . "," ;
      $cValue .= $value . "','" ;
      if(substr($value,0,1) == "&"){
        $cValue = str_replace("'" . $value . "'",substr($value,1),$cValue) ;
      }
    }
    $cField = "(" . substr($cField,0,strlen($cField)-1) . ")" ;
    $cValue = "('" . substr($cValue,0,strlen($cValue)-2) . ")" ;
    $cSQL = "INSERT INTO $cTableName $cField VALUES $cValue" ;
    self::SQL($cSQL) ;
    
    //if($lSaveLog) SysLog::InsertDB($cTableName,$vaArray) ;
    return empty(self::$Error) ;    
  }
  
  static function Edit($cTableName,$vaArray,$cWhere = "",$lSaveLog = true){
    $cTableName = strtolower($cTableName) ;
    
    if($lSaveLog){
      $dbCount = self::Browse($cTableName,"count(*) as Jumlah",$cWhere) ;
      $nJumlah = 0 ;
      if($dbRow = self::GetRow($dbCount)){
        $nJumlah = $dbRow ['Jumlah'] ;      
      }
      // Simpan Old Value
      if($nJumlah > 0 && $nJumlah <= 20){
        $vaRow = self::ABrowse($cTableName,"*",$cWhere) ;
        //SysLog::EditDB($cTableName,$vaRow,"05") ;
      }
    }

    $cSQL = "" ;
    foreach($vaArray as $key=>$value){
      if(substr($value,0,1) == "&"){
        $value = substr($value,1) ;
      }else{
        $value = "'$value'" ;
      }
      $cSQL .= "$key = $value," ;
    }
    $cSQL = substr($cSQL,0,strlen($cSQL)-1) ;
    
    if($cWhere <> "") $cWhere = "WHERE $cWhere" ;
    $cSQL = "UPDATE $cTableName SET $cSQL $cWhere" ;
    self::SQL($cSQL) ;

    if($lSaveLog){
      // Simpan New Value
      if($nJumlah > 0 && $nJumlah <= 20){
        $vaRow = self::ABrowse($cTableName,"*",$cWhere) ;
        //SysLog::EditDB($cTableName,$vaRow,"06") ;
      }
    }

    return empty(self::$Error) ;
  }
  
  static function Update($cTableName,$vaArray,$cWhere = "",$lSaveLog = true){
    $cTableName = strtolower($cTableName) ;
    $cWhere = trim($cWhere) ;
    $lNew = true ;
    if($cWhere !== ""){
      $dbData = self::Browse($cTableName,"*",$cWhere,"","","","0,1") ;
      if(self::Rows($dbData) > 0){
        $lNew = false ;
      }
    }
    if($lNew){
      self::Insert($cTableName,$vaArray,$lSaveLog) ;
    }else{
      self::Edit($cTableName,$vaArray,$cWhere,$lSaveLog) ;
    }
    return empty(self::$Error) ;
  }

  static function Delete($cTableName,$cWhere = "",$lSaveLog = true){
    $cTableName = strtolower($cTableName) ;
    
    if($lSaveLog){
      // Check Record Untuk Simpan di Log
      $dbCount = self::Browse($cTableName,"count(*) as Jumlah",$cWhere) ;
      $nJumlah = 0 ;
      if($dbRow = self::GetRow($dbCount)){
        $nJumlah = $dbRow ['Jumlah'] ;
      
        if($dbRow ['Jumlah'] > 0 && $dbRow ['Jumlah'] <= 20){
          $vaRow = self::ABrowse($cTableName,"*",$cWhere) ;
          //SysLog::EditDB($cTableName,$vaRow,"07") ;
        }
      }
    }
    
    if(trim($cWhere) <> "") $cWhere = "WHERE $cWhere" ;
    $cSQL = "DELETE FROM $cTableName $cWhere" ;
    self::SQL($cSQL) ;
    return empty(self::$Error) ;
  }
}

  $DB = new oDB ;
  $host = 'localhost'; 
  //$user = 'Assist';
  //$pass = 'Irac'; 
  $user = 'faudji';
  $pass = '12345'; 
  $db = 'lintasan_koprasi';
  $DB::Connect($host,$user,$pass,$db) ; 
  date_default_timezone_set("Asia/Jakarta");
?>
