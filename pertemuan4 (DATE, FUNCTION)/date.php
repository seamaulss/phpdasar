<?php
    // Date
    // Untuk menampilkan tanggal dengan format tertentu
    // echo date("d m h i Y");

    // time
    // UNIX Timestamp / EPOCH time
    // detik yang sudah berlalu dari 1 Januari 1970
    // echo time();
    // echo date("d M Y", time()-60*60*24*100);

    // mktime
    // membuat sendiri detik
    // mktime (0,0,0,0,0,0)
    // jam, menit, detik, bulan, tanggal, tahun
    // echo mktime(0,0,0,3,18,2008);

    // strtotime 
    $tanggal = date("l", strtotime("18 Mar 2008"));
    // echo date("l", strtotime("18 Mar 2008"));
    echo $tanggal;
?>
