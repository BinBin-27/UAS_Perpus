<?php
include "../function/connection.php";

try {
    // Ambil data ID Rak dari database
    $sections_query = mysqli_query($connection, "SELECT sect_id, name FROM sections");

    if (isset($_POST['submit'])) {
        $title = htmlspecialchars($_POST['title']);
        $author = htmlspecialchars($_POST['author']);
        $section_id = htmlspecialchars($_POST['section_id']);
        $authorId = htmlspecialchars($_POST['author_id']);
        $publisher = htmlspecialchars($_POST['publisher_id']);

        $query = mysqli_query($connection, "INSERT INTO books (title, author, section_id, author_id, publisher_id) VALUES ('$title', '$author', '$section_id', '$authorId', '$publisher')");

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

        header('Location: index.php?halaman=buku');
        exit;
    }
} catch (\Throwable $th) {
    $_SESSION['message'] = '
    <div class="alert alert-warning alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
        <strong>Gagal:</strong> Server error!
        <button type="button" style="margin-left: 10px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    header('Location: index.php?halaman=buku');
    exit;
}
?>

<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=buku">Daftar Buku</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="true" href="index.php?halaman=tambah_buku">Tambah Buku</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <h3 class="card-title">Tambah Data Buku</h3>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="title" placeholder="John Doe" name="title"
                                required>
                            <label for="title">Judul Buku</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="author" placeholder="John Doe" name="author"
                                required>
                            <label for="author">Nama Penulis</label>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" id="section_id" name="section_id" required>
                                <option value="" disabled selected>Pilih ID Rak</option>
                                <?php while ($row = mysqli_fetch_assoc($sections_query)): ?>
                                <option value="<?= $row['sect_id'] ?>">
                                    [<?= $row['sect_id'] ?>]
                                    <?= $row['name'] ?>
                                </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="author_id" placeholder="12345" name="author_id"
                                required>
                            <label for="author_id">ID Penulis</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="publisher_id" placeholder="12345"
                                name="publisher_id" required>
                            <label for="publisher_id">ID Publisher</label>
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