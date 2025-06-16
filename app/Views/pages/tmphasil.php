<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<?php $role = session()->get('role'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Pershift (<?= $identitas; ?>)</h1>
    <input type="text" id="regu" value="<?= $regu; ?>" disabled>
    <input type="text" id="shift" value="<?= $shift; ?>" disabled>

    <!-- tabel PC14 -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- <form action="<?= base_url('' . $role . '/cetaktmphasil') ?>" method="post">
                <button type="submit" class="btn btn-primary">Print</button>
            </form> -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div id="alert-success" class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success'); ?>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                </div>
            <?php endif ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0" id="tabelTmphasil">
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
                        <?php foreach ($hasil as $isi) : ?>
                            <tr>
                                <td> <?= $i; ?> </td>
                                <td> <?= $isi['tanggal']; ?> </td>
                                <td> <?= $isi['line']; ?> </td>
                                <td> <?= $isi['sku']; ?> </td>
                                <td> <?= $isi['no_pallet']; ?> </td>
                                <td> <?= $isi['isi_pallet']; ?> </td>
                                <?php if (in_array($role, ['kasie', 'admin'])) : ?>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-warning btn-sm btn-update"
                                                data-tanggal="<?= $isi['tanggal'] ?>"
                                                data-line="<?= $isi['line'] ?>"
                                                data-sku="<?= $isi['sku'] ?>"
                                                data-pallet="<?= $isi['no_pallet'] ?>"
                                                data-isi="<?= $isi['isi_pallet'] ?>"
                                                data-id_sku="<?= $id_sku ?>">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <form action="<?= base_url('pages/delhasil') ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="id_sku" value="<?= $id_sku ?>">
                                                <input type="hidden" name="tanggal" value="<?= $isi['tanggal'] ?>">
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                <?php endif ?>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<div class="modal fade" id="updateModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('pages/updatehasil') ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="id_sku" id="modal_id_sku">


            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Pallet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Tanggal cetak pallet</label>
                        <input type="text" class="form-control" name="tanggal" id="modal_tanggal" readonly>
                        <!-- <input type="text" class="form-control" name="line" id="modal_line" readonly> -->
                    </div>
                    <div class="mb-3">
                        <label>Line</label>
                        <input type="text" class="form-control" name="line" id="modal_line" readonly>
                    </div>
                    <div class="mb-3">
                        <label>SKU</label>
                        <input type="text" class="form-control" name="sku" id="modal_sku" readonly>
                    </div>
                    <div class="mb-3">
                        <label>No Pallet</label>
                        <input type="text" class="form-control" name="no_pallet" id="modal_no_pallet" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Isi Per-pallet</label>
                        <input type="text" class="form-control" name="isi_pallet" id="modal_isi_pallet" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?= $this->endSection(); ?>