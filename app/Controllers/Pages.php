<?php

namespace App\Controllers;

use App\Models\AllDataModel;
use App\Models\IdentitasModel;
use App\Models\LineModel;
use App\Models\SettMesinModel;
use App\Models\SettTargetModel;
use App\Models\SkuModel;
use App\Models\TmpIdentitasModel;
use DateTime;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class Pages extends BaseController
{
    public function getTotalKarton()
    {
        $db = \Config\Database::connect();
        $skuModel = new SkuModel();

        $listSku = $skuModel->select('id_sku')->findAll();
        $totalKarton = 0;

        foreach ($listSku as $sku) {
            $namaTabel = $sku['id_sku'];
            try {
                $query = $db->query('SELECT SUM(isi_pallet) AS total FROM "' . $namaTabel . '"');
                $result = $query->getRowArray();

                $totalKarton += $result['total'] ?? 0; // Tambahkan ke total jika tidak null
            } catch (\Throwable $e) {
                continue;
            }
        }
        echo $totalKarton;
    }

    public function getTotalPallet()
    {
        $db = \Config\Database::connect();
        $skuModel = new SkuModel();

        $listSku = $skuModel->select('id_sku')->findAll();
        $totalPallet = 0;

        foreach ($listSku as $sku) {
            $namaTabel = $sku['id_sku'];
            try {
                // Cek apakah tabel ada, dan hitung jumlah baris
                $query = $db->query('SELECT COUNT(*) as jumlah FROM "' . $namaTabel . '"');
                $count = $query->getRow()->jumlah;
                $totalPallet += $count;
            } catch (\Exception $e) {
                continue;
            }
        }
        echo $totalPallet;
    }

    public function getTotalSku()
    {
        $skuModel = new SkuModel();
        $listSku = $skuModel->select('id_sku')->findAll();

        $db = \Config\Database::connect();
        $nonEmptyTables = [];

        foreach ($listSku as $sku) {
            $tableName = $sku['id_sku'];

            // Cek jumlah data dalam tabel tersebut
            $query = $db->query("SELECT COUNT(*) as total FROM \"$tableName\"");
            $result = $query->getRow();

            if ($result->total > 0) {
                $nonEmptyTables[] = $tableName;
            }
        }
        echo count($nonEmptyTables);
        // echo $nonEmptyTables;
    }

    public function getTotalTarget()
    {
        $settTargetModel = new SettTargetModel();

        $totalTarget = $settTargetModel->countAll();

        echo $totalTarget;
    }

    public function getProdTime()
    {
        $tmphasilModel = new TmpIdentitasModel();
        date_default_timezone_set('asia/jakarta');
        $nowDateTime = new DateTime();

        $tmpfgstock = $tmphasilModel->where('role', 'fgstock')->first();
        $loginDateTime = new DateTime($tmpfgstock['login_time']);

        $selisih = $nowDateTime->diff($loginDateTime);
        $prodTime = ($selisih->h * 60) + $selisih->i;

        echo $prodTime;
    }

    public function getChartPallet()
    {
        $db = \Config\Database::connect();
        $skuModel = new \App\Models\SkuModel();
        $identitasModel = new \App\Models\TmpIdentitasModel();

        date_default_timezone_set('Asia/Jakarta');

        $loginTime = new \DateTime($identitasModel->where('role', 'fgstock')->first()['login_time']);
        $nowTime = new \DateTime();

        $interval = $loginTime->diff($nowTime);
        $jamTotal = $interval->h + ($interval->days * 24);

        $listSku = $skuModel->select('id_sku')->findAll();

        $labels = [];
        $data = [];

        for ($i = 0; $i <= $jamTotal; $i++) {
            $start = (clone $loginTime)->modify("+{$i} hour");
            $end = (clone $start)->modify('+1 hour');

            $countPerHour = 0;

            foreach ($listSku as $sku) {
                $table = $sku['id_sku'];
                try {
                    $query = $db->query("SELECT COUNT(*) AS jumlah FROM \"$table\" 
                    WHERE tanggal >= '{$start->format('Y-m-d H:i:s')}' 
                    AND tanggal < '{$end->format('Y-m-d H:i:s')}'");
                    $countPerHour += $query->getRow()->jumlah;
                } catch (\Throwable $e) {
                    continue;
                }
            }

            $labels[] = 'Jam ' . $i;
            $data[] = $countPerHour;
        }

        return view('pages/chart', [
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function updatePc()
    {
        $id_line = '101';
        $new_nama_line = $this->request->getPost('nama_line');

        $lineModel = new LineModel();
        $skuModel = new SkuModel();

        // Update nama_line di tabel line
        $lineModel->update($id_line, ['nama_line' => $new_nama_line]);

        // Update semua baris di tabel sku yang memiliki id_line tersebut
        $skuModel->where('id_line', $id_line)->set(['nama_line' => $new_nama_line])->update();
        // d($new_nama_line);
        $role = session()->get('role');
        return redirect()->to('' . $role . '/tmpidentitas');
    }

    public function valIdent()
    {
        $regu = $this->request->getPost('regu');
        $shift = $this->request->getPost('shift');
        date_default_timezone_set('asia/jakarta');
        $role = session()->get('role');

        $identitasModel    = new IdentitasModel();
        $tmpIdentitasModel = new TmpIdentitasModel();

        $dataIdentitas = $identitasModel->where('regu', $regu)->first();

        $newData = [
            'regu'         => $dataIdentitas['regu'],
            'shift'        => $shift,
            'stock_keeper' => $dataIdentitas['stock_keeper'],
            'kasie'        => $dataIdentitas['kasie'],
            'spv'          => $dataIdentitas['spv'],
            'login_time'   => date('Y-m-d H:i:s'),
            'role'         => $role
        ];
        $existing = $tmpIdentitasModel->where('role', $role)->first();

        if ($existing) {
            $tmpIdentitasModel->update($existing['id'], $newData);
        } else {
            $tmpIdentitasModel->save($newData);
        }

        return redirect()->to('' . $role . '/tambahfg')->with('showResetModal', true);
    }

    public function updateAlldata()
    {
        $id         = $this->request->getPost('id');
        $tanggal    = $this->request->getPost('tanggal');
        $sku        = $this->request->getPost('sku'); // nama SKU
        $line       = $this->request->getPost('line');
        $noPallet   = $this->request->getPost('no_pallet');
        $isiPallet  = $this->request->getPost('isi_pallet');

        $db = \Config\Database::connect();

        $dataUpdate = [
            'line'       => $line,
            'sku'        => $sku,
            'no_pallet'  => $noPallet,
            'isi_pallet' => $isiPallet,
        ];

        try {
            // 1. Update ke alldata
            $db->table('alldata')->where('id', $id)->update($dataUpdate);

            // 2. Dapatkan nama tabel dari sku
            $skuTable = $db->table('sku')->where('nama_sku', $sku)->get()->getRowArray();

            if ($skuTable && isset($skuTable['id_sku'])) {
                $tableName = $skuTable['id_sku'];
                $sql = 'UPDATE "' . $tableName . '" SET 
                        line = :line:, 
                        sku = :sku:, 
                        no_pallet = :no_pallet:, 
                        isi_pallet = :isi_pallet: 
                    WHERE tanggal = :tanggal:';
                $db->query($sql, array_merge($dataUpdate, ['tanggal' => $tanggal]));
            }

            return redirect()->back()->with('success', 'Data berhasil diperbarui di alldata dan tabel SKU');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    public function delAlldata()
    {
        $id      = $this->request->getPost('id');
        $tanggal = $this->request->getPost('tanggal');
        $sku     = $this->request->getPost('sku');

        $db = \Config\Database::connect();

        try {
            // Hapus dari tabel alldata berdasarkan ID
            $db->table('alldata')->where('id', $id)->delete();

            // Cari id_sku berdasarkan nama sku
            $skuRow = $db->table('sku')->where('nama_sku', $sku)->get()->getRowArray();

            if ($skuRow && isset($skuRow['id_sku'])) {
                $tableName = $skuRow['id_sku'];

                // Hapus dari tabel SKU berdasarkan tanggal
                $sql = 'DELETE FROM "' . $tableName . '" WHERE tanggal = :tanggal:';
                $db->query($sql, ['tanggal' => $tanggal]);
            }

            return redirect()->back()->with('success', 'Data berhasil dihapus dari alldata dan tabel SKU');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function updateHasil()
    {
        $id_sku = $this->request->getPost('id_sku');
        $tanggal = $this->request->getPost('tanggal');

        $dataUpdate = [
            'no_pallet'  => $this->request->getPost('no_pallet'),
            'isi_pallet' => $this->request->getPost('isi_pallet'),
        ];

        $db = \Config\Database::connect();

        try {
            // Update ke tabel id_sku
            $sql = 'UPDATE "' . $id_sku . '" SET no_pallet = :no_pallet:, isi_pallet = :isi_pallet: WHERE tanggal = :tanggal:';
            $db->query($sql, $dataUpdate + ['tanggal' => $tanggal]);
            // $db->table($table)->where('tanggal::date', date('Y-m-d', strtotime($tanggal)))->update($dataUpdate);

            // Update ke tabel alldata
            $db->table('alldata')->where('tanggal', $tanggal)->update($dataUpdate);
            // $db->query("UPDATE $table SET no_pallet = ?, isi_pallet = ? WHERE tanggal = ?", [
            //     $dataUpdate['no_pallet'],
            //     $dataUpdate['isi_pallet'],
            //     $tanggal['tanggal']
            // ]);

            // $db->query("UPDATE alldata SET no_pallet = ?, isi_pallet = ? WHERE tanggal = ?", [
            //     $dataUpdate['no_pallet'],
            //     $dataUpdate['isi_pallet'],
            //     $tanggal['tanggal']
            // ]);
            // d($tanggal);

            return redirect()->back()->with('success', 'Berhasil update data di tabel ini dan all data');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal update: ' . $e->getMessage());
            // log_message('error', 'Update gagal: ' . $e->getMessage());
        }
    }

    public function delHasil()
    {
        $id_sku  = $this->request->getPost('id_sku');
        $tanggal = $this->request->getPost('tanggal');

        $db = \Config\Database::connect();
        // $table = '"' . $id_sku . '"';

        try {
            // Hapus dari tabel id_sku
            $sql = 'DELETE FROM "' . $id_sku . '" WHERE tanggal = :tanggal:';
            $db->query($sql, ['tanggal' => $tanggal]);

            // Hapus dari alldata
            $db->table('alldata')->where('tanggal', $tanggal)->delete();

            return redirect()->back()->with('success', 'Berhasil hapus data di tabel ini dan all data');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal hapus data: ' . $e->getMessage());
        }
    }

    public function monitorTabel()
    {
        $db = \Config\Database::connect();

        // Ambil data utama
        $query = '
        SELECT t.id_sku, t.nama_line, t.nama_sku, t.target, t.keterangan
        FROM setttarget t
        LEFT JOIN sku s ON s.id_sku = t.id_sku';
        $rows = $db->query($query)->getResultArray();

        $html = '';
        foreach ($rows as $row) {
            $tableName = $row['id_sku'];
            $tableName = '"' . $tableName . '"';

            // Query ke tabel berdasarkan id_sku
            try {
                $kartonSkuQuery = 'SELECT SUM(isi_pallet) AS totalkartonsku 
                FROM ' . $tableName;
                $kartonSkuResult = $db->query($kartonSkuQuery)->getRowArray();
                $totalKartonSku = $kartonSkuResult['totalkartonsku'] ?? 0;
            } catch (\Throwable $e) {
                $totalKartonSku = 'Error';
            }

            $html .= '<tr>';
            $html .= '<td>' . esc($row['id_sku']) . '</td>';
            $html .= '<td>' . esc($row['nama_line']) . '</td>';
            $html .= '<td>' . esc($row['nama_sku']) . '</td>';
            $html .= '<td>' . esc($totalKartonSku) . '</td>';
            $html .= '<td>' . esc($row['target']) . '</td>';
            $html .= '<td>' . esc($row['keterangan']) . '</td>';
            $html .= '</tr>';
        }

        echo $html;
    }

    public function getDataEtiket()
    {
        $db = \Config\Database::connect();
        $skuModel = new SkuModel();
        $tmpIdentitasModel = new TmpIdentitasModel();

        date_default_timezone_set('Asia/Jakarta');
        $nowDateTime = new \DateTime();

        $tmpfgstock = $tmpIdentitasModel->where('role', 'fgstock')->first();
        $loginDateTime = new \DateTime($tmpfgstock['login_time']);

        $selisih = $nowDateTime->diff($loginDateTime);
        $prodTime = ($selisih->h * 60) + $selisih->i;

        $listSku = $skuModel->select('id_sku, nama_sku, isi_karton, std_etiket')->findAll();
        $html = '';

        foreach ($listSku as $sku) {
            $tableName = $sku['id_sku'];

            try {
                $query = $db->query("SELECT COUNT(*) as skufg FROM \"$tableName\"");
                $result = $query->getRow();

                if ($result->skufg > 0) {

                    $querySum = $db->query("SELECT SUM(isi_pallet) as total_isi FROM \"$tableName\"");
                    $resultSum = $querySum->getRow();
                    $totalIsi = $resultSum->total_isi ?? 0;

                    $mesin = $db->table('settmesin')->where('id_sku', $sku['id_sku'])->get()->getRow();
                    $speed = $mesin->speed ?? 0;
                    $jmlMesin = $mesin->jml_mesin ?? 0;
                    $downtime = $mesin->downtime ?? 0;

                    $timeEff = $prodTime;
                    if ($downtime > 0) {
                        $timeEff -= $downtime;
                        if ($timeEff < 0) $timeEff = 0; // jangan negatif
                    }

                    $stdEtiket = $sku['std_etiket'] ?? 1; // jaga-jaga biar gak dibagi 0
                    $etiketAktual = ($stdEtiket > 0)
                        ? ($speed * $timeEff * $jmlMesin) / $stdEtiket
                        : 0;

                    $isiKarton = $sku['isi_karton'] ?? 0;
                    $stdEtiket = $sku['std_etiket'] ?? 1; // agar tidak dibagi 0

                    $totalEtiket = ($stdEtiket > 0) ? ($totalIsi * $isiKarton) / $stdEtiket : 0;

                    $selisihEtiket = $etiketAktual - $totalEtiket;

                    $persentase = ($totalEtiket > 0)
                        ? ($selisihEtiket / $totalEtiket) * 100
                        : 0;

                    $html .= '<tr>';
                    $html .= '<td>' . esc($sku['nama_sku']) . '</td>';
                    $html .= '<td>' . esc(round($totalEtiket, 3)) . '</td>';
                    $html .= '<td>' . esc(round($etiketAktual, 3)) . '</td>';
                    $html .= '<td>' . esc(round($selisihEtiket, 3)) . '</td>';
                    $html .= '<td>' . esc(round($persentase, 2)) . '</td>';
                    $html .= '<td>' . esc($downtime) . '</td>';
                    $html .= '</tr>';
                }
            } catch (\Throwable $e) {
                // Jika tabel tidak ada, biarkan lewat
                continue;
            }
        }

        echo $html;
    }

    public function updateMesin()
    {
        $settmesinModel = new SettMesinModel();

        $id_sku = $this->request->getPost('id_sku');
        $jml_mesin = $this->request->getPost('jml_mesin');
        $speed = $this->request->getPost('speed');
        $downtime = $this->request->getPost('downtime');

        $settmesinModel->update($id_sku, [
            'jml_mesin' => $jml_mesin,
            'speed' => $speed,
            'downtime' => $downtime
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function getDateTime()
    {
        date_default_timezone_set('asia/jakarta');
        $html = date('Y-m-d H:i:s');
        echo $html;
        // d($html);
    }

    public function identitasLog()
    {
        $tmphasilModel = new TmpIdentitasModel();
        $identitas = $tmphasilModel->first();

        return view('layout/template', ['identitas' => $identitas]);
    }
    public function getSkuByLine()
    {
        $nama_line = $this->request->getPost('nama_line');
        $skuModel = new SkuModel();
        $data = $skuModel->select('id_sku, nama_sku, id_line, nama_line')->where('nama_line', $nama_line)
            ->whereNotIn('nama_sku', function ($builder) {
                return $builder->select('nama_sku')->from('setttarget');
            })->findAll();
        return $this->response->setJSON($data);
    }
    public function saveTarget()
    {
        // dd($this->request->getVar());
        $setttargetModel = new SettTargetModel();
        $setttargetModel->save([
            'id_sku' => $this->request->getVar('id_sku'),
            'nama_line' => $this->request->getVar('nama_line'),
            'nama_sku' => $this->request->getVar('nama_sku'),
            'target' => $this->request->getVar('target'),
            'keterangan' => $this->request->getVar('keterangan'),
            'id_line' => $this->request->getVar('id_line')
        ]);

        $role = session()->get('role');
        return redirect()->to('' . $role . '/setttarget')->with('success', 'Berhasil menambahkan target.');
    }

    public function updateTarget()
    {
        $id = $this->request->getPost('id_sku');

        $data = [
            'target'     => $this->request->getPost('target'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        $targetModel = new SettTargetModel();
        $targetModel->update($id, $data);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function delTarget()
    {
        $id_sku = $this->request->getPost('id_sku');
        $targetModel = new SettTargetModel();
        $targetModel->where('id_sku', $id_sku)->delete();

        // session()->setFlashdata('success', 'Berhasil menghapus target.');
        return redirect()->back()->with('success', 'Berhasil menghapus target.');
    }

    public function getLineByIdSku()
    {
        $id_sku_kotor = $this->request->getPost('id_sku');
        $id_sku = str_replace('-', '', $id_sku_kotor);
        $db = \Config\Database::connect();

        // Step 1: Ambil data dari tabel sku
        $skuRow = $db->table('sku')->where('id_sku', $id_sku)->get()->getRowArray();

        if (!$skuRow) {
            return $this->response->setJSON(['success' => false, 'message' => 'SKU tidak ditemukan']);
        }

        // Step 2: Hitung jumlah baris dari tabel sesuai id_sku (nama tabel = id_sku)
        $tableName = '"' . $id_sku . '"'; // aman untuk PostgreSQL
        try {
            $query = $db->query("SELECT MAX(no_pallet) AS last_pallet FROM $tableName");
            $row = $query->getRowArray();
            $jumlahPallet = ($row['last_pallet'] ?? 0) + 1;
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tabel tidak ditemukan',
                'error' => $e->getMessage()
            ]);
        }

        // Step 3: Return data
        return $this->response->setJSON([
            'success' => true,
            'data' => [
                'nama_line' => $skuRow['nama_line'],
                'nama_sku' => $skuRow['nama_sku'],
                'jml_karton' => $skuRow['jml_karton'],
                'no_pallet' => $jumlahPallet
            ]
        ]);
    }

    public function saveFg()
    {
        $tmpIdentitasModel = new TmpIdentitasModel();
        $id_sku_kotor = $this->request->getPost('scanner');
        $id_sku = str_replace('-', '', $id_sku_kotor);
        $db     = \Config\Database::connect();
        $table  = '"' . $id_sku . '"'; // nama tabel dari input (PostgreSQL-safe)

        // Siapkan data yang akan di-insert
        date_default_timezone_set('asia/jakarta');
        $data = [
            'tanggal'    => date('Y-m-d H:i:s'), // waktu sekarang
            'line'       => $this->request->getPost('line'),
            'sku'        => $this->request->getPost('sku'),
            'no_pallet'  => $this->request->getPost('no_pallet'),
            'isi_pallet' => $this->request->getPost('jml_karton')
        ];

        $tmpidentitas = $tmpIdentitasModel->select('regu, shift, stock_keeper, kasie')->first();

        // d($data);
        $sql1 = "INSERT INTO $table(tanggal, line, sku, no_pallet, isi_pallet)
        VALUES (:tanggal:, :line:, :sku:, :no_pallet:, :isi_pallet:)";
        $sql2 = "INSERT INTO alldata(tanggal, line, sku, no_pallet, isi_pallet)
        VALUES (:tanggal:, :line:, :sku:, :no_pallet:, :isi_pallet:)";


        try {
            // $db->table($table)->insert($data);
            $db->query($sql1, $data);
            $db->query($sql2, $data);

            // ===== CETAK STRUK =====
            $connector = new WindowsPrintConnector("POS-58");
            $printer = new Printer($connector);

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            // title($printer, "QR code demo\n");
            // $printer -> setLineSpacing(3);
            $printer->setEmphasis(true);
            $printer->text("LABEL FINISH GOODS");
            $printer->feed(1);
            $printer->text("PT INDOFOOD FORTUNA MAKMUR");
            $printer->feed(1);
            $printer->text("PLANT 1403");
            $printer->setEmphasis(false);
            $printer->feed(2);
            $printer->setJustification();
            $printer->text("Line     : " . $data['line'] . "");
            $printer->feed(1);
            $printer->text("Produk   : " . $data['sku'] . "gr");
            $printer->feed(1);
            $printer->text("Jumlah   : " . $data['isi_pallet'] . " karton");
            $printer->feed(1);
            $printer->text("Waktu    : " . date('Y-m-d H:i:s') . "");
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
            $printer->text("" . $data['no_pallet'] . "");
            $printer->feed(1);
            $printer->text("" . $tmpidentitas['regu'] . "/" . $tmpidentitas['shift'] . "");
            $printer->setTextSize(1, 1);

            $printer->feed(2);
            $printer->setJustification();
            $printer->text("Dibuat oleh,");
            $printer->feed(1);
            $printer->text("" . $tmpidentitas['stock_keeper'] . "");
            $printer->feed(3);
            $printer->text("(Stock keeper FG)");
            $printer->feed(2);

            $printer->cut();

            /* Close printer */
            $printer->close();
            // =======================

            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal simpan: ' . $e->getMessage());
        }
    }

    public function saveFgManual()
    {
        $tmpIdentitasModel = new TmpIdentitasModel();
        $id_sku = $this->request->getPost('id_skuManual');
        $db     = \Config\Database::connect();
        $table  = '"' . $id_sku . '"'; // nama tabel dari input (PostgreSQL-safe)

        // Siapkan data yang akan di-insert
        date_default_timezone_set('asia/jakarta');
        $data = [
            'tanggal'    => date('Y-m-d H:i:s'), // waktu sekarang
            'line'       => $this->request->getPost('nama_lineManual'),
            'sku'        => $this->request->getPost('nama_skuManual'),
            'no_pallet'  => $this->request->getPost('no_palletManual'),
            'isi_pallet' => $this->request->getPost('jml_kartonManual')
        ];

        $tmpidentitas = $tmpIdentitasModel->select('regu, shift, stock_keeper, kasie')->first();

        // d($data);
        $sql1 = "INSERT INTO $table(tanggal, line, sku, no_pallet, isi_pallet)
        VALUES (:tanggal:, :line:, :sku:, :no_pallet:, :isi_pallet:)";
        $sql2 = "INSERT INTO alldata(tanggal, line, sku, no_pallet, isi_pallet)
        VALUES (:tanggal:, :line:, :sku:, :no_pallet:, :isi_pallet:)";


        try {
            // $db->table($table)->insert($data);
            $db->query($sql1, $data);
            $db->query($sql2, $data);

            // ===== CETAK STRUK =====
            $connector = new WindowsPrintConnector("POS-58");
            $printer = new Printer($connector);

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            // title($printer, "QR code demo\n");
            // $printer -> setLineSpacing(3);
            $printer->setEmphasis(true);
            $printer->text("LABEL FINISH GOODS");
            $printer->feed(1);
            $printer->text("PT INDOFOOD FORTUNA MAKMUR");
            $printer->feed(1);
            $printer->text("PLANT 1403");
            $printer->setEmphasis(false);
            $printer->feed(2);
            $printer->setJustification();
            $printer->text("Line     : " . $data['line'] . "");
            $printer->feed(1);
            $printer->text("Produk   : " . $data['sku'] . "gr");
            $printer->feed(1);
            $printer->text("Jumlah   : " . $data['isi_pallet'] . " karton");
            $printer->feed(1);
            $printer->text("Waktu    : " . date('Y-m-d H:i:s') . "");
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
            $printer->text("" . $data['no_pallet'] . "");
            $printer->feed(1);
            $printer->text("" . $tmpidentitas['regu'] . "/" . $tmpidentitas['shift'] . "");
            $printer->setTextSize(1, 1);

            $printer->feed(2);
            $printer->setJustification();
            $printer->text("Dibuat oleh,");
            $printer->feed(1);
            $printer->text("" . $tmpidentitas['stock_keeper'] . "");
            $printer->feed(3);
            $printer->text("(Stock keeper FG)");
            $printer->feed(2);

            $printer->cut();

            /* Close printer */
            $printer->close();
            // =======================
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal simpan: ' . $e->getMessage());
        }
    }

    public function resetShift()
    {
        $db = \Config\Database::connect();

        // Ambil semua id_sku dari tabel sku
        $idSkuList = $db->table('sku')->select('id_sku')->get()->getResultArray();

        $errors = [];

        foreach ($idSkuList as $row) {
            $tableName = $row['id_sku']; // aman untuk PostgreSQL

            try {
                $db->query('DELETE FROM "' . $tableName . '"');
            } catch (\Throwable $e) {
                $errors[] = $row['id_sku'] . ': ' . $e->getMessage();
            }
        }

        if (empty($errors)) {
            return redirect()->back()->with('pesan', 'Semua data shift berhasil direset.');
        } else {
            return redirect()->back()->with('error', 'Beberapa tabel gagal dihapus: ' . implode(', ', $errors));
        }
    }

    public function getSkuByLineManual()
    {
        $nama_line = $this->request->getPost('nama_line');
        $skuModel = new SkuModel();
        $data = $skuModel->select('id_sku, nama_sku, id_line, nama_line')->where('nama_line', $nama_line)
            ->findAll();
        return $this->response->setJSON($data);
    }
}
