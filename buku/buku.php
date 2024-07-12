<?php
include "../function/connection.php";

$query = mysqli_query($connection, "SELECT * FROM books, sections WHERE books.section_id = sections.sect_id");

?>
</br>
<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="true" href="#">Daftar Buku</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="true" href="index.php?halaman=tambah_buku">Tambah Buku</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <h3 class="card-title">Daftar Buku</h3>
        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kode Rak</th>
                    <th>Rak</th>
                    <th>ID Penulis</th>
                    <th>ID Penerbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                $i = 1;
                                while ($data = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $data['title'] ?></td>
                    <td><?= $data['author'] ?></td>
                    <td><?= $data['section_id'] ?></td>
                    <td><?= $data['name'] ?></td>
                    <td><?= $data['author_id'] ?></td>
                    <td><?= $data['publisher_id'] ?></td>
                    <td>
                        <a class="btn btn-primary btn-sm" id="btn-edit"
                            href="index.php?halaman=edit&id=<?= $data['id'] ?>">
                            Ubah
                        </a>
                        <a class="btn btn-danger btn-sm" id="btn-hapus"
                            href="index.php?halaman=hapus&id=<?= $data['id'] ?>" onclick="confirmModal(event)">
                            Hapus
                        </a>
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</div>