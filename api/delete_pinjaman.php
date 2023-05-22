<?php
session_start();
// Periksa apakah user sudah login atau belum
if (!isset($_SESSION['user'])) {
	header('Location: ../index.php');
}
require_once '../database/koneksi.php';

$no = $_GET['no'];

// Menyiapkan respon dalam format JSON
header('Content-Type: application/json');

// Escape characters untuk mencegah SQL injection
$no = $koneksi->real_escape_string($no);

// Query SELECT untuk memeriksa apakah nomor urut masih ada pada tabel keuangan
$sql_check = "SELECT * FROM table_pinjaman WHERE no = '$no'";
$result_check = $koneksi->query($sql_check);

if ($result_check->num_rows == 0) {
  // Jika nomor urut sudah tidak ada pada tabel keuangan
  http_response_code(404);
  echo json_encode(array('status' => false, 'message' => 'Nomor urut tidak ditemukan'));
} else {
  // Jika nomor urut masih ada pada tabel keuangan, lakukan penghapusan data
  $sql_delete = "DELETE FROM table_pinjaman WHERE no = '$no'";
  $result_delete = $koneksi->query($sql_delete);

  if ($result_delete) {
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
