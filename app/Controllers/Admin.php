<?php

namespace App\Controllers;

use App\Models\IdentitasModel;
use App\Models\LineModel;
use App\Models\SettMesinModel;
use App\Models\SettTargetModel;
use App\Models\SkuModel;
use App\Models\TmpIdentitasModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    public function dashboard()
    {
        $targetModel = new SettTargetModel();

        $line = $targetModel->select('id_line, nama_line')
            ->distinct()
            ->findAll();
        $sku = $targetModel->select('id_sku, nama_sku, id_line')
            ->findAll();

        $data = [
            'title' => 'FG - Dashboard',
            'sku' => $sku,
            'line' => $line
        ];
        return view('pages/dashboard', $data);
    }

    public function settMesin()
    {
        $db = \Config\Database::connect();
        $skuModel = new SkuModel();
        $settmesinModel = new SettMesinModel();
        $targetModel = new SettTargetModel();

        $line = $targetModel->select('id_line, nama_line')
            ->distinct()
            ->findAll();
        $sku = $targetModel->select('id_sku, nama_sku, id_line')
            ->findAll();

        // Ambil daftar SKU
        $listSku = $skuModel->select('id_sku')->findAll();

        $nonEmptyTables = [];

        // Cek tabel mana yg ada isinya
        foreach ($listSku as $skum) {
            $tableName = $skum['id_sku'];
            try {
                $query = $db->query("SELECT COUNT(*) as total FROM \"$tableName\"");
                $count = $query->getRow()->total ?? 0;

                if ($count > 0) {
                    $nonEmptyTables[] = $tableName;
                }
            } catch (\Throwable $e) {
                continue; // Skip kalau tabel belum ada
            }
        }

        // Ambil data dari settmesin sesuai SKU yg ada isinya
        $mesinData = [];
        foreach ($nonEmptyTables as $id_sku) {
            $mesinRow = $settmesinModel
                ->select('id_sku, nama_sku, jml_mesin, speed, downtime')
                ->where('id_sku', $id_sku)
                ->first();

            if ($mesinRow) {
                $mesinData[] = $mesinRow;
            }
        }

        // Kirim ke view pages/settmesin
        return view('pages/settmesin', [
            'mesinData' => $mesinData,
            'title' => 'FG - Dashboard',
            'sku' => $sku,
            'line' => $line
        ]);
    }

    public function kosong()
    {
        $targetModel = new SettTargetModel();

        $line = $targetModel->select('id_line, nama_line')
            ->distinct()
            ->findAll();
        $sku = $targetModel->select('id_sku, nama_sku, id_line')
            ->findAll();
        $data = [
            'title' => 'FG - Kosong',
            'sku' => $sku,
            'line' => $line
        ];
        return view('pages/kosong', $data);
    }

    public function mLine()
    {
        $targetModel = new SettTargetModel();
        $lineModel = new LineModel();

        $line = $targetModel->select('id_line, nama_line')
            ->distinct()
            ->findAll();
        $sku = $targetModel->select('id_sku, nama_sku, id_line')
            ->findAll();

        $mline = $lineModel->findAll();

        $data = [
            'title' => 'FG - mLine',
            'sku' => $sku,
            'line' => $line,
            'mline' => $mline
        ];
        return view('admin/mline', $data);
    }

    public function tambahLine()
    {
        $lineModel = new LineModel();

        $id_line = $this->request->getPost('mid_line');
        $nama_line = $this->request->getPost('mnama_line');

        $lineModel->save([
            'id_line' => $id_line,
            'nama_line' => $nama_line
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function updateLine()
    {
        $lineModel = new LineModel();
        $skuModel = new SkuModel();

        $id_line = $this->request->getPost('mid_line');
        $nama_line = $this->request->getPost('mnama_line');

        $lineModel->update($id_line, [
            'id_line' => $id_line,
            'nama_line' => $nama_line
        ]);

        $skuModel->where('id_line', $id_line)->set(['nama_line' => $nama_line])->update();

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function delLine()
    {
        $lineModel = new LineModel();

        $id_line = $this->request->getPost('mid_line');
        $lineModel->where('id_line', $id_line)->delete();

        // session()->setFlashdata('success', 'Berhasil menghapus target.');
        return redirect()->back()->with('success', 'Berhasil menghapus line');
    }

    public function mSku()
    {
        $targetModel = new SettTargetModel();
        $skuModel = new SkuModel();

        $line = $targetModel->select('id_line, nama_line')
            ->distinct()
            ->findAll();
        $sku = $targetModel->select('id_sku, nama_sku, id_line')
            ->findAll();

        $msku = $skuModel->findAll();

        $data = [
            'title' => 'FG - mSku',
            'sku' => $sku,
            'line' => $line,
            'msku' => $msku
        ];
        return view('admin/msku', $data);
    }
    public function addSku()
    {
        $targetModel = new SettTargetModel();

        $line = $targetModel->select('id_line, nama_line')
            ->distinct()
            ->findAll();
        $sku = $targetModel->select('id_sku, nama_sku, id_line')
            ->findAll();
        $lineModel = new LineModel();
        $mline = $lineModel->findAll();
        $data = [
            'title' => 'FG - mSKU',
            'sku' => $sku,
            'line' => $line,
            'mline' => $mline
        ];
        return view('admin/addsku', $data);
    }

    public function saveSku()
    {
        $skuModel = new SkuModel();
        $settmesinModel = new SettMesinModel();
        $db = \Config\Database::connect();

        $mid_line = $this->request->getPost('mid_line');
        $mid_sku_kotor = $this->request->getPost('mid_sku');
        $mnama_sku = $this->request->getPost('mnama_sku');
        $mjml_karton = $this->request->getPost('mjml_karton');
        $mnama_line = $this->request->getPost('mnama_line');
        $misi_karton = $this->request->getPost('misi_karton');
        $mstd_etiket = $this->request->getPost('mstd_etiket');

        $mid_sku = str_replace('-', '', $mid_sku_kotor);

        $skuModel->save([
            'id_line' => $mid_line,
            'id_sku' => $mid_sku,
            'nama_sku' => $mnama_sku,
            'jml_karton' => $mjml_karton,
            'nama_line' => $mnama_line,
            'isi_karton' => $misi_karton,
            'std_etiket' => $mstd_etiket
        ]);

        $jml_mesin = 0;
        $speed = 0;
        $downtime = 0;

        $settmesinModel->save([
            'id_sku' => $mid_sku,
            'nama_sku' => $mnama_sku,
            'jml_mesin' => $jml_mesin,
            'speed' => $speed,
            'downtime' => $downtime
        ]);

        try {
            $db->query('CREATE TABLE "' . $mid_sku . '" (LIKE tsku INCLUDING ALL)');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal membuat tabel baru: ' . $e->getMessage());
        }

        return redirect()->to('admin/msku')->with('success', 'Berhasil menambahkan SKU');
    }

    public function delSku()
    {
        $skuModel = new SkuModel();
        $settmesinModel = new SettMesinModel();
        $db = \Config\Database::connect();

        $mid_sku = $this->request->getPost('mid_sku');
        $skuModel->where('id_sku', $mid_sku)->delete();
        $settmesinModel->where('id_sku', $mid_sku)->delete();
        // d($mid_sku);
        try {

            $db->query('DROP TABLE IF EXISTS "' . $mid_sku . '"');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal hapus tabel: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus SKU');
    }

    public function updateSku()
    {
        $skuModel = new SkuModel();

        $mid_line = $this->request->getPost('mid_line');
        $mid_sku = $this->request->getPost('mid_sku');
        $mnama_sku = $this->request->getPost('mnama_sku');
        $mjml_karton = $this->request->getPost('mjml_karton');
        $mnama_line = $this->request->getPost('mnama_line');
        $misi_karton = $this->request->getPost('misi_karton');
        $mstd_etiket = $this->request->getPost('mstd_etiket');

        $skuModel->where('id_line', $mid_line)->set([
            'id_sku' => $mid_sku,
            'nama_sku' => $mnama_sku,
            'jml_karton' => $mjml_karton,
            'nama_line' => $mnama_line,
            'isi_karton' => $misi_karton,
            'std_etiket' => $mstd_etiket
        ])->update();

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function mUser()
    {
        $targetModel = new SettTargetModel();
        $tmpIdentitasModel = new TmpIdentitasModel();
        $identitasModel = new IdentitasModel();
        $userModel = new UserModel();


        $line = $targetModel->select('id_line, nama_line')
            ->distinct()
            ->findAll();
        $sku = $targetModel->select('id_sku, nama_sku, id_line')
            ->findAll();
        $tmpident = $tmpIdentitasModel->findAll();
        $identitas = $identitasModel->findAll();
        $users = $userModel->findAll();

        $data = [
            'title' => 'FG - mUsers',
            'sku' => $sku,
            'line' => $line,
            'tmpident' => $tmpident,
            'identitas' => $identitas,
            'users' => $users
        ];
        return view('admin/musers', $data);
    }

    public function delTmp()
    {
        $tmpIdentitasModel = new TmpIdentitasModel();
        $id = $this->request->getPost('id');

        $tmpIdentitasModel->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function updateIdent()
    {
        $id = $this->request->getPost('id');
        $identitasModel = new IdentitasModel();

        $data = [
            'stock_keeper'     => $this->request->getPost('stock_keeper'),
            'kasie' => $this->request->getPost('kasie'),
            'spv' => $this->request->getPost('spv')
        ];


        $identitasModel->update($id, $data);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function addUser()
    {
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $role = $this->request->getPost('role');
        $is_active = '1';

        $userModel->save([
            'username' => $username,
            'password' => $password,
            'role' => $role,
            'is_active' => $is_active
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function updateUser()
    {
        $id = $this->request->getPost('id');
        $userModel = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'is_active' => $this->request->getPost('is_active')
        ];


        $userModel->update($id, $data);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function delUser()
    {
        $userModel = new UserModel();
        $id = $this->request->getPost('id');

        $userModel->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
