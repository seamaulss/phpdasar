<!-- menyimpan fungsi query -->
<!-- menyimpan semua fungsi yang berkaitan dengan database, 
sehingga halaman utama tidak penuh dengan kode koneksi SQL. -->

<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "pd_db");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}
?>