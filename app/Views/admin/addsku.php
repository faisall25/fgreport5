<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah SKU</h1>
    <form action="<?= base_url('admin/savesku') ?>" method="post">
        <?= csrf_field(); ?>
        <div class="mb-3">
            <label for="mnama_line">nama_line</label>
            <select id="mnama_line" name="mnama_line" class="form-select">
                <option selected disabled>-- Pilih Line --</option>
                <?php foreach ($mline as $ml): ?>
                    <option value="<?= $ml['nama_line'] ?>" data-mid_line="<?= $ml['id_line']; ?>"><?= $ml['nama_line'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">id_line</span>
            <input type="text" class="form-control" id="mid_line" name="mid_line" readonly>
        </div>

        <div class="mb-3">
            <label for="mid_sku" class="form-label">id_sku</label>
            <input type="text" class="form-control" id="mid_sku" name="mid_sku">
        </div>
        <div class="mb-3">
            <label for="mnama_sku" class="form-label">nama_sku</label>
            <input type="text" class="form-control" id="mnama_sku" name="mnama_sku">
        </div>
        <div class="mb-3">
            <label for="mjml_karton" class="form-label">jml_karton</label>
            <input type="text" class="form-control" id="mjml_karton" name="mjml_karton">
        </div>
        <div class="mb-3">
            <label for="misi_karton" class="form-label">isi_karton</label>
            <input type="text" class="form-control" id="misi_karton" name="misi_karton">
        </div>
        <div class="mb-3">
            <label for="mstd_etiket" class="form-label">std_etiket</label>
            <input type="text" class="form-control" id="mstd_etiket" name="mstd_etiket">
        </div>
        <!-- <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<?= $this->endSection(); ?>