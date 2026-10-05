<?php

require_once __DIR__ . '/function.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if (hapus_user($id) > 0) {

        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href='user.php';
              </script>";

    } else {

        echo "<script>
                alert('Data gagal dihapus!');
                window.location.href='user.php';
              </script>";
    }

} else {

    header('Location: user.php');
    exit;
}
?>
