<?php
// cek apakah tombol submit sudah ditekan
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // cek username & password
    if ($username === "admin" && $password === "123") {
        $nama = "Admin"; // bisa ganti sesuai kebutuhan
        // redirect ke halaman admin.php dengan query string
        header("Location: admin.php?nama=" . urlencode($nama));
        exit;
    } else {
        $error = true;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
</head>
<body>

    <h1>Login Admin</h1>

    <?php if (isset($error)) : ?>
        <p style="color: red; font-style: italic;">Username / password salah</p>
    <?php endif; ?>

    <form action="" method="post">
        <div>
            <label for="username">Username: </label>
            <input type="text" name="username" id="username" required>
        </div>
        <br>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" required>
        </div>
        <br>
        <div>
            <button type="submit" name="submit">Login</button>
        </div>
    </form>

</body>
</html>
