<?php
session_start();
require 'function.php';

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if( $key === hash('sha256', $row['username']) ) {
        $_SESSION['login'] = true;
    }
}

if( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}

    if( isset($_POST["login"]) ) {

        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM user WHERE 
        username = '$username' ");

        // cek username
        if( mysqli_num_rows($result) === 1 ) {

            // cek password
            $row = mysqli_fetch_assoc($result);
            if( password_verify($password, $row["password"]) ) {
                // setting session
                $_SESSION["login"] = true;

                // cek remember me
                if( isset($_POST['remember']) ) {
                    // buat cookie
                    setcookie('id', $row['id'], time() + 60);
                    setcookie('key', hash('sha256', $row['username']), time() + 60);
                }
                
                header("Location: index.php");
                exit;
            }
        }
        $error = true;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">

        <h3 class="text-center mb-4">Login</h3>

        <?php if( isset($error) ) : ?>
            <div class="alert alert-danger py-2">Username / Password salah!</div>
        <?php endif; ?>

        <form action="" method="post">

            <div class="mb-3">
                <label for="username" class="form-label">Username :</label>
                <input type="text" name="username" id="username" class="form-control" autocomplete="off">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password :</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label for="remember" class="form-check-label">Remember Me</label>
            </div>

            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>

        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
