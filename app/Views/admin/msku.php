<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<?php $role = session()->get('role'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Database SKU</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <a class="btn btn-primary mb-3" href="<?= base_url('' . $role . '/addsku') ?>" role="button">Tambah sku</a>
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
                            <th>id_sku</th>
                            <th>nama_sku</th>
                            <th>jml_karton</th>
                            <th>isi_karton</th>
                            <th>std_etiket</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($msku as $ms): ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $ms['id_line']; ?></td>
                                <td><?= $ms['nama_line']; ?></td>
                                <td><?= $ms['id_sku']; ?></td>
                                <td><?= $ms['nama_sku']; ?></td>
                                <td><?= $ms['jml_karton']; ?></td>
                                <td><?= $ms['isi_karton']; ?></td>
                                <td><?= $ms['std_etiket']; ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEdit<?= $ms['id_sku'] ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="modalEdit<?= $ms['id_sku'] ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <form action="<?= base_url('admin/updatesku') ?>" method="post">
                                                    <?= csrf_field(); ?>

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit SKU</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label>id_line</label>
                                                                <input type="text" name="mid_line" value="<?= $ms['id_line'] ?>" class="form-control" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>nama_line</label>
                                                                <input type="text" name="mnama_line" value="<?= $ms['nama_line'] ?>" class="form-control" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>id_sku</label>
                                                                <input type="text" name="mid_sku" value="<?= $ms['id_sku'] ?>" class="form-control" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>nama_sku</label>
                                                                <input type="text" name="mnama_sku" value="<?= $ms['nama_sku'] ?>" class="form-control">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>jml_karton</label>
                                                                <input type="text" name="mjml_karton" value="<?= $ms['jml_karton'] ?>" class="form-control">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>isi_karton</label>
                                                                <input type="text" name="misi_karton" value="<?= $ms['isi_karton'] ?>" class="form-control">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>std_etiket</label>
                                                                <input type="text" name="mstd_etiket" value="<?= $ms['std_etiket'] ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <form action="<?= base_url('admin/delsku') ?>" method="post" style="display:inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="mid_sku" value="<?= $ms['id_sku'] ?>">
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