<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <?php if (session()->getFlashdata('success')) : ?>
        <div id="alert-success" class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success'); ?>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
    <?php endif ?>
    <div class="col">
        <div class="card shadow mb-3">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Setting Packing Machine</h6>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID SKU</th>
                                <th>SKU</th>
                                <th>Jumlah Mesin</th>
                                <th>Speed</th>
                                <th>Downtime</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mesinData as $m): ?>
                                <tr>
                                    <td><?= $m['id_sku']; ?></td>
                                    <td><?= $m['nama_sku']; ?></td>
                                    <td><?= $m['jml_mesin']; ?></td>
                                    <td><?= $m['speed']; ?></td>
                                    <td><?= $m['downtime']; ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-warning btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEdit<?= $m['id_sku'] ?>">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="modalEdit<?= $m['id_sku'] ?>" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <form action="<?= base_url('pages/updatemesin') ?>" method="post">
                                                        <?= csrf_field(); ?>

                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Mesin</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label>ID SKU</label>
                                                                    <input type="text" name="id_sku" value="<?= $m['id_sku'] ?>" class="form-control" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Nama SKU</label>
                                                                    <input type="text" name="nama_sku" value="<?= $m['nama_sku'] ?>" class="form-control" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Jumlah Mesin</label>
                                                                    <input type="text" name="jml_mesin" value="<?= $m['jml_mesin'] ?>" class="form-control">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Speed</label>
                                                                    <input type="text" name="speed" value="<?= $m['speed'] ?>" class="form-control">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Downtime</label>
                                                                    <input type="text" name="downtime" value="<?= $m['downtime'] ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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

</div>

<?= $this->endSection(); ?>