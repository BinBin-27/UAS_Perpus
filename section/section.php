<?php
include "../function/connection.php";

$query = mysqli_query($connection, "SELECT * FROM sections");

?>
</br>
<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="true" href="index.php?halaman=rak">Daftar Rak</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="true" href="index.php?halaman=tambah_rak">Tambah Rak</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <h3 class="card-title">Daftar Rak</h3>
        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Rak</th>
                    <th>ID Perpustakaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    while ($data = mysqli_fetch_assoc($query)) :
                ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $data['name'] ?></td>
                    <td><?= $data['library_id'] ?></td>
                    <td>
                        <a class="btn btn-primary btn-sm" id="btn-edit"
                            href="index.php?halaman=ubah_rak&id=<?= $data['sect_id'] ?>">
                            Ubah
                        </a>
                        <a class="btn btn-danger btn-sm" id="btn-hapus"
                            href="index.php?halaman=hapus_rak&id=<?= $data['sect_id'] ?>" onclick="confirmModal(event)">
                            Hapus
                        </a>
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</div>