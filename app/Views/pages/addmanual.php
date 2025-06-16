<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add FG Manual</h1>
    <?php if (session()->getFlashdata('success')) : ?>
        <div id="alert-success" class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif ?>
    <form action="<?= base_url('pages/savefgmanual') ?>" method="post">
        <?= csrf_field(); ?>
        <div class="mb-3">
            <label for="nama_lineManual">Pilih Line</label>
            <select id="nama_lineManual" name="nama_lineManual" class="form-select">
                <option selected disabled>-- Pilih Line --</option>
                <?php foreach ($lineManual as $ln): ?>
                    <option value="<?= $ln['nama_line'] ?>"><?= $ln['nama_line'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="nama_skuManual">Pilih SKU</label>
            <select id="nama_skuManual" name="nama_skuManual" class="form-select">
                <option selected disabled>-- Pilih SKU --</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">ID SKU</span>
            <input type="text" class="form-control" id="id_skuManual" name="id_skuManual" readonly>
        </div>
        <input type="hidden" class="form-control" id="id_lineManual" name="id_lineManual" readonly>

        <div class="mb-3">
            <label for="no_palletManual" class="form-label">No Pallet</label>
            <input type="text" class="form-control" id="no_palletManual" name="no_palletManual" readonly>
        </div>
        <div class="mb-3">
            <label for="jml_kartonManual" class="form-label">Isi Pallet </label>
            <input type="text" class="form-control" id="jml_kartonManual" name="jml_kartonManual">
        </div>
        <!-- <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<?= $this->endSection(); ?>