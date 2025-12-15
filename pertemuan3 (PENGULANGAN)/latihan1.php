<?php

    // Belajar pengulangan/Looping seperti
    // for : perulangan dengan jumlah yang pasti atau terukur.
    // while : digunakan untuk perulangan selama kondisi bernilai true.
    // do... while : digunakan untuk perulangan minimal satu kali, karena kondisi dicek setelah kode dijalankan.
    // foreach : pengulangan khusus array
    // if else : menjalankan kode tertentu jika kondisi terpenuhi.
    // else if : untuk banyak kondisi
    // Switch Case: Mirip if, tapi lebih rapi untuk memeriksa banyak nilai tertentu.

    // for ( $i = 0; $i < 5; $i++ ) {
    //  echo "Hello World! <br>";
    // }

    // $i = 0;
    // while ( $i  < 5 ) {
    //  echo "Hello World! <br>";
    //  $i++;
    // };

    // $i = 5;
    // do {
    //     echo "Hai";
    //     $i++;
    // } while ( $i < 10);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Latihan 1</title>
    <style>
         .warna-baris {
            background-color: greenyellow;
         }
    </style>
</head>
<body>
    
    <table border="1" cellpadding="10" cellspacing="0">

        <?php for( $i = 1; $i <= 5; $i++ ) : ?>
            <?php if( $i % 2 == 1 ) : ?>
            <tr class="warna-baris">
                <?php else : ?>
                <tr>
                <?php endif ?>
                <?php for( $j = 1; $j <= 5; $j++ ) : ?>
                    <td><?=  "$i, $j"; ?></td>
                    <?php endfor; ?>
                    
            </tr>

        <?php endfor; ?>
    </table>

</body>
</html>