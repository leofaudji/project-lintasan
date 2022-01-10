<?php

class oFunc {
  public function Snow(){  
    return date("Y-m-d H:i:s",time()) ;
  }

  public function Require_File($file){
    if(is_file($file)){
      require_once($file);
    }else{
      print("File not found.") ;
    }
  }

  public function Pass_Crypt($pass){
		return sha1((md5($pass.md5($pass)) . ord('b') . ord('b') . "bismillah") ) ;
	} 

}

$Func = new oFunc ;      
?>
