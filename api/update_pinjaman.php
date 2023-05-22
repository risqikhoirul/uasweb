<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: ../index.php');
  exit();
}

require_once '../database/koneksi.php';

$jenis = $_POST['jenis'];
$no = $_POST['no'];
$tanggal = $_POST['tanggal'];
$nilai = $_POST['nilai'];

// Menyiapkan respon dalam format JSON
header('Content-Type: application/json');

// Memastikan bahwa data tidak kosong
if (empty($jenis) || empty($tanggal) || empty($no) || empty($nilai)) {
  http_response_code(400);
  echo json_encode(array('status' => false));
  exit();
}

// Escape characters untuk mencegah SQL injection
$jenis = $koneksi->real_escape_string($jenis);
$no = $koneksi->real_escape_string($no);
$tanggal = $koneksi->real_escape_string($tanggal);
$nilai = $koneksi->real_escape_string($nilai);

// Query SELECT untuk memeriksa apakah nomor urut masih ada pada tabel keuangan
$sql_check = "SELECT * FROM table_pinjaman WHERE no = '$no'";
$result_check = $koneksi->query($sql_check);

if ($result_check->num_rows == 0) {
  // Jika nomor urut sudah tidak ada pada tabel keuangan
  http_response_code(404);
  echo json_encode(array('status' => false, 'message' => 'Nomor urut tidak ditemukan'));
} else {

$sql = "UPDATE table_pinjaman
SET jenis = '$jenis', nilai = '$nilai', created_at = '$tanggal' WHERE no = '$no'";
$result = $koneksi->query($sql);

if($result) {
  http_response_code(201);
  echo json_encode(array('status' => true));
} else {
  http_response_code(500);
  echo json_encode(array('status' => false));
}
}

// Menutup koneksi database
$koneksi->close();
?>
