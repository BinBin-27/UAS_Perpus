<?php
    include '../function/connection.php';
        if (isset($_GET['id'])) {
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        } else {
            $_SESSION['message'] = '
                <div class="alert alert-warning alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
                    <strong>Gagal:</strong> Server error!
                    <button type="button" style="margin-left: 10px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            header('Location: index.php?halaman=rak');
            exit;
        }
        $pilih = "SELECT * FROM sections WHERE sect_id = $id";
        $query= mysqli_query($connection, $pilih);
        $row = mysqli_fetch_assoc($query);
        
    try {
        if (isset($_POST['update'])) {
            $section = $_POST['section'];
            $library_id = $_POST['library_id'];
            $update = "UPDATE sections SET name = '$section', library_id = '$library_id' WHERE sect_id = '$id'";
            $query = mysqli_query($connection, $update);
            
            if ($query == TRUE) {
                $_SESSION['message'] = '
                    <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
                        <strong>Sukses:</strong> Data Berhasil Diubah
                        <button type="button" style="margin-left: 10px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            } else{
                $_SESSION['message'] = '
                    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
                        <strong>Gagal:</strong> Data Gagal Diubah
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

<div class="card-body">
    <h3 class="card-title">Edit Data Rak</h3>
    <br>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="index.php?halaman=ubah_rak&id=<?= $row['sect_id'] ?> <" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="section" placeholder="John Doe" name="section"
                            value="<?= $row['name'] ?>">
                        <label for="title">Nama Rak</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="library_id" placeholder="12345" name="library_id"
                            value="<?= $row['library_id'] ?>">
                        <label for="library_id">ID Perpustakaan</label>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="update" value="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
</div>