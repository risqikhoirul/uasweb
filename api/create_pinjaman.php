<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: ../index.php');
  exit();
}

require_once '../database/koneksi.php';

$jenis = $_POST['jenis'] ?? '';
$user = $_POST['user'] ?? '';
$tanggal = $_POST['tanggal'] ?? '';
$nilai = $_POST['nilai'] ?? '';

// Menyiapkan respon dalam format JSON
header('Content-Type: application/json');

// Memastikan bahwa data tidak kosong
if (empty($jenis) || empty($user) || empty($tanggal) || empty($nilai)) {
  http_response_code(400);
  echo json_encode(array('status' => false));
  exit();
}

// Escape characters untuk mencegah SQL injection
$jenis = $koneksi->real_escape_string($jenis);
$user = $koneksi->real_escape_string($user);
$tanggal = $koneksi->real_escape_string($tanggal);
$nilai = $koneksi->real_escape_string($nilai);

$sql = "INSERT INTO table_pinjaman (jenis, user, nilai, created_at) VALUES ('$jenis', '$user', '$nilai', '$tanggal')";
$result = $koneksi->query($sql);

if($result) {
  http_response_code(201);
  echo json_encode(array('status' => true));
} else {
  http_response_code(500);
  echo json_encode(array('status' => false));
}

// Menutup koneksi database
$koneksi->close();
?>
