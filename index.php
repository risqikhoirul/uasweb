<?php
// Koneksi ke database
include("database/koneksi.php");

$errorMessage = ""; // Inisialisasi pesan

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form login
    $username = $_POST['user'];
    $password = $_POST['password'];

    // Query untuk mengambil data user berdasarkan username
    $sql = "SELECT * FROM table_user WHERE user='$username' AND password='$password'";
    $result = $koneksi->query($sql);

    // Periksa apakah username ditemukan dan password sesuai
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Jika login berhasil, simpan data user ke session
        session_start();
        $_SESSION['user'] = $user['user'];
        $_SESSION['nama'] = $user['nama'];
        header('Location: form.php');
        exit; // Hentikan eksekusi script setelah melakukan redirect
    } else {
        // Jika username tidak ditemukan, tampilkan pesan error
        $errorMessage = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link rel="icon" href="img/book-fill.svg" type="image/x-icon" />
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">NoteMoney</a>
    </div>
  </nav>
  
  <div class="container">
    <div class="row justify-content-center align-items-center vh-100">
      <div class="col-lg-4 col-md-6 col-sm-8">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title text-center mb-4">Login</h3>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="mb-3">
                <label for="user" class="form-label">Username</label>
                <input type="text" name="user" class="form-control" id="user" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
              </div>
              <button type="submit" class="btn btn-primary w-100 mt-4">Sign</button>
            </form><br>
            <p>Belum memiliki akun? <a href="register.php" class="text-decoration-none text-dark">Registrasi</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script untuk menampilkan modal -->
<script>
  <?php if (!empty($errorMessage)) { ?>
    document.addEventListener('DOMContentLoaded', function() {
      var errorMessage = "<?php echo $errorMessage; ?>";
      var modal = new bootstrap.Modal(document.getElementById('errorModal'));
      document.getElementById('errorModalBody').innerHTML = errorMessage;
      modal.show();
    });
  <?php } ?>
</script>

<!-- Modal Bootstrap untuk pesan kesalahan -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Pesan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="errorModalBody">
        <!-- Pesan kesalahan akan ditampilkan di sini -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  </script>
  </body>
  </html>
