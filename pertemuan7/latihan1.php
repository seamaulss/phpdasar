<?php

    $mahasiswa = [
        [
            "nama" => "Arkan", 
            "nrp" => "758475",
            "jurusan" => "Teknik Informatika",
            "gmail" => "arkannn@gmail.com",  
            "gambar" => "cat2.jpg"                       
        ],
        [
            "nama" => "Lawuk", 
            "nrp" => "4758473",
            "jurusan" => "Teknik Macul",
            "gmail" => "lawuk@gmail.com",  
            "gambar" => "cat1.jpg"                       
        ]
    ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <ul>
    <?php foreach ( $mahasiswa as $m ) :?>
        <li>
            <a href="latihan2.php?nama=<?= $m["nama"]; ?>&nrp=
            <?= $m["nrp"]; ?>&jurusan=<?= $m["jurusan"]; ?>&gmail=
            <?= $m["gmail"]; ?>&gambar=<?= $m["gambar"]; ?>">
            <?= $m["nama"]; ?></a>
        </li>
    <?php endforeach; ?>
    </ul>

</body>
</html>