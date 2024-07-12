<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
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
    <title>UAS Perpus</title>
</head>

<body class="bg">
    <!-- Header -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Bintang</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Perpustakaan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php?halaman=home">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?halaman=buku">Daftar Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?halaman=rak">Daftar Rak</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?halaman=keluar">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="content">
        <?php
            if (isset($_GET['halaman'])) {
            $halaman = $_GET['halaman'];
            switch ($halaman) {
                        case 'home':
                            include "./home.php";
                            break;
                        case 'keluar':
                            include "./logout.php";
                            break;
                        case 'login':
                            include "./login.php";
                            break;
                        case 'buku':
                            include "../buku/buku.php";
                            break;
                        case 'tambah_buku':
                            include "../buku/add.php";
                            break;
                        case 'edit':
                            include "../buku/edit.php";
                            break;
                        case 'hapus':
                            include "../buku/delete.php";
                            break;
                        case 'rak':
                            include "../section/section.php";
                            break;
                        case 'tambah_rak':
                            include "../section/add_section.php";
                            break;
                        case 'ubah_rak':
                            include "../section/edit_section.php";
                            break;
                        case 'hapus_rak':
                            include "../section/delete_section.php";
                            break;
                        default:
                            include "../function/error.php";
                    }
                } else {
                    include "./home.php";
                }
        ?>
    </div>
    <div class="footer">
        Copyright &copy; 2024 by Bintang Aulia M. (23.0504.0005)
    </div>
    <script>
    window.onload = function() {
        let alert = document.querySelector('.alert');
        if (alert) {
            setTimeout(() => {
                alert.classList.remove('show');
                alert.classList.add('hide');
                setTimeout(() => {
                    alert.remove();
                }, 1000);
            }, 2000);
        }
    };
    </script>
</body>

</html>