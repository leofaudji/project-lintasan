<?php
/* Example print-outs using the older bit image print command */
require __DIR__ . '/../autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$connector = new WindowsPrintConnector("minipos");
$printer = new Printer($connector);

try {
	
    $tux = EscposImage::load("resources/tux.png", false);

    $printer -> bitImage($tux);
	
} catch (Exception $e) {
    /* Images not supported on your PHP, or image file not found */
    $printer -> text($e -> getMessage() . "\n");
}

// $printer -> cut();
$printer -> close();
