<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<?php $role = session()->get('role'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Setting Target Produksi</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <a class="btn btn-primary mb-3" href="<?= base_url('' . $role . '/addtarget') ?>" role="button">Tambah target</a>
            <?php if (session()->getFlashdata('success')) : ?>
                <div id="alert-success" class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success'); ?>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                </div>
            <?php endif ?>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Line</th>
                            <th>SKU</th>
                            <th>Target</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($target as $t): ?>
                            <tr>
                                <td><?= $t['id_sku']; ?></td>
                                <td><?= $t['nama_line']; ?></td>
                                <td><?= $t['nama_sku']; ?></td>
                                <td><?= $t['target']; ?></td>
                                <td><?= $t['keterangan']; ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEdit<?= $t['id_sku'] ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="modalEdit<?= $t['id_sku'] ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <form action="<?= base_url('pages/updatetarget') ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="id_sku" value="<?= $t['id_sku'] ?>">

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Target</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label>Line</label>
                                                                <input type="text" name="nama_line" value="<?= $t['nama_line'] ?>" class="form-control" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>SKU</label>
                                                                <input type="text" name="nama_sku" value="<?= $t['nama_sku'] ?>" class="form-control" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Target</label>
                                                                <input type="text" name="target" value="<?= $t['target'] ?>" class="form-control" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Keterangan</label>
                                                                <input type="text" name="keterangan" value="<?= $t['keterangan'] ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <form action="<?= base_url('pages/deltarget') ?>" method="post" style="display:inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id_sku" value="<?= $t['id_sku'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')"><i class="bi bi-trash3-fill"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>