$(function(){
    function loadHasil(){
        $.ajax({
        url: BASE_URL + 'pages/monitorTabel',
        method: 'post',
        success: function(html) {
            $('#tabelMonitor').html(html);
        },
        error: function(xhr) {
            console.error('Gagal ambil data:', xhr.responseText);
        }
    });
    }
    setInterval(loadHasil, 1000);
$(document).ready(loadHasil);

function loadDateTime() {
        $.ajax({
            url: BASE_URL + 'pages/getDateTime',
            method: 'post',
            success: function(html) {
                $('#dateTime').html(html);
            },
            error: function() {
                console.error('Gagal memuat data dari server.');
            }
        });

        
    }
    setInterval(loadDateTime, 1000);
        loadDateTime();
});