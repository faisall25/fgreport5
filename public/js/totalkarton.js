$(function(){
    function loadTotalKarton(){
        $.ajax({
            url: BASE_URL + 'pages/getTotalKarton',
            method: 'post',
            success: function(html) {
                $('#totalKarton').html(html);
            },
            error: function() {
                console.error('Gagal memuat data dari server.');
            }
        });
    }
    setInterval(loadTotalKarton, 1000);
        loadTotalKarton();
});