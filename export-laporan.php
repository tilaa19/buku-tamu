<?php

require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setTitle('Laporan Tamu');

// Header
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'TANGGAL');
$sheet->setCellValue('C1', 'NAMA TAMU');
$sheet->setCellValue('D1', 'ALAMAT');
$sheet->setCellValue('E1', 'NO TELEPON/HP');
$sheet->setCellValue('F1', 'BERTEMU DENGAN');
$sheet->setCellValue('G1', 'KEPENTINGAN');

// Ambil data
if (isset($_GET['cari'])) {

    $p_awal = $_GET['p_awal'];
    $p_akhir = $_GET['p_akhir'];

    $data = mysqli_query(
        $koneksi,
        "SELECT * FROM tamu
         WHERE tanggal BETWEEN '$p_awal' AND '$p_akhir'
         ORDER BY tanggal DESC"
    );

} else {

    $data = mysqli_query(
        $koneksi,
        "SELECT * FROM tamu
         ORDER BY tanggal DESC"
    );
}

// Masukkan data ke Excel
$i = 2;
$no = 1;

while ($d = mysqli_fetch_assoc($data)) {

    $sheet->setCellValue('A' . $i, $no++);
    $sheet->setCellValue('B' . $i, $d['tanggal']);
    $sheet->setCellValue('C' . $i, $d['nama_tamu']);
    $sheet->setCellValue('D' . $i, $d['alamat']);
    $sheet->setCellValue('E' . $i, $d['no_hp']);
    $sheet->setCellValue('F' . $i, $d['bertemu']);
    $sheet->setCellValue('G' . $i, $d['kepentingan']);

    $i++;
}

// Lebar kolom otomatis
foreach (range('A', 'G') as $kolom) {
    $sheet->getColumnDimension($kolom)->setAutoSize(true);
}

// Download file Excel
$filename = 'Laporan Buku Tamu.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

exit;
