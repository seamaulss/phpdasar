<!-- menyimpan fungsi fungsi yang dibutuhkan -->
<!-- membuat fungsi PHP untuk mengelola data mahasiswa di database, yaitu:
query() → mengambil data (Read)
tambah() → menambahkan data (Create)
hapus() → menghapus data (Delete) -->

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

function  tambah($data) {

    global $conn;
    $nama = $data["nama"];
    $nrp = $data["nrp"];
    $email = $data["email"];
    $jurusan = $data["jurusan"];    
    $gambar = $data["gambar"];

    $query = "INSERT INTO mahasiswa
                VALUES
                ('', '$nama', '$nrp', '$email', '$jurusan', '$gambar')
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);

}

?>