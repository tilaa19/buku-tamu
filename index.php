<?php
// memulai session
session_start();

// cek bila tidak ada user yang login maka akan di redirect ke halaman login
if (!isset($_SESSION['login'])) {
    header('location:login.php');
}

include_once ('templates/header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>

</div>
<!-- /.container-fluid -->

<?php
include_once('templates/footer.php');
?>