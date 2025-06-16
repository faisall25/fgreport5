$(function(){
    function loadProdTime(){
        $.ajax({
            url: BASE_URL + 'pages/getProdTime',
            method: 'post',
            success: function(html) {
                $('#prodTime').html(html);
            },
            error: function() {
                console.error('Gagal memuat data dari server.');
            }
        });
    }
    setInterval(loadProdTime, 1000);
        loadProdTime();
});