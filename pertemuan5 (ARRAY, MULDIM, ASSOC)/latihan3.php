<!-- array associative -->

<?php

    $mahasiswa = [

        ["Arkan","48985","Teknik Informatika","maullbusinesmas@gmail.com"],
        ["Naviz","27382","Teknik Farmasi","napiss@gmail.com"],
        ["Adam","473842","Teknik Perairan","adamm@gmail.com"],

    ];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Mahasiswa</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>
    <?php foreach ($mahasiswa as $mhs) : ?>
    <ul>
        <li>Nama : <?= $mhs[0]; ?></li>
        <li>NRP : <?= $mhs[1]; ?></li>
        <li>Jurusan : <?= $mhs[2]; ?></li>
        <li>Email : <?= $mhs[3]; ?></li>
    </ul>
    <?php endforeach; ?>
</body>
</html>