$(function(){
    $('#nama_lineManual').on('change', function(){
        var nama_line = $(this).val();

        $.ajax({
            url: BASE_URL +'/pages/getSkuByLineManual',
            method: 'POST',
            data: { nama_line: nama_line },
            success: function (res) {
                $('#nama_skuManual').html('<option disabled selected>-- Pilih SKU --</option>');
                $.each(res, function (i, sku) {
                $('#nama_skuManual').append('<option value="' + sku.nama_sku + '" data-id_sku="' + sku.id_sku + '" data-id_line="' + sku.id_line + '">' + sku.nama_sku + '</option>');
            });
        },
      error: function () {
        alert('Gagal mengambil data SKU');
      }
        })
    })

    $('#nama_skuManual').on('change', function () {
    var id_sku = $(this).find(':selected').data('id_sku');
    var id_line = $(this).find(':selected').data('id_line');
    $('#id_skuManual').val(id_sku); 
    $('#id_lineManual').val(id_line); 

    $.ajax({
        url: BASE_URL +'/pages/getLineByIdSku',
            method: 'POST',
            data: { id_sku: id_sku },
            success: function(res){
                if (res.success) {
                $('#no_palletManual').val(res.data.no_pallet);
                $('#jml_kartonManual').val(res.data.jml_karton);
            } else {
                alert('Data tidak ditemukan');
                $('#no_pallet').val('');
                $('#jml_karton').val('');
            }
            },
            error: function() {
            alert('Terjadi kesalahan saat mengambil data');
        }
    })
    });
});