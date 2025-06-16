$(function(){
    $('#line').on('change', function(){
        var nama_line = $(this).val();

        $.ajax({
            url: BASE_URL +'/pages/getSkuByLine',
            method: 'POST',
            data: { nama_line: nama_line },
            success: function (res) {
                $('#sku').html('<option disabled selected>-- Pilih SKU --</option>');
                $.each(res, function (i, sku) {
                // $('#sku').append('<option value="' + sku.nama_sku + '" data-id="' + sku.id_sku + '">' + sku.nama_sku + '</option>');
                $('#sku').append('<option value="' + sku.nama_sku + '" data-id="' + sku.id_sku + '" data-id_line="' + sku.id_line + '">' + sku.nama_sku + '</option>');
            });
        },
      error: function () {
        alert('Gagal mengambil data SKU');
      }
        })
    })

    $('#sku').on('change', function () {
    var id = $(this).find(':selected').data('id');
    var id_line = $(this).find(':selected').data('id_line');
    $('#id_sku').val(id); 
    $('#id_line').val(id_line); 
    });
});