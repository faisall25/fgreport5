<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add target</h1>
    <form action="<?= base_url('pages/savetarget') ?>" method="post">
        <?= csrf_field(); ?>
        <div class="mb-3">
            <label for="line">Pilih Line</label>
            <select id="line" name="nama_line" class="form-select">
                <option selected disabled>-- Pilih Line --</option>
                <?php foreach ($lineTarget as $lt): ?>
                    <option value="<?= $lt['nama_line'] ?>"><?= $lt['nama_line'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="sku">Pilih SKU</label>
            <select id="sku" name="nama_sku" class="form-select">
                <option selected disabled>-- Pilih SKU --</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">ID SKU</span>
            <input type="text" class="form-control" id="id_sku" name="id_sku" readonly>
        </div>

        <input type="hidden" class="form-control" id="id_line" name="id_line" readonly>

        <div class="mb-3">
            <label for="target" class="form-label">Isi target</label>
            <input type="text" class="form-control" id="target" name="target" placeholder="Target produksi">
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Tambah keterangan</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan produksi">
        </div>
        <!-- <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<?= $this->endSection(); ?>