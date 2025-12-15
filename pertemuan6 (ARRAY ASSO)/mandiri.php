<!-- Membuat Data Sendiri + Menampilkannya -->
<!-- Mengulang data array associative -->
<!-- Latihan mandiri memahami konsep -->

<?php

$karyawan = [
    [
        "nama" => "Meong",
        "alamat" => "abc",
        "no telp" => "7584758784",
        "gambar" => "69397ad55353b.jpg"
    ],
    [
        "nama" => "Andi",
        "alamat" => "bcd",
        "no telp" => "847587",
        "gambar" => "69397f3616f87.jpg"
    ]
];
?>
<!DOCTYPE html>
<head>
    <title>Latihan Mandiri</title>
</head>
<body>
    
    <?php foreach ( $karyawan as $k ) : ?>
    <ul>
        <div class="gambar">
        <li>
        <img src=img/<?= $k["gambar"];?>
        </li>
        </div>
        <li><?=  $k["nama"]?></li>
        <li><?=  $k["alamat"]?></li>
        <li><?=  $k["no telp"]?></li>
        <li><?=  $k["gambar"]?></li>
    </ul>
    <?php endforeach; ?>

</body>
</html>

