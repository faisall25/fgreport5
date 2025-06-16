<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<?php $role = session()->get('role'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Database Line</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahLine">Tambah line</button>
            <!-- Modal Tambah Line -->
            <div class="modal fade" id="modalTambahLine" tabindex="-1">
                <div class="modal-dialog">
                    <form action="<?= base_url('admin/tambahline') ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">tambah Line</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>id_line</label>
                                    <input type="text" name="mid_line" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>nama_line</label>
                                    <input type="text" name="mnama_line" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                            <th>#</th>
                            <th>id_line</th>
                            <th>nama_line</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($mline as $ml): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $ml['id_line']; ?></td>
                                <td><?= $ml['nama_line']; ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEdit<?= $ml['id_line'] ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="modalEdit<?= $ml['id_line'] ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <form action="<?= base_url('admin/updateline') ?>" method="post">
                                                    <?= csrf_field(); ?>

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Line</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label>id_line</label>
                                                                <input type="text" name="mid_line" value="<?= $ml['id_line'] ?>" class="form-control">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>nama_line</label>
                                                                <input type="text" name="mnama_line" value="<?= $ml['nama_line'] ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <form action="<?= base_url('' . $role . '/delline') ?>" method="post" style="display:inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="mid_line" value="<?= $ml['id_line'] ?>">
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