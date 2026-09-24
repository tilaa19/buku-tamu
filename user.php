<?php

require_once __DIR__ . '/function.php';
require_once __DIR__ . '/koneksi.php';

include_once __DIR__ . '/templates/header.php';

// mengambil data dari tabel users dengan kode terbesar
$query = mysqli_query($koneksi, "SELECT max(id_user) as kodeTerbesar FROM users");
$data = mysqli_fetch_array($query);
$kodeuser = $data['kodeTerbesar'];

// mengambil angka dari kode terbesar, menggunakan fungsi substr dan diubah ke integer dengan (int)
$urutan = (int) substr($kodeuser, 3, 2);

// nomor yang diambil akan ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

// membuat kode user baru dengan awalan "usr" dan nomor urut 2 digit (misal: usr01)
$huruf = "usr";
$kodeuser = $huruf . sprintf("%02s", $urutan);

// =========================
// PROSES TAMBAH USER
// =========================
if (isset($_POST['simpan'])) {

    if (tambah_user($_POST) > 0) {

        $pesan = '<div class="alert alert-success" role="alert">
                    Data user berhasil disimpan!
                  </div>';
    } else {

        $pesan = '<div class="alert alert-danger" role="alert">
                    Data user gagal disimpan!
                  </div>';
    }
}


// =========================
// AMBIL DATA USER
// =========================
$users = query("SELECT * FROM users");

?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Data User</h1>


<!-- Notifikasi -->
<?php if (isset($pesan)) : ?>

    <?= $pesan ?>

<?php endif; ?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">

        <!-- Card Header -->
        <div class="card-header py-3">

            <button
                type="button"
                class="btn btn-primary btn-icon-split"
                data-toggle="modal"
                data-target="#tambahModal">

                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>

                <span class="text">Tambah User</span>

            </button>

        </div>


        <!-- Card Body -->
        <div class="card-body">

            <div class="table-responsive">

                <table
                    class="table table-bordered"
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
                        $no = 1;

                        foreach ($users as $user) :
                        ?>

                            <tr>

                                <!-- Nomor -->
                                <td>
                                    <?= $no++; ?>
                                </td>


                                <!-- Username -->
                                <td>
                                    <?= htmlspecialchars($user['username']); ?>
                                </td>


                                <!-- User Role -->
                                <td>
                                    <?= htmlspecialchars($user['user_role']); ?>
                                </td>


                                <!-- Aksi -->
                                <td>

                                    <!-- Tombol Ubah -->
                                    <a
                                        class="btn btn-success"
                                        href="edit-user.php?id=<?= $user['id_user']; ?>">

                                        Ubah

                                    </a>


                                    <!-- Tombol Hapus -->
                                    <a
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                        class="btn btn-danger"
                                        href="hapus-user.php?id=<?= $user['id_user']; ?>">

                                        Hapus

                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>



<!-- ===================================================== -->
<!-- MODAL TAMBAH USER -->
<!-- ===================================================== -->

<div
    class="modal fade"
    id="tambahModal"
    tabindex="-1"
    aria-labelledby="tambahModalLabel"
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">


            <!-- Form -->
            <form action="" method="POST">


                <!-- Modal Header -->
                <div class="modal-header">

                    <h5
                        class="modal-title"
                        id="tambahModalLabel">

                        Tambah Data User

                    </h5>


                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">

                        <span aria-hidden="true">
                            &times;
                        </span>

                    </button>

                </div>



                <!-- Modal Body -->
                <div class="modal-body">


                    <!-- Username -->
                    <div class="form-group row">

                        <label
                            for="username"
                            class="col-sm-3 col-form-label">

                            Username

                        </label>


                        <div class="col-sm-8">

                            <input
                                type="text"
                                class="form-control"
                                id="username"
                                name="username"
                                required>

                        </div>

                    </div>



                    <!-- Password -->
                    <div class="form-group row">

                        <label
                            for="password"
                            class="col-sm-3 col-form-label">

                            Password

                        </label>


                        <div class="col-sm-8">

                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                required>

                        </div>

                    </div>



                    <!-- User Role -->
                    <div class="form-group row">

                        <label
                            for="user_role"
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

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">

                        Keluar

                    </button>


                    <button
                        type="submit"
                        name="simpan"
                        class="btn btn-primary">

                        Simpan

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>


<?php

include_once __DIR__ . '/templates/footer.php';

?>