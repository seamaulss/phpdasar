<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "pd_db");

// cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

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

// ======================= FUNGSI UBAH (SUDAH BENAR) =======================
function ubah($data)
{
    global $conn;

    $id         = $data["id"];
    $nama       = htmlspecialchars($data["nama"]);
    $nrp        = htmlspecialchars($data["nrp"]);
    $email      = htmlspecialchars($data["email"]);

    // PASTI DAPAT jurusan_id: baru atau lama
    $jurusan_id = !empty($data["jurusan_id"]) ? $data["jurusan_id"] : $data["jurusan_id_lama"];
    $gambarLama = $data["gambarLama"];

    // Upload gambar baru?
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
        if (!$gambar) return false;
    }

    $query = "UPDATE mahasiswa SET
                nama       = '$nama',
                nrp        = '$nrp',
                email      = '$email',
                jurusan_id = '$jurusan_id',
                gambar     = '$gambar'
              WHERE id = $id";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// ======================= FUNGSI TAMBAH (DIBENARKAN) =======================
function tambah($data)
{
    global $conn;

    $nama       = htmlspecialchars($data["nama"]);
    $nrp        = htmlspecialchars($data["nrp"]);
    $email      = htmlspecialchars($data["email"]);
    $jurusan_id = $data["jurusan_id"];  // bukan nama jurusan, tapi ID!

    // Upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO mahasiswa (nama, nrp, email, jurusan_id, gambar) 
              VALUES ('$nama', '$nrp', '$email', '$jurusan_id', '$gambar')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// ======================= FUNGSI UPLOAD GAMBAR (WAJIB ADA!) =======================
function upload()
{
    $namaFile   = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error      = $_FILES['gambar']['error'];
    $tmpName    = $_FILES['gambar']['tmp_name'];

    // jika tidak ada gambar diupload (hanya saat tambah data, wajib upload)
    if ($error === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu!');</script>";
        return false;
    }

    // cek ekstensi
    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiFile  = explode('.', $namaFile);
    $ekstensiFile  = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiValid)) {
        echo "<script>alert('File harus berupa gambar (jpg, jpeg, png)!');</script>";
        return false;
    }

    // cek ukuran maks 2MB
    if ($ukuranFile > 2000000) {
        echo "<script>alert('Ukuran gambar maksimal 2MB!');</script>";
        return false;
    }

    // generate nama unik
    $namaFileBaru = uniqid() . '.' . $ekstensiFile;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

// ======================= FUNGSI HAPUS =======================
function hapus($id)
{
    global $conn;

    // ambil nama gambar lama untuk dihapus dari folder
    $mhs = query("SELECT gambar FROM mahasiswa WHERE id = $id")[0];
    if ($mhs['gambar'] != 'default.jpg') {  // jangan hapus gambar default
        unlink('img/' . $mhs['gambar']);
    }

    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}
