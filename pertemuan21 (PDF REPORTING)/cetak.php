<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';
require_once __DIR__ . '/vendor/autoload.php';  // load mPDF

$mahasiswa = query("SELECT * FROM mahasiswa");

// mulai isi HTML untuk PDF
$html = '
<h2 style="text-align:center;">DAFTAR MAHASISWA</h2>
<br>
<table border="1" cellspacing="0" cellpadding="8" width="100%">
    <tr>
        <th>No.</th>
        <th>Gambar</th>
        <th>NRP</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
    </tr>';

$i = 1;
foreach ($mahasiswa as $row) {
    $html .= '
    <tr>
        <td>' . $i++ . '</td>
        <td><img src="img/' . $row["gambar"] . '" width="50"></td>
        <td>' . $row["nrp"] . '</td>
        <td>' . $row["nama"] . '</td>
        <td>' . $row["email"] . '</td>
        <td>' . $row["jurusan"] . '</td>
    </tr>';
}

$html .= '</table>';

// buat instance mPDF dan render PDF
$mpdf = new \Mpdf\Mpdf([
    'default_font_size' => 10,
    'default_font' => 'Arial'
]);

$mpdf->WriteHTML($html);
$mpdf->Output('daftar-mahasiswa.pdf', 'I');  // I = inline (tampil di browser)
