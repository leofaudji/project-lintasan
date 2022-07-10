<?php
defined('BASEPATH') OR exit('No direct script access allowed') ;
function dir_create($dir){
    @mkdir($dir,0777,true) ;
}

function dir_delete($dir){
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
        (is_dir($dir . "/" . $file)) ? dir_delete($dir . "/" . $file) : unlink($dir . "/" . $file);
    }
    return rmdir($dir);
}

function dir_tmp_get(){
    $cDir = sys_get_temp_dir();
    if(!is_dir($cDir)){
        mkdir($cDir,0777);
    }

    $cDir = sys_get_temp_dir()."/tmp" ;  
    $nDir = date("H")%3 ;
    $nDir1 = $nDir + 1 ;
    if($nDir1 == 3){
        $nDir1 = 0 ;
    }
    if(is_dir($cDir . $nDir1)){
        dir_delete($cDir . $nDir1);
    }
    if(!is_dir($cDir . $nDir)){
        mkdir($cDir . $nDir,0777);
    }

    return $cDir . $nDir ;
}

function file_tmp_get(){
    return dir_tmp_get() . "/" . md5(rand(0,10000) . time() . session_id()) ;
}

?>
