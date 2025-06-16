<?php

namespace App\Controllers;

use App\Models\LineModel;
use App\Models\SettTargetModel;

class Kasie extends BaseController
{
    public function setttarget()
    {
        $targetModel = new SettTargetModel();

        $line = $targetModel->select('id_line, nama_line')
            ->distinct()
            ->findAll();
        $sku = $targetModel->select('id_sku, nama_sku, id_line')
            ->findAll();
        $target = $targetModel->findAll();
        // d($target);
        $data = [
            'title' => 'FG - Target',
            'sku' => $sku,
            'line' => $line,
            'target' => $target
        ];
        return view('pages/setttarget', $data);
    }

    public function addTarget()
    {
        $targetModel = new SettTargetModel();

        $line = $targetModel->select('id_line, nama_line')
            ->distinct()
            ->findAll();
        $sku = $targetModel->select('id_sku, nama_sku, id_line')
            ->findAll();
        $lineModel = new LineModel();
        $lineTarget = $lineModel->findAll();
        $data = [
            'title' => 'FG - Add Target',
            'sku' => $sku,
            'line' => $line,
            'lineTarget' => $lineTarget
        ];
        return view('pages/addtarget', $data);
    }
}
