<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "pd_db");

// ambil data dari tabel mahasiswa / query data mahasiswa
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// cari data mahasiswa berdasarkan keyword
function cari($keyword)
{
    $query = "SELECT mahasiswa.*, jurusan.nama_jurusan
              FROM mahasiswa
              LEFT JOIN jurusan ON mahasiswa.jurusan_id = jurusan.id
              WHERE 
                    mahasiswa.nama LIKE '%$keyword%' OR
                    mahasiswa.nrp LIKE '%$keyword%' OR
                    mahasiswa.email LIKE '%$keyword%' OR
                    jurusan.nama_jurusan LIKE '%$keyword%'";

    return query($query);
}


function ubah($data)
{
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan_id = htmlspecialchars($data["jurusan_id"]); // ganti jurusan -> jurusan_id
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE mahasiswa SET
                nama = '$nama',
                nrp = '$nrp',
                email = '$email',
                jurusan_id = '$jurusan_id',
                gambar = '$gambar'
              WHERE id = $id";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function ubahjurusan($data)
{
    global $conn;

    $id = intval($data["id"]);
    $nama_jurusan = htmlspecialchars($data["nama_jurusan"]);

    $query = "UPDATE jurusan SET
                nama_jurusan = '$nama_jurusan'
              WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}



// tambah data
function tambah($data)
{
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan_id = htmlspecialchars($data["jurusan_id"]);

    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO mahasiswa (nama, nrp, email, gambar, jurusan_id)
          VALUES ('$nama', '$nrp', '$email', '$gambar', '$jurusan_id')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahjurusan($data)
{
    global $conn;
    $nama_jurusan = htmlspecialchars($data["nama_jurusan"]);

    $query = "INSERT INTO jurusan (nama_jurusan) VALUES ('$nama_jurusan')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// upload gambar
function upload()
{

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('Yang anda upload bukan gambar!');
              </script>";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar!');
              </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

// hapus data
function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function hapusjurusan($id)
{
    global $conn;

    // Cek apakah jurusan sedang dipakai mahasiswa
    $cek = query("SELECT * FROM mahasiswa WHERE jurusan_id = $id");
    if (count($cek) > 0) {
        // Tidak boleh hapus (mencegah error foreign key)
        return 0;
    }

    mysqli_query($conn, "DELETE FROM jurusan WHERE id = $id");
    return mysqli_affected_rows($conn);
}



// registrasi user baru
function register($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar!');
              </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
              </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");
    return mysqli_affected_rows($conn);
}
