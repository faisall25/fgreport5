$(document).on('click', '.btn-update', function () {
    $('#modal_id_sku').val($(this).data('id_sku'));
    $('#modal_tanggal').val($(this).data('tanggal'));
    $('#modal_line').val($(this).data('line'));
    $('#modal_sku').val($(this).data('sku'));
    $('#modal_no_pallet').val($(this).data('pallet'));
    $('#modal_isi_pallet').val($(this).data('isi'));

    $('#updateModal').modal('show');
});