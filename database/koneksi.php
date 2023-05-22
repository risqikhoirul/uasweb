<?php

  $host = "localhost";
  $user = "root"; 
  $password = "";
  $database = "db_kas";

  // Koneksi ke MySQL
  $koneksi = new mysqli($host, $user, $password, $database);

  // Cek koneksi
  if ($koneksi->connect_error) {
    die($koneksi->connect_error);
  }


?>