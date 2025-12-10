<?php

usleep(500000); // delay 0.5 detik

require '../function.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM mahasiswa
            WHERE
            nama LIKE '%$keyword%' OR
            nrp LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'";
$mahasiswa = query($query);

?>

<div class="table-responsive">
<table class="table table-bordered table-striped">

    <thead>
    <tr>
        <th>No.</th>
        
        <th>Gambar</th>
        <th>NRP</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
        <th>Aksi</th>
    </tr>
    </thead>

    <tbody>
    <?php $i = 1; ?>
    <?php foreach ($mahasiswa as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            
            <td><img src="/phpdasar/pertemuan22(BOOTSTRAP)/img/<?= $row["gambar"]; ?>" width="50" class="img-thumbnail"></td>
            <td><?= $row["nrp"]; ?></td>
            <td><?= $row["nama"]; ?></td>
            <td><?= $row["email"]; ?></td>
            <td><?= $row["jurusan"]; ?></td>

            <td>
                <a href="ubah.php?id=<?= $row["id"]; ?>" class="btn btn-warning btn-sm">ubah</a> |
                <a href="hapus.php?id=<?= $row["id"]; ?>" 
                    onclick="return confirm('yakin?');" 
                    class="btn btn-danger btn-sm">hapus</a>
            </td>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
    </tbody>

</table>
</div>
