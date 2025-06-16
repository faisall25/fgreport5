$(function(){
    setTimeout(function() {
        const alert = document.getElementById('alert-success');
        if (alert) {
            alert.remove();
            // alert.classList.add('alert-hidden');
        }
    }, 2000); 
    setTimeout(function() {
        const alert = document.getElementById('alert-error');
        if (alert) {
            alert.remove();
            // alert.classList.add('alert-hidden');
        }
    }, 2000); 
});