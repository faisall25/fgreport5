<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<?php $role = session()->get('role'); ?>

<!-- Begin Page Content -->
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Semua Pallet</h1>

    <!-- tabel PC14 -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (session()->getFlashdata('success')) : ?>
                <div id="alert-success" class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success'); ?>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                </div>
            <?php endif ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="mauexportall" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Line</th>
                            <th>SKU</th>
                            <th>No Pallet</th>
                            <th>Isi Per-pallet</th>
                            <?php if (in_array($role, ['kasie', 'admin'])) : ?>
                                <th>Aksi</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($alldata as $a): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $a['tanggal']; ?></td>
                                <td><?= $a['line']; ?></td>
                                <td><?= $a['sku']; ?></td>
                                <td><?= $a['no_pallet']; ?></td>
                                <td><?= $a['isi_pallet']; ?></td>
                                <?php if (in_array($role, ['kasie', 'admin'])) : ?>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-warning btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEdit<?= $a['id'] ?>">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="modalEdit<?= $a['id'] ?>" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <form action="<?= base_url('pages/updatealldata') ?>" method="post">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="id" value="<?= $a['id'] ?>">
                                                        <input type="hidden" name="sku" value="<?= $a['sku'] ?>">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Data</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label>tanggal</label>
                                                                    <input type="text" name="tanggal" class="form-control" value="<?= $a['tanggal'] ?>" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Line</label>
                                                                    <input type="text" name="line" class="form-control" value="<?= $a['line'] ?>" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>SKU</label>
                                                                    <input type="text" name="sku_display" class="form-control" value="<?= $a['sku'] ?>" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>No Pallet</label>
                                                                    <input type="number" name="no_pallet" class="form-control" value="<?= $a['no_pallet'] ?>" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Isi Pallet</label>
                                                                    <input type="number" name="isi_pallet" class="form-control" value="<?= $a['isi_pallet'] ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <form action="<?= base_url('pages/delalldata') ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="id" value="<?= $a['id'] ?>">
                                                <input type="hidden" name="tanggal" value="<?= $a['tanggal'] ?>">
                                                <input type="hidden" name="sku" value="<?= $a['sku'] ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                <?php endif ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>