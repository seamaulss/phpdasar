/*
Membuat live search: tabel mahasiswa diperbarui otomatis saat mengetik.
Memakai AJAX untuk ambil data dari server tanpa reload halaman.
Target update adalah div .container.
Mengirim keyword ke ajax/mahasiswa.php → server yang proses query.
*/

// ambil elemen2 yang dibutuhkan
var keyword = document.getElementById('keyword');
var search = document.getElementById('search');
var container = document.querySelector('.container');

keyword.addEventListener('keyup', function() {

    // buat objek ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            container.innerHTML = xhr.responseText;
        }
    };
    
    // eksekusi ajax
    xhr.open('GET', 'ajax/mahasiswa.php?keyword=' + keyword.value, true);
    xhr.send();
});