<!-- Array associative -->
<!-- Menampilkan data array dalam bentuk list HTML -->
<!-- Menampilkan gambar berdasarkan data array -->
<!-- Menggunakan foreach untuk loop data mahasiswa -->



<?php
//  $mahasiswa = [["Arkan","758475","Teknik Informatika","maullbusinesman@gmail.com"],
//  ["Navis","846542","Teknik Farmasi","napiss@gmail.com"],
//  ["Adam","4574857","Teknik Perikanan","adamm@gmail.com"],
// ];

// array associative
// definisinya sama seperti array numerik, kecuali
// key-nya adalah string yang kita buat sendiri

$mahasiswa = [
    [
            "nama" => "Arkan", 
            "nrp" => "758475", 
            "jurusan" => "Teknik Informatika",
            "gmail" => "maullbusinesman@gmail.com",
            "gambar" => "cat2.jpg"
    ],
    [
            "nama" => "Napis", 
            "nrp" => "846542", 
            "jurusan" => "Teknik Farmasi",
            "gmail" => "napiss@gmail.com",
            "gambar" => "cat1.jpg"
    ],
    [
            "nama" => "Adam", 
            "nrp" => "4574857", 
            "jurusan" => "Teknik Perikanan",
            "gmail" => "adamm@gmail.com",
            "gambar" => "cat1.jpg"
    ]
    ];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Mahasiswa</title>
</head>
<body>
    
    <h1>Daftar Mahasiswa</h1>

    <?php foreach ( $mahasiswa as $mhs ) : ?>
    <ul>
        <li>
        <img src="img/<?= $mhs["gambar"]; ?>"
        </li>
        <li>Nama : <?= $mhs["nama"] ?></li>
        <li>NRP : <?= $mhs["nrp"] ?></li>
        <li>Jurusan : <?= $mhs["jurusan"] ?></li>
        <li>Email : <?= $mhs["gmail"] ?></li>
        <li>Gambar : <?= $mhs["gambar"] ?></li>
    </ul>
    <?php endforeach; ?>

</body>
</html>