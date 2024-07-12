<?php
session_start();
include "../function/connection.php";

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($connection, "SELECT * FROM user WHERE username='$username'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['message'] = 
        '<div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
            <strong>Berhasil Masuk:</strong> Selamat Datang ' . $username . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script type="text/javascript">
            setTimeout(function() {
                window.location.href = "index.php?halaman=home";
            }, 2000);
        </script>';
        header('Location: index.php?halaman=home');
        exit;
    } else {
        $_SESSION['message'] = 
        '<div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
            <strong>Gagal:</strong> Username/Password Salah
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

// Jika sudah login, arahkan ke halaman home
if (isset($_SESSION['username'])) {
    header('Location: index.php?halaman=home');
    exit;
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
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
    <title>Login</title>
</head>

<body class="bg">
    <?php echo $message; ?>
    <a href="login.php">
        <img src="../assets/img/logoku.png" style="width: 300px; height:80px;" />
    </a>
    <div style="margin-left: 32%; margin-top: 5%;">
        <div class="card text-center mb-3" style="width: 30rem;">
            <div class="card-body">
                <h3 class="card-title">Login</h3>
                <p class="card-text mt-3 mb-3">Masuk Dengan Akun Yang Sudah Anda Daftarkan Sebelumnya</p>

                <form action="login.php" method="post">
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Username" name="username"
                            required />
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Password"
                            name="password" required />
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-1"
                        name="login">Masuk</button>
                </form>

                <div class="text-center mt-3 text-md fs-4">
                    <p class="text-gray-600">
                        Belum punya akun?
                        <a href="register.php" class="font-bold">Daftar</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>