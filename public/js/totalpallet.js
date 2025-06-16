$(function(){
    function loadTotalPallet(){
        $.ajax({
            url: BASE_URL + 'pages/getTotalPallet',
            method: 'post',
            success: function(html) {
                $('#totalPallet').html(html);
            },
            error: function() {
                console.error('Gagal memuat data dari server.');
            }
        });
    }
    setInterval(loadTotalPallet, 1000);
        loadTotalPallet();
});