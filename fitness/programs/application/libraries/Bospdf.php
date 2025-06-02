<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');
require BISMILLAH_APP_LOC ."excel/PHPExcel.php";
require BISMILLAH_APP_LOC ."pdf/class.ezpdf.php";
 
class bospdf extends Cezpdf{
   public function __construct($o=array()){
      $od    = array('paper'=>'LETTER', 'orientation'=>'portrait','export'=>0 ,'opt'=>array(), 'lpagenumber'=>FALSE) ;
      $op    = array_merge($od, $o) ;
      if(isset($op['opt']['export_name'])) $op['opt']['export_name'] .= "_" . date("dmyH") ;
      parent::__construct($op['paper'],$op['orientation'],$op['export'],$op['opt'],$op['lpagenumber']) ;
   }
}
?>
