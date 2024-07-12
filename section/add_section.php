<?php
include "../function/connection.php";

try {
    if (isset($_POST['submit'])) {
        $section = htmlspecialchars($_POST['section']);
        $library = htmlspecialchars($_POST['library_id']);

        $query = mysqli_query($connection, "INSERT INTO sections VALUES (null, '$section', '$library')");

        if ($query == TRUE) {
            $_SESSION['message'] = '
            <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
                <strong>Sukses:</strong> Data Berhasil Ditambahkan
                <button type="button" style="margin-left: 10px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } else {
            $_SESSION['message'] = '
            <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
                <strong>Gagal:</strong> Data Gagal Ditambahkan
                <button type="button" style="margin-left: 10px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

        header('Location: index.php?halaman=rak');
        exit;
    }
} catch (\Throwable $th) {
    $_SESSION['message'] = '
    <div class="alert alert-warning alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
        <strong>Gagal:</strong> Server error!
        <button type="button" style="margin-left: 10px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    header('Location: index.php?halaman=rak');
    exit;
}
?>

<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=rak">Daftar Rak</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="true" href="index.php?halaman=tambah_buku">Tambah Rak</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <h3 class="card-title">Tambah Data Rak</h3>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="section" placeholder="John Doe" name="section"
                                required>
                            <label for="section">Nama Rak</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="library_id" placeholder="John Doe"
                                name="library_id" required>
                            <label for="library_id">ID Perpustakaan</label>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>