<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">



    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">TAMBAH FG</h1>
    <?php if (session()->getFlashdata('success')): ?>
        <div id="alert-success" class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <form action="<?= base_url('pages/savefg') ?>" method="post" id="formValidasi">
        <?= csrf_field(); ?>
        <div class="form-group row">
            <div class="input-group mb-3">
                <input name="scanner" id="scanner" autofocus type="text" class="form-control col-sm-4 scanner" placeholder="Kode SKU" aria-label="Recipient's username" aria-describedby="button-addon2">
                <!-- <button class="btn btn-outline-success" type="button" onclick="startScanner()">Scan</button> -->
                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Simpan</button>
            </div>
        </div>

        <!-- <div id="scanner-area" style="width: 100%; max-width: 400px; height: 200px; margin-top: 10px;"></div> -->

        <div class="form-group row">
            <label for="line" class="col-sm-2 col-form-label" readonly>LINE</label>
            <div class="col-sm-3">
                <input type="text" name="line" style="text-transform: uppercase" class="form-control font-weight-bold" id="line" autocomplete="off" required readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="sku" class="col-sm-2 col-form-label" readonly>SKU</label>
            <div class="col-sm-3">
                <input type="text" name="sku" style="text-transform: uppercase" class="form-control font-weight-bold" id="sku" autocomplete="off" required readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="no_pallet" class="col-sm-2 col-form-label">No. Pallet</label>
            <div class="col-sm-3">
                <input readonly type="text" name="no_pallet" style="text-transform: uppercase" class="form-control" id="no_pallet" autocomplete="off" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="jml_karton" class="col-sm-2 col-form-label">Jumlah Karton</label>
            <div class="col-sm-3">
                <input autocomplete="off" type="number" name="jml_karton" class="form-control" id="jml_karton">

            </div>
        </div>
    </form>

</div>

<?= $this->endSection(); ?>