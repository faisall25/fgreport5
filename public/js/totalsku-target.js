$(function(){
    function loadTotalSku(){
        $.ajax({
            url: BASE_URL + 'pages/getTotalSku',
            method: 'post',
            success: function(html) {
                $('#totalSku').html(html);
            },
            error: function() {
                console.error('Gagal memuat data dari server.');
            }
        });
    }
    function loadTotalTarget(){
        $.ajax({
            url: BASE_URL + 'pages/getTotalTarget',
            method: 'post',
            success: function(html) {
                $('#totalTarget').html(html);
            },
            error: function() {
                console.error('Gagal memuat data dari server.');
            }
        });
    }
    setInterval(loadTotalSku, 1000);
        loadTotalSku();
    setInterval(loadTotalTarget, 1000);
        loadTotalTarget();
});