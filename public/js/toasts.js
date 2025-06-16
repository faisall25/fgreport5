window.addEventListener('DOMContentLoaded', () => {
    const toastPesan = document.getElementById('toastPesan');
    const toastError = document.getElementById('toastError');

    if (toastPesan) {
      new bootstrap.Toast(toastPesan).show();
    }

    if (toastError) {
      new bootstrap.Toast(toastError).show();
    }
  });