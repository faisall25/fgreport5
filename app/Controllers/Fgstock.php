<?php

namespace App\Controllers;

use App\Models\AllDataModel;
use App\Models\LineModel;
use App\Models\SettTargetModel;
use App\Models\SkuModel;
use App\Models\TmpIdentitasModel;
use DateTime;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class Fgstock extends BaseController
{
    public function valPc()
    {
        return view('pages/valpc');
    }
    public function tmpIdentitas()
    {
        return view('pages/tmpidentitas');
    }

    public function tambahFg()
    {
        $targetModel = new SettTargetModel();

        $line = $targetModel->select('id_line, nama_line')
            ->distinct()
            ->findAll();
        $sku = $targetModel->select('id_sku, nama_sku, id_line')
            ->findAll();
        $data = [
            'title' => 'FG - Add Hasil',
            'sku' => $sku,
            'line' => $line
        ];
        return view('pages/tambahfg', $data);
    }

    public function allData()
    {
        $targetModel = new SettTargetModel();

        $line = $targetModel->select('id_line, nama_line')
            ->distinct()
            ->findAll();
        $sku = $targetModel->select('id_sku, nama_sku, id_line')
            ->findAll();
        $alldataModel = new AllDataModel();
        $alldata = $alldataModel->findAll();

        $data = [
            'title' => 'FG - All Data',
            'sku' => $sku,
            'line' => $line,
            'alldata' => $alldata,
        ];
        return view('pages/alldata', $data);
    }

    public function tmpHasil($tableName)
    {
        if (!preg_match('/^\d+$/', $tableName)) {
            throw new \Exception("Nama tabel tidak valid.");
        }
        // echo "halo, $id";
        $targetModel = new SettTargetModel();
        $skuModel = new SkuModel();
        $tmpIdentitasModel = new TmpIdentitasModel();

        $line = $targetModel->select('id_line, nama_line')
            ->distinct()
            ->findAll();
        $sku = $targetModel->select('id_sku, nama_sku, id_line')
            ->findAll();

        $identitas = $skuModel->where('id_sku', $tableName)->select('nama_sku')->first();
        // d($identitas['nama_sku']);

        // $tmphasilModel = new GetTmpHasilModel();
        // $tmphasilModel->setTableName($tableName);
        // $hasil = $tmphasilModel->findAll();
        // d($hasil);

        $db = \Config\Database::connect();
        $hasil = $db->query('SELECT * FROM "' . $tableName . '"')->getResultArray();
        // d($hasil);
        $lastTmpIdentitas = $tmpIdentitasModel->orderBy('id', 'DESC')->first();
        $regu = $lastTmpIdentitas['regu'] ?? '';
        $shift = $lastTmpIdentitas['shift'] ?? '';

        $data = [
            'title' => 'FG - Hasil',
            'sku' => $sku,
            'line' => $line,
            'hasil' => $hasil,
            'identitas' => $identitas['nama_sku'],
            'id_sku' => $tableName,
            'regu' => $regu,
            'shift' => $shift
        ];
        return view('pages/tmphasil', $data);
    }

    public function cetakTmphasil()
    {
        $db = \Config\Database::connect();
        $skuModel = new SkuModel();
        date_default_timezone_set('asia/jakarta');
        $dateTime = new DateTime();
        $nowDateTime = $dateTime->format('d-m-Y H:i:s');
        $tmpIdentitasModel = new TmpIdentitasModel();
        $tmpidentitas = $tmpIdentitasModel->select('regu, shift, stock_keeper, kasie')->first();

        $listSku = $skuModel->select('id_sku, nama_sku')->findAll();
        $connector = new WindowsPrintConnector("POS-58");
        $printer = new Printer($connector);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->setEmphasis(true);
        $printer->text("DATA PER-SHIFT\n");
        $printer->text("PT INDOFOOD FORTUNA MAKMUR\n");
        $printer->text("PLANT 1403\n");
        $printer->setEmphasis(false);
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->feed(1);
        $printer->text("Cetak      : $nowDateTime\n");
        $printer->text("Regu/Shift : " . $tmpidentitas['regu'] . "/" . $tmpidentitas['shift'] . "\n");
        $printer->text("==============================\n");

        foreach ($listSku as $sku) {
            $id_sku = $sku['id_sku'];
            $nama_sku = $sku['nama_sku'];

            try {
                $query = $db->query('SELECT * FROM "' . $id_sku . '"');
                $rows = $query->getResult();

                if (count($rows) > 0) {
                    $printer->setJustification(Printer::JUSTIFY_LEFT);
                    $printer->setEmphasis(true);
                    $printer->text("SKU   : $nama_sku\n");
                    $printer->setEmphasis(false);
                    $printer->text("ID SKU: $id_sku\n");
                    $printer->text("------------------------------\n");
                    $printer->text("No  Waktu    Pallet  Karton\n");

                    $no = 1;
                    $totalKarton = 0;
                    foreach ($query->getResult() as $row) {
                        $printer->text(sprintf(
                            "%-3s %-8s %-7s %s\n",
                            $no++,
                            date('H:i', strtotime($row->tanggal)),
                            $row->no_pallet,
                            $row->isi_pallet
                        ));
                        $totalKarton += $row->isi_pallet;
                    }

                    $totalPallet = count($rows);
                    $printer->text("------------------------------\n");
                    $printer->text("Total Pallet: $totalPallet\n");
                    $printer->text("Total Karton: $totalKarton\n");
                    $printer->text("==============================\n");
                    $printer->feed(1);
                }
            } catch (\Throwable $e) {
                continue;
            }
        }
        $printer->feed(1);
        $printer->text("Dibuat oleh,");
        $printer->feed(1);
        $printer->text("" . $tmpidentitas['stock_keeper'] . "");
        $printer->feed(3);
        $printer->text("(Stock keeper FG)");
        $printer->feed(2);
        $printer->cut();
        $printer->close();

        return redirect()->back()->with('success', 'Data semua SKU berhasil dicetak.');
    }

    public function addManual()
    {
        $targetModel = new SettTargetModel();

        $line = $targetModel->select('id_line, nama_line')
            ->distinct()
            ->findAll();
        $sku = $targetModel->select('id_sku, nama_sku, id_line')
            ->findAll();
        $lineModel = new LineModel();
        $lineManual = $lineModel->findAll();
        $data = [
            'title' => 'FG - Manual',
            'sku' => $sku,
            'line' => $line,
            'lineManual' => $lineManual
        ];
        return view('pages/addmanual', $data);
    }
}
