<?php
//panggil file function.php
require_once __DIR__ . '/function.php';

//jika ada id 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (hapus_tamu($id) > 0) {
       //jika data berhasil di hapus maka akan muncul alert
        echo "<script>alert('Data Berhasil dihapus!')</script>";
       //redirect ke halaman buku-tamu.php
        echo "<script>window.location.href='buku-tamu.php'</script>";
    } else {
        //jika gagal di hapus
        echo "<script>alert('Data Gagal dihapus!')</script>";
    }
}

?>