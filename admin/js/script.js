function convertToRupiah(angka) {
    var rupiah = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    }).format(angka);
    return rupiah;
}

function formatRupiah() {
    var hargaInput = document.getElementById('harga');
    hargaInput.value = convertToRupiah(hargaInput.value.replace(/\D/g, ''));
}