$(function(){
    $('#mnama_line').on('change', function () {
        var mid_line = $(this).find(':selected').data('mid_line');
        $('#mid_line').val(mid_line);
    });
});