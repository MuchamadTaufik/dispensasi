window.addEventListener('DOMContentLoaded', event => {
    // Dispensasi Keluar DataTable Initialization
    const datatablesSimpleKeluar = document.getElementById('datatablesSimpleKeluar');
    if (datatablesSimpleKeluar) {
        new simpleDatatables.DataTable(datatablesSimpleKeluar);
    }

    // Dispensasi Masuk DataTable Initialization
    const datatablesSimpleMasuk = document.getElementById('datatablesSimpleMasuk');
    if (datatablesSimpleMasuk) {
        new simpleDatatables.DataTable(datatablesSimpleMasuk);
    }
});
