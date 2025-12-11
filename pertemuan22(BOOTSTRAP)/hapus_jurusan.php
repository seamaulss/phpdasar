<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

if (!isset($_GET["id"])) {
    echo "<script>
            alert('ID jurusan tidak ditemukan!');
            document.location.href = 'jurusan.php';
          </script>";
    exit;
}

$id = intval($_GET["id"]);

if (hapusjurusan($id) > 0) {
    echo "<script>
            alert('Jurusan berhasil dihapus!');
            document.location.href = 'jurusan.php';
          </script>";
} else {
    echo "<script>
            alert('Jurusan gagal dihapus! Mungkin jurusan sedang dipakai mahasiswa.');
            document.location.href = 'jurusan.php';
          </script>";
}

?>