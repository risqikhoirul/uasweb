<?php
// Mengecek apakah user sudah login atau belum
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: ../index.php');
  exit();
}


// Mengambil data dari tabel keuangan
require_once '../database/koneksi.php';

// Mengambil parameter user dan halaman dari query string
$user = $_GET['user'];
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perPage = 10; // Jumlah data per halaman

// Melakukan sanitasi pada variabel user
$user = $koneksi->real_escape_string($user);

// Menghitung offset (posisi awal data) berdasarkan halaman
$offset = ($page - 1) * $perPage;

// Melakukan sanitasi pada variabel user
$user = $koneksi->real_escape_string($user);
$sql = "SELECT no, jenis, user, nilai, created_at FROM table_pinjaman WHERE user = '$user' ORDER BY created_at ASC LIMIT $offset, $perPage";
$result = $koneksi->query($sql);

// Menyiapkan respon dalam format JSON
header('Content-Type: application/json');

if ($result->num_rows > 0) {
  $data = array();
  while ($row = $result->fetch_assoc()) {
    $data[] = array(
      'no' => $row['no'],
      'jenis' => $row['jenis'],
      'user' => $row['user'],
      'nilai' => $row['nilai'],
      'created_at' => $row['created_at']
    );
  }
  // Menghitung jumlah data total
  $totalCount = $koneksi->query("SELECT COUNT(*) as count FROM table_keuangan WHERE user = '$user'")->fetch_assoc()['count'];

  // Menghitung jumlah halaman yang tersedia
  $totalPages = ceil($totalCount / $perPage);

  echo json_encode(array('status' => true, 'data' => $data, 'totalPages' => $totalPages));
} else {
  echo json_encode(array('status' => false, 'data' => 'Tidak ada data'));
}

?>