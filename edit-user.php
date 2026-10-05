<?php 

require_once __DIR__ . '/function.php'; 

// cek apakah ada id_user di URL
if (!isset($_GET['id_user']) || $_GET['id_user'] == '') {
    header('Location: user.php');
    exit;
}

$id_user = $_GET['id_user'];

// ambil data user
$data = query("SELECT * FROM users WHERE id_user = '$id_user'");

// cek apakah data ditemukan
if (empty($data)) {
    header('Location: user.php');
    exit;
}

$data = $data[0];

// jika tombol simpan ditekan
if (isset($_POST['simpan'])) {

    if (ubah_user($_POST) > 0) {
        echo '<div class="alert alert-success" role="alert">
                Data berhasil diubah!
              </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Data gagal diubah!
              </div>';
    }
}

include_once __DIR__ . '/templates/header.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Ubah Data User</h1>

    <!-- Konten Edit Data User -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Data User
            </h6>
        </div>

        <div class="card-body">

            <form method="post" action="">

                <input type="hidden" name="id_user" value="<?= $id_user ?>">

                <!-- Username -->
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">
                        Username
                    </label>

                    <div class="col-sm-8">
                        <input type="text"
                            class="form-control"
                            id="username"
                            name="username"
                            value="<?= $data['username'] ?>">
                    </div>
                </div>


                <!-- User Role -->
                <div class="form-group row">
                    <label for="user_role" class="col-sm-3 col-form-label">
                        User Role
                    </label>

                    <div class="col-sm-8">
                        <select
                            class="form-control"
                            id="user_role"
                            name="user_role">

                            <option value="admin"
                                <?= $data['user_role'] == 'admin' ? 'selected' : '' ?>>
                                Admin
                            </option>

                            <option value="operator"
                                <?= $data['user_role'] == 'operator' ? 'selected' : '' ?>>
                                Operator
                            </option>

                            <option value=""
                                <?= $data['user_role'] == '' ? 'selected' : '' ?>>
                                User
                            </option>

                        </select>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="form-group row">
                    <div class="col-sm-3"></div>

                    <div class="col-sm-8 d-flex justify-content-end">

                        <a href="user.php"
                            class="btn btn-dark btn-icon-split mr-2">

                            <span class="icon text-white-50">
                                <i class="fas fa-chevron-left"></i>
                            </span>

                            <span class="text">Kembali</span>
                        </a>

                        <button type="submit"
                            name="simpan"
                            class="btn btn-primary">
                            Simpan
                        </button>

                    </div>
                </div>

            </form>

        </div>

    </div>

</div>
<!-- /.container-fluid -->

<?php 
include_once('templates/footer.php'); 
?>