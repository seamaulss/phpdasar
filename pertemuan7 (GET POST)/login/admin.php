<!-- contoh ketika sudah login tampil seperti ini, cuman ini masih default -->

<?php 
session_start();

    if (isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }

    $nama = $_SESSION["nama"] ?? "arkan";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
</head>
<body>
    
    <h1>Selamat Datang, <?= htmlspecialchars($nama) ?></h1>

    <a href="login.php">logout</a>


</body>
</html>