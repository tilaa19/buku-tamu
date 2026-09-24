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
        "SELECT id 
         FROM tamu 
         WHERE id LIKE 'zt%' 
         ORDER BY LENGTH(id) DESC, id DESC 
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
        $urutan = (int) substr($dataId['id'], 2);
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
            (id, tanggal, nama_tamu, alamat, no_hp, bertemu, kepentingan)
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

    $id = htmlspecialchars($data["id"]);
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
              WHERE id = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


// =========================
// FUNCTION HAPUS DATA TAMU
// =========================
function hapus_tamu($id)
{
    global $koneksi;

    $query = "DELETE FROM tamu WHERE id = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}   

// =========================
// FUNCTION TAMBAH DATA USER
// =========================
function tambah_user($data)
{
    global $koneksi;

    $username = htmlspecialchars($data['username'] ?? '');
    $password = password_hash($data['password'] ?? '', PASSWORD_DEFAULT);
    $user_role = htmlspecialchars($data['user_role'] ?? '');

    $query = "INSERT INTO users
              (username, password, user_role)
              VALUES
              ('$username', '$password', '$user_role')";

    $simpan = mysqli_query($koneksi, $query);

    if (!$simpan) {
        die("Gagal menyimpan data user: " . mysqli_error($koneksi));
    }

    return mysqli_affected_rows($koneksi);
}
