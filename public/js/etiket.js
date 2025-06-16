$(function(){
    function loadEtiket(){
        $.ajax({
        url: BASE_URL + 'pages/getDataEtiket',
        method: 'post',
        success: function(html) {
            $('#tabelEtiket').html(html);
        },
        error: function(xhr) {
            console.error('Gagal ambil data:', xhr.responseText);
        }
    });
    }
    setInterval(loadEtiket, 1000);
$(document).ready(loadEtiket);
});