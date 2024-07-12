<?php
include '../function/connection.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
} else {
    $_SESSION['message'] = '
        <div class="alert alert-warning alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
            <strong>Gagal:</strong> ID Tidak Ditemukan!
            <button type="button" style="margin-left: 10px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    header('Location: index.php?halaman=buku');
    exit;
}

// Query untuk mendapatkan data buku berdasarkan ID
$book_query = "SELECT * FROM books WHERE id = $id";
$book_result = mysqli_query($connection, $book_query);
$row = mysqli_fetch_assoc($book_result);

// Query untuk mendapatkan data rak
$sections_query = mysqli_query($connection, "SELECT sect_id, name FROM sections");

try {
    if (isset($_POST['update'])) {
        $title = htmlspecialchars($_POST['title']);
        $author = htmlspecialchars($_POST['author']);
        $section_id = htmlspecialchars($_POST['section_id']);
        $author_id = htmlspecialchars($_POST['author_id']);
        $publisher_id = htmlspecialchars($_POST['publisher_id']);

        $update = "UPDATE books SET title = '$title', author = '$author', section_id = $section_id, author_id = $author_id, publisher_id = $publisher_id WHERE id = $id";
        $query = mysqli_query($connection, $update);

        if ($query) {
            $_SESSION['message'] = '
                <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
                    <strong>Sukses:</strong> Data Berhasil Diubah
                    <button type="button" style="margin-left: 10px;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        } else {
            $_SESSION['message'] = '
                <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 p-3" role="alert" style="z-index: 1050;">
                    <strong>Gagal:</strong> Data Gagal Diubah
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

<div class="card-body">
    <h3 class="card-title">Edit Data Buku</h3>
    <br>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="index.php?halaman=edit&id=<?= $row['id'] ?>" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="title" placeholder="Judul Buku" name="title"
                            value="<?= htmlspecialchars($row['title']) ?>" required>
                        <label for="title">Judul Buku</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="author" placeholder="Nama Penulis" name="author"
                            value="<?= htmlspecialchars($row['author']) ?>" required>
                        <label for="author">Nama Penulis</label>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" id="section_id" name="section_id" required>
                            <option value="" disabled>Pilih ID Rak</option>
                            <?php while ($section = mysqli_fetch_assoc($sections_query)): ?>
                            <option value="<?= $section['sect_id'] ?>"
                                <?= ($section['sect_id'] == $row['section_id']) ? 'selected' : '' ?>>
                                <?= $section['name'] ?> (ID: <?= $section['sect_id'] ?>)
                            </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="author_id" placeholder="ID Penulis" name="author_id"
                            value="<?= htmlspecialchars($row['author_id']) ?>" required>
                        <label for="author_id">ID Penulis</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="publisher_id" placeholder="ID Publisher"
                            name="publisher_id" value="<?= htmlspecialchars($row['publisher_id']) ?>" required>
                        <label for="publisher_id">ID Publisher</label>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>