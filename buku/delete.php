<?php
include "../function/connection.php";

try {
    $message = "";
    $success = FALSE;
    $error = FALSE;

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Select Data dan Check Data
        $select = mysqli_query($connection, "SELECT title FROM books WHERE id = '$id'");
        $data = mysqli_fetch_assoc($select);

        if (!$data) {
            header('Location: index.php?halaman=buku');
            exit;
        }

        $query = mysqli_query($connection, "DELETE FROM books WHERE id = '$id'");

        if ($query == TRUE) {
            $_SESSION['message'] = '
            <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
                <strong>Sukses:</strong> Data Berhasil Dihapus
                <button type="button" style="margin-left: 10px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } else {
            $_SESSION['message'] = '
            <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
                <strong>Gagal:</strong> Data Gagal Dihapus
                <button type="button" style="margin-left: 10px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    } else {
        $_SESSION['message'] = '
            <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
                <strong>Peringatan: </strong>ID Tidak Ditemukan
                <button type="button" style="margin-left: 10px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }  
    header('Location: index.php?halaman=buku');
    exit;
    
} catch (\Throwable $th) {
    $_SESSION['message'] = '
    <div class="alert alert-warning alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
        <strong>Peringatan!: </strong>Server error!
        <button type="button" style="margin-left: 10px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    header('Location: index.php?halaman=buku');
    exit;
}

// Display message
echo $message;
?>