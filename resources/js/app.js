import './bootstrap';
import Swal from 'sweetalert2';

// Membuat SweetAlert2 tersedia secara global
window.Swal = Swal;

// Global success message
window.showSuccess = function(message) {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: message,
        confirmButtonColor: '#0891b2',
        timer: 3000,
        timerProgressBar: true
    });
};

// Global error message
window.showError = function(message) {
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: message,
        confirmButtonColor: '#dc2626'
    });
};

// Global confirmation dialog
window.showConfirm = function(message, callback) {
    Swal.fire({
        title: 'Konfirmasi',
        text: message,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0891b2',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed && callback) {
            callback();
        }
    });
};

// Loading overlay
window.showLoading = function(message = 'Memproses...') {
    Swal.fire({
        title: message,
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
};

// Hide loading
window.hideLoading = function() {
    Swal.close();
};


document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide success messages
    const alerts = document.querySelectorAll('.alert-success');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});
