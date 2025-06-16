$(function(){
    $('#scanner').on('change', function(){
    var id_sku = $(this).val();
    $.ajax({
        url: BASE_URL +'/pages/getLineByIdSku',
            method: 'POST',
            data: { id_sku: id_sku },
            success: function(res){
                if (res.success) {
                $('#line').val(res.data.nama_line);
                $('#sku').val(res.data.nama_sku);
                $('#no_pallet').val(res.data.no_pallet);
                $('#jml_karton').val(res.data.jml_karton);
            } else {
                alert('Data tidak ditemukan');
                
                $('#line').val('');
                $('#sku').val('');
                $('#no_pallet').val('');
                $('#jml_karton').val('');

                $('#scanner').val('').focus();
            }
            },
            error: function() {
            alert('Terjadi kesalahan saat mengambil data');
        }
    })
})

});