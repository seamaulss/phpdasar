<?php

require 'function.php';

if( isset($_POST["register"])) {

    if( register($_POST) > 0 ) {
        echo "<script>
            alert('user baru berhasil ditambahkan!');
        </script>
        ";
    } else {
        echo mysqli_error($conn);
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .log {
            color: white;
        }
    </style>
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">

        <h3 class="text-center mb-4">Halaman Register</h3>

        <?php if (isset($error)) : ?>
            <div class="alert alert-danger py-2">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">

            <div class="mb-3">
                <label for="username" class="form-label">Username :</label>
                <input type="text" name="username" id="username"
                       class="form-control" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password :</label>
                <input type="password" name="password" id="password"
                       class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password2" class="form-label">Konfirmasi Password :</label>
                <input type="password" name="password2" id="password2"
                       class="form-control" required>
            </div>

            <button type="submit" name="register"
                    class="btn btn-primary w-100">
                Register | <a href="login.php" class="log">Login</a>
            </button>

        </form>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
