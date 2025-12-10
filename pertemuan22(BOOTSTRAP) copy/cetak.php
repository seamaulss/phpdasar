<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';
require_once __DIR__ . '/vendor/autoload.php';  // load mPDF

$mahasiswa = query("SELECT * FROM mahasiswa");

// CSS untuk tabel PDF
$css = '
    table {
        border-collapse: collapse;
        width: 100%;
        font-size: 12px;
    }
    th {
        background: #f2f2f2;
        font-weight: bold;
        text-align: center;
    }
    th, td {
        border: 1px solid #000;
        padding: 8px;
    }
    img {
        border-radius: 4px;
    }
';

$html = '
<h2 style="text-align:center; margin-bottom:10px;">DAFTAR MAHASISWA</h2>

<table>
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
        <td style="text-align:center;">' . $i++ . '</td>
        <td><img src="img/' . $row["gambar"] . '" width="50"></td>
        <td>' . $row["nrp"] . '</td>
        <td>' . $row["nama"] . '</td>
        <td>' . $row["email"] . '</td>
        <td>' . $row["jurusan"] . '</td>
    </tr>';
}

$html .= '</table>';

// buat PDF
$mpdf = new \Mpdf\Mpdf([
    'default_font_size' => 10,
    'default_font' => 'Arial'
]);

$mpdf->WriteHTML($css, 1);   // CSS
$mpdf->WriteHTML($html, 2);  // HTML

$mpdf->Output('daftar-mahasiswa.pdf', 'I');

