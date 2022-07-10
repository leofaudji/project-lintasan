<?php
require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
try {
	// Enter the share name for your USB printer here
	$connector = new WindowsPrintConnector("smb://User:Guest@192.168.0.11/POS-80C");
    //$connector = new NetworkPrintConnector("192.168.0.11","POS-80C");
	$printer = new Printer($connector);

	/* Print some bold text */
	$printer -> setEmphasis(true);
	$printer -> text("FOO CORP Ltd.\n");
	$printer -> setEmphasis(false);
	$printer -> feed();
	$printer -> text("Receipt for whatever\n");
	$printer -> feed(4);

	/* Bar-code at the end */
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer -> barcode("987654321");
	
	/* Close printer */
	$printer -> close();
} catch(Exception $e) {
	echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}