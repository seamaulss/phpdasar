<!-- Form Input dengan POST

Kita belajar mengirim data dari form ke halaman yang sama menggunakan method="post".

Data yang dikirim tidak muncul di URL.

Bisa diakses dengan $_POST["nama"].

Kondisional (if)

Mengecek apakah tombol submit sudah ditekan dengan isset($_POST["submit"]).

Jika ya, tampilkan pesan selamat datang. -->

<!DOCTYPE html>
<html>
<head>
    <title>POST</title>
</head>
<body>
    
    <?php if( isset($_POST["submit"]) ) : ?>
        <h1>Halo, Selamat Datang <?= $_POST["nama"]; ?></h1>
    <?php endif; ?>

    <form action="" method="post">
        Masukkan Nama: 
        <input type="text" name="nama">
        </br>
        <button type="submit" name="submit">Kirim</button>
    </form>

</body>
</html>