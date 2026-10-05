<?php

require_once __DIR__ . '/function.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    echo "ID yang diterima: " . htmlspecialchars($id) . "<br>";

    $hasil = hapus_tamu($id);

    echo "Hasil hapus: " . $hasil . "<br>";

    if ($hasil > 0) {
        echo "<script>
                alert('Data Berhasil dihapus!');
                window.location.href='buku-tamu.php';
              </script>";
    } else {
        echo "<script>
                alert('Data Gagal dihapus!');
                window.location.href='buku-tamu.php';
              </script>";
    }

} else {
    echo "ID tidak ditemukan!";
}
?>
