
<!-- GET (mengambil data lewat URL) dan menampilkan data secara dinamis di halaman.
Ini berbeda dengan latihan3 yang pakai POST dan form. -->
<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
</head>
<body>
    <h1>Selamat Datang, <?= $_GET["nama"]; ?></h1>
</body>
</html>