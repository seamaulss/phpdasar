<!-- GET Method: mengambil data dari URL secara aman.

Operator Null Coalescing (??): memberi nilai default jika data tidak ada.

Keamanan output: belajar cara menampilkan data user tanpa risiko XSS. -->


<?php 

    $nama = $_GET["nama"] ?? null;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <style>

        .contain {
            text-align: center;
        }

    </style>
</head>
<body>
        <div class="contain">

            <h1>Selamat Datang, <?= htmlspecialchars($nama) ?></h1>

        </div>
</body>
</html>