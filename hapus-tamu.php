<?php

// panggil file function.php
require_once __DIR__ . '/function.php';

// jika ada id_tamu
if (isset($_GET['id_tamu'])) {

    $id_tamu = $_GET['id_tamu'];

    if (hapus_tamu($id_tamu) > 0) {

        // jika data berhasil dihapus
        echo "<script>
                alert('Data Berhasil dihapus!');
                window.location.href='buku-tamu.php';
              </script>";

    } else {

        // jika gagal dihapus
        echo "<script>
                alert('Data Gagal dihapus!');
                window.location.href='buku-tamu.php';
              </script>";
    }
}
?>
