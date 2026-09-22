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

// function tambah data
function tambah_tamu($data)
{
    global $koneksi;

    // Membuat ID otomatis
    $queryId = mysqli_query(
        $koneksi,
        "SELECT id FROM tamu WHERE id LIKE 'zt%' ORDER BY id DESC LIMIT 1"
    );

    $dataId = mysqli_fetch_assoc($queryId);

    if (!$dataId) {
        $kode = "zt001";
    } else {
        $urutan = (int) substr($dataId['id'], 2, 3);
        $urutan++;
        $kode = "zt" . sprintf("%03d", $urutan);
    }

    $tanggal = date("Y-m-d");
    $nama_tamu = htmlspecialchars($data["nama_tamu"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $bertemu = htmlspecialchars($data["bertemu"]);
    $kepentingan = htmlspecialchars($data["kepentingan"]);

    $query = "INSERT INTO tamu
        (id, tanggal, nama_tamu, alamat, no_hp, bertemu, kepentingan)
        VALUES
        ('$kode', '$tanggal', '$nama_tamu', '$alamat', '$no_hp', '$bertemu', '$kepentingan')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}