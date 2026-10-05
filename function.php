<?php

require_once __DIR__ . '/koneksi.php';

function query($query)
{
    global $koneksi;

    $result = mysqli_query($koneksi, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


// =========================
// FUNCTION TAMBAH DATA TAMU
// =========================
function tambah_tamu($data)
{
    global $koneksi;

    // Cari ID terakhir berdasarkan urutan panjang dan karakter agar format zt009 ke zt010 tidak berantakan
    $result = mysqli_query(
        $koneksi,
        "SELECT id_tamu
         FROM tamu 
         WHERE id_tamu LIKE 'zt%' 
         ORDER BY LENGTH(id_tamu) DESC, id_tamu DESC 
         LIMIT 1"
    );

    if (!$result) {
        die("Query ID gagal: " . mysqli_error($koneksi));
    }

    $dataId = mysqli_fetch_assoc($result);

    // Buat ID baru
    if (!$dataId) {
        $kode = "zt001";
    } else {
        $urutan = (int) substr($dataId['id_tamu'], 2);
        $urutan++;
        $kode = "zt" . sprintf("%03d", $urutan);
    }

    $tanggal = date("Y-m-d");

    $nama_tamu   = htmlspecialchars($data['nama_tamu'] ?? '');
    $alamat      = htmlspecialchars($data['alamat'] ?? '');
    $no_hp       = htmlspecialchars($data['no_hp'] ?? '');
    $bertemu     = htmlspecialchars($data['bertemu'] ?? '');
    $kepentingan = htmlspecialchars($data['kepentingan'] ?? '');

    $sql = "INSERT INTO tamu 
            (id_tamu, tanggal, nama_tamu, alamat, no_hp, bertemu, kepentingan)
            VALUES 
            ('$kode', '$tanggal', '$nama_tamu', '$alamat', '$no_hp', '$bertemu', '$kepentingan')";

    // Eksekusi query dengan penanganan error
    $simpan = mysqli_query($koneksi, $sql);

    if (!$simpan) {
        // Tampilkan pesan error jika simpan ke database gagal
        die("Gagal menyimpan data ke Database: " . mysqli_error($koneksi));
    }

    return mysqli_affected_rows($koneksi);
}


// =========================
// FUNCTION UBAH DATA TAMU
// =========================
function ubah_tamu($data)   
{
    global $koneksi;

    $id_tamu = htmlspecialchars($data["id_tamu"]);
    $nama_tamu = htmlspecialchars($data["nama_tamu"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $bertemu = htmlspecialchars($data["bertemu"]);
    $kepentingan = htmlspecialchars($data["kepentingan"]);

    $query = "UPDATE tamu SET
                nama_tamu = '$nama_tamu',
                alamat = '$alamat',
                no_hp = '$no_hp',
                bertemu = '$bertemu',
                kepentingan = '$kepentingan'
              WHERE id_tamu = '$id_tamu'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


// =========================
// FUNCTION HAPUS DATA TAMU
// =========================
function hapus_tamu($id)
{
    global $koneksi;

    $id = mysqli_real_escape_string($koneksi, $id);

    $query = "DELETE FROM tamu WHERE id_tamu = '$id'";

    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Gagal menghapus data: " . mysqli_error($koneksi));
    }

    return mysqli_affected_rows($koneksi);
}


// =========================
// FUNCTION TAMBAH DATA USER
// =========================
function tambah_user($data)
{
    global $koneksi;

    $kode      = htmlspecialchars($data["id_user"] ?? '');
    $username  = htmlspecialchars($data["username"] ?? '');
    $password  = htmlspecialchars($data["password"] ?? '');
    $user_role = htmlspecialchars($data["user_role"] ?? '');

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users
              (id_user, username, password, user_role)
              VALUES
              ('$kode', '$username', '$password_hash', '$user_role')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// =========================
// FUNCTION UBAH DATA USER
// =========================
function ubah_user($data)
{
    global $koneksi;

    $id_user = htmlspecialchars($data['id_user']);
    $username = htmlspecialchars($data['username']);
    $user_role = htmlspecialchars($data['user_role']);

    $query = "UPDATE users SET
                username = '$username',
                user_role = '$user_role'
              WHERE id_user = '$id_user'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


// =========================
// FUNCTION HAPUS DATA USER
// =========================
function hapus_user($id) {
    global $koneksi;

    $query = "DELETE FROM users WHERE id_user = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// =========================
// FUNCTION GANTI PASSWORD USER
// =========================
function ganti_password($data) {
    global $koneksi;

    $kode          = htmlspecialchars($data["id_user"]);
    $password      = htmlspecialchars($data["password"]);
    $password_hash = password_hash($password,PASSWORD_DEFAULT);

    $query = "UPDATE users SET
              password = '$password_hash'
              WHERE id_user = '$kode'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}