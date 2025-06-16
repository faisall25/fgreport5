<?php
/* Change to the correct path if you copy this example! */
require __DIR__ . '../vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/**
 * Install the printer using USB printing support, and the "Generic / Text Only" driver,
 * then share it (you can use a firewall so that it can only be seen locally).
 *
 * Use a WindowsPrintConnector with the share name to print.
 *
 * Troubleshooting: Fire up a command prompt, and ensure that (if your printer is shared as
 * "Receipt Printer), the following commands work:
 *
 *  echo "Hello World" > testfile
 *  copy testfile "\\%COMPUTERNAME%\Receipt Printer"
 *  del testfile
 */
try {
    // Enter the share name for your USB printer here
    // $connector = null;
    $connector = new WindowsPrintConnector("POS-58");

    /* Print a "Hello world" receipt" */
    $printer = new Printer($connector);

    $printer->setJustification(Printer::JUSTIFY_CENTER);
    // title($printer, "QR code demo\n");
    // $printer -> setLineSpacing(3);
    $printer->setEmphasis(true); // Aktifkan bold
    $printer->feed(1);
    $printer->text("PT INDOFOOD FORTUNA MAKMUR");
    $printer->feed(1);
    $printer->text("PLANT 1403");
    $printer->setEmphasis(false);
    $printer->feed(2);
    $printer->setJustification();
    $printer->text("Line     : PC 32");
    $printer->feed(1);
    $printer->text("Produk   : BEB 15gr");
    $printer->feed(1);
    $printer->text("Jumlah   : 40    No. Pallet: 14");
    $printer->feed(1);
    $printer->text("Waktu    : 2025-5-15 18:52:26");
    $printer->feed(2);
    $printer->setJustification(Printer::JUSTIFY_CENTER);

    // $testStr = "
    // PT INDOFOOD FORTUNA MAKMUR\n
    // PLANT 1403\n
    // Line     : PC 32\n
    // Produk   : BEB 15gr\n
    // Jumlah   : 40 karton\n
    // No. Pallet: 14\n
    // Waktu    : 2025-5-15 18:52:26";
    // $printer->qrCode($testStr);

    $printer->setTextSize(2, 1);
    $printer->text("No. Pallet:");
    $printer->feed(1);
    $printer->setTextSize(4, 5);
    $printer->text("14");
    $printer->setTextSize(1, 1);
    $printer->feed(2);
    $printer->setJustification();
    $printer->text("Mengetahui,");
    $printer->feed(1);
    $printer->text("NUR SAFITRI        ARI W.");
    $printer->feed(3);
    $printer->text("(Stock FG)        (Kassie)");
    $printer->feed(1);

    $printer->cut();

    /* Close printer */
    $printer->close();
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
}
