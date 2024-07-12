<?php
include "../function/connection.php";

try {
    // Query untuk mengambil jumlah buku
    $query_buku = mysqli_query($connection, "SELECT COUNT(*) AS total_buku FROM books");
    $data_buku = mysqli_fetch_assoc($query_buku);
    $total_buku = $data_buku['total_buku'];

    // Query untuk mengambil jumlah rak
    $query_rak = mysqli_query($connection, "SELECT COUNT(*) AS total_rak FROM sections");
    $data_rak = mysqli_fetch_assoc($query_rak);
    $total_rak = $data_rak['total_rak'];
    
} catch (Throwable $th) {
    $_SESSION['message'] = '
        <div class="alert alert-warning alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
            <strong>Gagal:</strong> Server error!
            <button type="button" style="margin-left: 10px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    header('Location: index.php?halaman=home');
    exit;
}
?>

<h3 style="text-align: center;">Beranda Utama</h3>

<div class="d-flex justify-content-center">
    <div class="card text-bg-primary mb-3" style="max-width: 18rem; margin: 0 1rem;">
        <div class="card-header">
            <h4>Buku</h4>
        </div>
        <div class="card-body">
            <h5 class="card-title">Yang Tersedia Saat Ini</h5>
            <h5 class="font-extrabold mb-0" style="margin-top: 1rem;"><?= $total_buku ?></h5>
            <a href="index.php?halaman=buku" class="btn btn-outline-light" style="margin-top: 1rem;">Daftar Buku</a>
        </div>
    </div>
    <div class="card text-bg-success mb-3" style="max-width: 18rem; margin: 0 1rem;">
        <div class="card-header font-bold">
            <h4>Rak</h4>
        </div>
        <div class="card-body">
            <h5 class="card-title">Yang Tersedia Saat Ini</h5>
            <h5 class="font-extrabold mb-0" style="margin-top: 1rem;"><?= $total_rak ?></h5>
            <a href="index.php?halaman=rak" class="btn btn-outline-light" style="margin-top: 1rem;">Daftar Rak</a>
        </div>
    </div>
</div>