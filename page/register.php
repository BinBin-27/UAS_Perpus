<?php
include "../function/connection.php";

session_start();

$message = '';
if (isset($_SESSION['name'])) {
    header('Location: index.php?halaman=home');
    exit;
}

try {
    if (isset($_POST['register'])) {
        $nama = htmlspecialchars($_POST['name']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = mysqli_query($connection, "INSERT INTO user VALUES (null, '$nama', '$username', '$encryptedPassword')");

        if ($query == TRUE) {
            $_SESSION['message'] = '
            <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050; display: inline-block;">
                <strong>Berhasil:</strong> Pendaftaran Berhasil
                <button type="button" class="btn-close" style="margin-left: 2%" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            header('Location: login.php');
            exit;
        } else {
            $_SESSION['message'] = '
            <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050; display: inline-block;">
                <strong>Gagal:</strong> Username/Password Salah
                <button type="button" class="btn-close" style="margin-left: 2%" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
} catch (\Throwable $th) {
    $_SESSION['message'] = '
    <div class="alert alert-warning alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050; display: inline-block;">
        <strong>Gagal:</strong> Server error!
        <button type="button" class="btn-close" style="margin-left: 2%" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="../assets/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../style/style.css">
    <title>Register</title>
</head>

<body class="bg">
    <?php 
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
    <a href="login.php">
        <img src="../assets/img/logoku.png" style="width: 300px; height:80px;" />
    </a>
    <div style="margin-left: 32%; margin-top: 5%;">
        <div class="card text-center mb-3" style="width: 30rem;">
            <div class="card-body">

                <h3 class="card-title">Register</h3>
                <p class="card-text mt-3 mb-3">Silahkan Mendaftar Dengan Melengkapi Data Dibawah Ini</p>

                <form action="" method="post">
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Nama Lengkap" name="name"
                            required />
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Username" name="username"
                            required />
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Password"
                            name="password" required />
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-1"
                        name="register">Daftar</button>
                </form>
                <div class="text-center mt-3 text-md fs-4">
                    <p class="text-gray-600">
                        Sudah Punya Akun?
                        <a href="login.php" class="font-bold">Masuk</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>