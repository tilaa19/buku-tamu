<?php

require_once __DIR__ . '/function.php';
require_once __DIR__ . '/koneksi.php';

include_once __DIR__ . '/templates/header.php';

// Jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    if (tambah_tamu($_POST) > 0) {
        $pesan = '<div class="alert alert-success" role="alert">
                    Data berhasil disimpan!
                  </div>';
    } else {
        $pesan = '<div class="alert alert-danger" role="alert">
                    Data gagal disimpan!
                  </div>';
    }
}

$buku_tamu = query("SELECT * FROM tamu");

?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Data User</h1>

<?php
// tampilkan notifikasi
if (isset($pesan)) {
    echo $pesan;
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <button type="button"
                class="btn btn-primary btn-icon-split"
                data-toggle="modal"
                data-target="#tambahModal">

                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>

                <span class="text">Data User</span>
            </button>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered"
                    id="dataTable"
                    width="100%"
                    cellspacing="0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama Tamu</th>
                            <th>User role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $no = 1;
                        $users = query("SELECT * FROM users");
                        foreach ($users as $user) : ?>

                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $user['username']; ?></td>
                                <td><?= $user['user_role']; ?></td>
            
                                <td>
                                    <a class="btn btn-success" href="edit-tamu.php?id=<?=  $user['id_user']?>">Ubah</a>
                                    <a onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger"
                                    href="hapus-user.php?id=<?= $user['id_user'] ?>"></a>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- Modal Tambah -->
<div class="modal fade"
    id="tambahModal"
    tabindex="-1"
    aria-labelledby="tambahModalLabel"
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <form action="" method="POST">

                <div class="modal-header">

                    <h5 class="modal-title" id="tambahModalLabel">
                        Tambah Data Tamu
                    </h5>

                    <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div class="form-group row">
                        <label for="nama_tamu"
                            class="col-sm-3 col-form-label">
                            Nama Tamu
                        </label>

                        <div class="col-sm-8">
                            <input type="text"
                                class="form-control"
                                id="nama_tamu"
                                name="nama_tamu"
                                required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat"
                            class="col-sm-3 col-form-label">
                            Alamat
                        </label>

                        <div class="col-sm-8">
                            <textarea class="form-control"
                                id="alamat"
                                name="alamat"
                                required></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="no_hp"
                            class="col-sm-3 col-form-label">
                            No. Telepon
                        </label>

                        <div class="col-sm-8">
                            <input type="text"
                                class="form-control"
                                id="no_hp"
                                name="no_hp"
                                required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bertemu"
                            class="col-sm-3 col-form-label">
                            Bertemu dg.
                        </label>

                        <div class="col-sm-8">
                            <input type="text"
                                class="form-control"
                                id="bertemu"
                                name="bertemu"
                                required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kepentingan"
                            class="col-sm-3 col-form-label">
                            Kepentingan
                        </label>

                        <div class="col-sm-8">
                            <input type="text"
                                class="form-control"
                                id="kepentingan"
                                name="kepentingan"
                                required>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Keluar
                    </button>

                    <button type="submit"
                        name="simpan"
                        class="btn btn-primary">
                        Simpan
                    </button>

                </div>

            </form> <!-- TAG FORM PENUTUP DI SINI -->

        </div>

    </div>

</div>

<?php
include_once __DIR__ . '/templates/footer.php';
?>