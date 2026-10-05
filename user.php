    <?php

    require_once __DIR__ . '/function.php';
    require_once __DIR__ . '/koneksi.php';

    include_once __DIR__ . '/templates/header.php';

    // Jika ada tombol simpan
    if (isset($_POST['simpan'])) {
        if (tambah_user($_POST) > 0) {
            $pesan = '<div class="alert alert-success" role="alert">
                        Data berhasil disimpan!
                    </div>';
        } else {
            $pesan = '<div class="alert alert-danger" role="alert">
                        Data gagal disimpan!
                    </div>';
        }
    }

    //JIka tombol ganti password ditekan
    else if (isset($_POST['ganti_password'])) {
    if (ganti_password($_POST) > 0) {
    ?>
        <div class="alert alert-success" role="alert">
            Password berhasil diubah!
        </div>
    <?php
    } else {
    ?>
        <div class="alert alert-danger" role="alert">
            Password gagal diubah!
        </div>
<?php
    }
}
    $buku_tamu = query("SELECT * FROM tamu");

    ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"  style="margin-left: 30px;">Data User</h1>

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
                                <th>User Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // penomoran auto-increment
                            $no = 1;
                            // Query untuk memanggil semua data dari tabel users
                            $users = query("SELECT * FROM users");
                            foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $user['username']; ?></td>
                                    <td><?= $user['user_role']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-icon-split" data-toggle="modal"
                                            data-target="#gantiPassword" data-id="<?= $user['id_user']?>">
                                                <span class="text">Ganti Password</span>
                                        </button>
                                        <a class="btn btn-success" href="edit-user.php?id_user=<?= $user['id_user']; ?>">Ubah</a>
                                        <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger" href="hapus-user.php?id=<?= $user['id_user']; ?>">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>

    <?php
    // mengambil data dari tabel users dengan kode terbesar
    $query = mysqli_query($koneksi, "SELECT max(id_user) as kodeTerbesar FROM users");
    $data = mysqli_fetch_array($query);
    $kodeuser = $data['kodeTerbesar'];

    // mengambil angka dari kode terbesar, menggunakan fungsi substr dan diubah ke integer dengan (int)
    $urutan = (int) substr($kodeuser, 3, 2);

    // nomor yang diambil akan ditambah 1 untuk menentukan nomor urut berikutnya
    $urutan++;

    // membuat kode user baru
    $huruf = "usr";
    $kodeuser = $huruf . sprintf("%02s", $urutan);
    ?>

    <!-- Modal Tambah User -->
    <div class="modal fade"
        id="tambahModal"
        tabindex="-1"
        aria-labelledby="tambahModalLabel"
        aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                    <form action="" method="POST">
                    <input type="hidden" name="id_user" value="<?= $kodeuser ?>">


                    <!-- Modal Header -->
                    <div class="modal-header">

                        <h5 class="modal-title" id="tambahModalLabel">
                            Tambah Data User
                        </h5>

                        <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                        </button>

                    </div>


                    <!-- Modal Body -->
                    <div class="modal-body">

                        <!-- Username -->
                        <div class="form-group row">

                            <label for="username"
                                class="col-sm-3 col-form-label">
                                Username
                            </label>

                            <div class="col-sm-8">

                                <input type="text"
                                    class="form-control"
                                    id="username"
                                    name="username"
                                    required>

                            </div>

                        </div>


                        <!-- Password -->
                        <div class="form-group row">

                            <label for="password"
                                class="col-sm-3 col-form-label">
                                Password
                            </label>

                            <div class="col-sm-8">

                                <input type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    required>

                            </div>

                        </div>


                        <!-- User Role -->
                        <div class="form-group row">

                            <label for="user_role"
                                class="col-sm-3 col-form-label">
                                User Role
                            </label>

                            <div class="col-sm-8">

                                <select
                                    class="form-control"
                                    id="user_role"
                                    name="user_role"
                                    required>

                                    <option value="">
                                        -- Pilih Role --
                                    </option>

                                    <option value="admin">
                                        Administrator
                                    </option>

                                    <option value="operator">
                                        Operator
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>


                    <!-- Modal Footer -->
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

                </form>

            </div>

        </div>

    </div>

    <!-- Modal Ganti Password -->
<div class="modal fade" id="gantiPassword" tabindex="-1" aria-labelledby="gantiPasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gantiPasswordLabel">Ganti Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <input type="hidden" name="id_user" id="id_user">
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password Baru</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button type="submit" name="ganti_password" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

    <?php
    include_once __DIR__ . '/templates/footer.php';
    ?>