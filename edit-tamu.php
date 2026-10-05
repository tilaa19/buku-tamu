<?php

require_once __DIR__ . '/function.php';

// cek apakah ada id di URL
if (!isset($_GET['id_tamu']) || $_GET['id_tamu'] == '') {
    header('Location: buku-tamu.php');
    exit;
}

$id_tamu = $_GET['id_tamu'];

// ambil data tamu
$data = query("SELECT * FROM tamu WHERE id_tamu = '$id_tamu'");

// cek apakah data ditemukan
if (empty($data)) {
    header('Location: buku-tamu.php');
    exit;
}

$data = $data[0];

// jika tombol simpan ditekan
if (isset($_POST['simpan'])) {

    if (ubah_tamu($_POST) > 0) {
        echo '<div class="alert alert-success" role="alert">
                Data berhasil diubah!
              </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Data gagal diubah!
              </div>';
    }
}

// panggil header setelah semua pengecekan selesai
include_once __DIR__ . '/templates/header.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Ubah Data Tamu</h1>

    <!-- Konten Edit Data Tamu -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Data Tamu
            </h6>
        </div>

        <div class="card-body">
            <form method="post" action="">
    <input type="hidden" name="id_tamu" value="<?= $id_tamu?>">

    <div class="form-group row">
        <label for="nama_tamu" class="col-sm-3 col-form-label">
            Nama Tamu
        </label>

        <div class="col-sm-8">
            <input type="text"
                class="form-control"
                id="nama_tamu"
                name="nama_tamu"
                value="<?= $data['nama_tamu'] ?>">
        </div>
    </div>

    <div class="form-group row">
        <label for="alamat" class="col-sm-3 col-form-label">
            Alamat
        </label>

        <div class="col-sm-8">
            <textarea
                class="form-control"
                id="alamat"
                name="alamat"><?= $data['alamat'] ?></textarea>
        </div>
    </div>

    <div class="form-group row">
        <label for="no_hp" class="col-sm-3 col-form-label">
            No. Telepon
        </label>

        <div class="col-sm-8">
            <input type="text"
                class="form-control"
                id="no_hp"
                name="no_hp"
                value="<?= $data['no_hp'] ?>">
        </div>
    </div>

    <div class="form-group row">
        <label for="bertemu" class="col-sm-3 col-form-label">
            Bertemu dg.
        </label>

        <div class="col-sm-8">
            <input type="text"
                class="form-control"
                id="bertemu"
                name="bertemu"
                value="<?= $data['bertemu'] ?>">
        </div>
    </div>

    <div class="form-group row">
        <label for="kepentingan" class="col-sm-3 col-form-label">
            Kepentingan
        </label>

        <div class="col-sm-8">
            <input type="text"
                class="form-control"
                id="kepentingan"
                name="kepentingan"
                value="<?= $data['kepentingan'] ?>">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-3"></div>

        <div class="col-sm-8 d-flex justify-content-end">
            <div>
                <a href="buku-tamu.php"
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
    </div>

</form>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

<?php
include_once('templates/footer.php');
?>