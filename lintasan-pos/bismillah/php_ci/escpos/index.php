<?php

/*
	require __DIR__ . '/autoload.php';
	use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
$profile = CapabilityProfile::load("simple");
$connector = new WindowsPrintConnector("smb://127.0.0.1/miniposmdt");
$printer = new Printer($connector, $profile);
$printer -> text("Hello World!!!snfkj\n");
$printer -> cut();
$printer -> close();

	*/
require __DIR__ . '/autoload.php';


use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\CapabilityProfile;
$bold1 = Chr(27) . Chr(69);
$bold0 = Chr(27) . Chr(70);
//session_start();
//if($_GET['isi'] == "session")$_GET['isi']= $_SESSION['printdm'];

$_GET['isi'] = str_replace("-sp-"," ",$_GET['isi']);
$vasis = explode("-nl-",$_GET['isi']);
try {
    // Enter the share name for your USB printer here
     $profile = CapabilityProfile::load("simple");
    $connector = new WindowsPrintConnector($_GET['portprint']);
    $printer = new Printer($connector,$profile);

    //$img = EscposImage::load("gambar/logo-print.png");
    //$printer -> graphics($img);
    //$printer -> qrCode("93039oinjono");
    //$printer -> bitImageColumnFormat($img);

    //$image = EscposImage::load("gambar/logo-print.png", false);
    //$printer -> bitImageColumnFormat($img);
    //$printer -> bitImage($image);
    $printer -> feed();
	
    foreach($vasis as $isi){
        

        $printer -> text($isi."\n");
    }

    $printer -> cut();


    $printer -> close();
} catch(Exception $e) {
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}


?>