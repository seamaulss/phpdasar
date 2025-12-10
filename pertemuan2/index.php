<?php

    // Pertemuan 2 - PHP DASAR

    # Sintaks PHP
    
    /*
    Standar Output
    echo, print
    print_r
    var_dump
    */

    // Penulisan sintaks PHP
    // 1. PHP di dalam HTML
    // 2. HTML di dalam PHP

    // Variabel dan Tipe Data
    // Variabel
    // tidak boleh diawali dengan angka, tapi boleh mengandung angka

    $nama1 = "Arkan";

    // echo "<p>Hai</p> ";
    // print ('Arkan ');
    // print_r ('Maulidhana ');
    // var_dump ('Arkan Maulidhana Nurfalah');

    // Operator
    // Aritmatika
    // + - * / %

    // $x = 12;
    // $y = 10;
    // echo $x * $y;

    // Penggabungan string / concatenation / concat

    // $nama_saya = "Arkan Maulidhana Nurfalah";
    // $nama_call = "<p>Bisa dipanggil Arkan | Maul</p>";
    // echo $nama_saya .  $nama_call;

    // assigment
    // = , += , -= , *= , %= , .= , /=
    // $x = "12";
    // $y = "24";
    // echo $x -= $y;
    // $nama = "Arkan ";
    // $nama .= "";
    // $nama .= "Maulidhana Nurfalah";
    // echo $nama;

    // Perbandingan
    // < , > , <= , >= , ==, !=
    // var_dump (5 == 5);

    // identitas
    // ===, !==
    // var_dump (1 !== "2")

    // Logika
    // ||, &&, !
    // $n = 20;
    // var_dump($n < 10 || $n % 2 == 0);
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Pertemuan - 2</title>
</head>
<body>
    <h1>Hai <?php echo $nama1 ?></h1>
</body>
</html> 