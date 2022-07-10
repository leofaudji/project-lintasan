<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

// IMPORTANT - Replace the following line with your path to the escpos-php autoload script
require_once BISMILLAH_APP_LOC ."escpos/autoload.php";
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\CapabilityProfile;

class escpos {
  private $CI;
  private $connector;
  private $printer;
  // TODO: printer settings
  // Make this configurable by printer (32 or 48 probably)
  private $printer_width = 48;
  function __construct(){
    $this->CI =& get_instance(); // This allows you to call models or other CI objects with $this->CI->... 
  }
  function connect($ipaddress,$type="Windows"){

    if($type == "Ubuntu"){
        $connector = new FilePrintConnector($ipaddress);
        $printer = new Printer($connector);
    }else{//maka windows

        $this->connector = new WindowsPrintConnector($ipaddress);//new NetworkPrintConnector($ip_address, $port);
        $this->printer = new Printer($this->connector);

    }
  }
  public function check_connection(){
    if (!$this->connector OR !$this->printer OR !is_a($this->printer, 'Mike42\Escpos\Printer')) {
      throw new Exception("Tried to create receipt without being connected to a printer.");
    }
  }
  public function close_after_exception(){
    if (isset($this->printer) && is_a($this->printer, 'Mike42\Escpos\Printer')) {
      $this->printer->close();
    }
    $this->connector = null;
    $this->printer = null;
    $this->emc_printer = null;
  }
  // Calls printer->text and adds new line

  public function setlebarkertas($lebar){
      $this->printer_width = $lebar;
  }
  public function teks($text = "", $should_wordwrap = true){
    $text = $should_wordwrap ? wordwrap($text, $this->printer_width) : $text;
    $this->printer->text($text."\n");
  }

  public function cetak($lcashdraaweropen = false){
      $this->check_connection();
      if($lcashdraaweropen)$this->printer->pulse();
       $this->printer->setDoubleStrike(true);
      $this->printer->cut(Printer::CUT_PARTIAL,5);
      $this->printer->close();

  }
    
  public function opencashdraweronly(){
      $this->check_connection();
      $this->printer->pulse();
      $this->printer->close();
  }
  public function posisiteks($posisi){
      if(strtolower($posisi) == "center"){
          $this->printer->setJustification(Printer::JUSTIFY_CENTER);
      }else if(strtolower($posisi) == "right"){
          $this->printer->setJustification(Printer::JUSTIFY_RIGHT);
      }else if(strtolower($posisi) == "left"){
          $this->printer->setJustification(Printer::JUSTIFY_LEFT);
      }

  }
  public function testing($text = ""){
    $this->check_connection();
    $this->printer->setJustification(Printer::JUSTIFY_CENTER);
    $this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $this->teks("TESTING");
    $this->teks("Receipt Print");
    $this->printer->selectPrintMode();
    $this->teks(); // blank line
    $this->teks($text);
    $this->teks(); // blank line
    $this->teks(date('Y-m-d H:i:s'));
    $this->printer->cut(Printer::CUT_PARTIAL);
    $this->printer->close();
  }
}
?>