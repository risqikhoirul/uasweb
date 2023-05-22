<?php
session_start();
// Periksa apakah user sudah login atau belum
if (!isset($_SESSION['user'])) {
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>NoteMoney</title>
    <link rel="icon" href="img/book-fill.svg" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="M Khoirul Risqi M Ahsanul Fikri" />
    <meta name="generator" content="Hugo 0.104.2" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>

    <main class="d-flex flex-nowrap">
      <h1 class="visually-hidden">Sidebars examples</h1>

      <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
          <span class="fs-4">NoteMoney</span>
        </a>
        <hr />
        <ul class="nav nav-pills flex-column mb-auto">
          <li>
            <a href="form.php" class="nav-link active text-white">
            <i class="bi bi-card-text"></i>
              Catatan
            </a>
          </li>
          <li>
            <a href="form_pinjaman.php" class="nav-link text-white">
            <i class="bi bi-bell"></i>
              Pengingat
            </a>
          </li>
        </ul>
        <hr />
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-circle"></i>
            <strong><?php echo $_SESSION['nama'];?></strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="#" onclick="openSignoutModal()">Sign Out</a></li>
      </ul>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal" id="signoutModal" tabindex="-1" role="dialog" aria-labelledby="signoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="signoutModalLabel">Konfirmasi Sign Out</h5>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin sign out?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="closeSignoutModal()" data-dismiss="modal">Batal</button>
          <!-- <button type="button" class="btn btn-primary" onclick="signOut()">Sign Out</button> -->
          <a class="btn btn-primary" href="logout.php">Sign Out</a>
        </div>
      </div>
    </div>
  </div>

      <div class="b-example-divider b-example-vr"></div>

      <!--  -->
	
	<div class="container table-scrollable">
		<h1>Catatan</h1>
		<!-- form input data -->
		<form method="post" id="myForm" action="" class="container">
		  <div class="row">
		    <div class="col-md-12 mb-3">
		      <label for="jenis" class="form-label">Jenis:</label>
		      <select class="form-select" id="jenis" name="jenis">
		        <option value="pemasukan">Pemasukan</option>
		        <option value="pengeluaran">Pengeluaran</option>
		      </select>
		    </div>
			<label for="nilai" class="form-label">Nilai:</label>
			<div class="col-md-12 input-group mb-3">
  			<div class="input-group-prepend">
   			 <span class="input-group-text" id="inputGroup-sizing-default">Rp</span>
  				</div>
				  <input type="number" class="form-control" id="nilai" name="nilai" required>
					</div>

		    <div class="col-md-12 mb-3">
		      <label for="keterangan" class="form-label">Keterangan:</label>
		      <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
		    </div>
		  </div>
		  <div class="row">
		    <div class="col-md-12 text-center">
		      <button onclick="refesh()" type="submit" class="btn btn-primary">Simpan</button>
		    </div>
		  </div>
		</form>
    <input type="hidden" id="user-id" value="<?php echo $_SESSION['user']; ?>">
		<!-- table data -->
<div id="hapus"></div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Jenis</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Diperbarui</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody id="table-data" class="table-group-divider">
  </tbody>
</table>

<div id="pagination">
  <button id="previousPage">Previous</button>
  <button id="nextPage">Next</button>
</div>
<!--  -->
<div class="container">
  <footer class="py-3 my-4">
    <div class="nav justify-content-center border-bottom pb-3 mb-3"></div>
    <p class="text-center text-muted">&copy; 2023 NoteMoney, Inc</p>
  </footer>
</div>
<!--  -->
</div>
</main>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">berhasil!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Data anda telah berhasil ditambahkan.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Failure Modal -->
<div class="modal fade" id="failureModal" tabindex="-1" aria-labelledby="failureModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="failureModalLabel">Gagal!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Data anda gagal ditambahkan, silahkan ulangi lagi!.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal form input -->
<div class="modal" tabindex="-1" role="dialog" id="modalForm">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit</h5>
      </div>
      <div class="modal-body">
      <form method="post" id="myFormModal" action="" class="container">
		  <div class="row">
		    <div class="col-md-12 mb-3">
		      <label for="jenisModal" class="form-label">Jenis:</label>
		      <select class="form-select" id="jenisModal" name="jenis">
		        <option value="pemasukan">Pemasukan</option>
		        <option value="pengeluaran">Pengeluaran</option>
		      </select>
		    </div>
			<label for="nilaiModal" class="form-label">Nilai:</label>
			<div class="col-md-12 input-group mb-3">
  			<div class="input-group-prepend">
   			 <span class="input-group-text" id="inputGroup-sizing-default">Rp</span>
  				</div>
				  <input type="number" class="form-control" id="nilaiModal" name="nilai" required>
					</div>

		    <div class="col-md-12 mb-3">
		      <label for="keteranganModal" class="form-label">Keterangan:</label>
		      <textarea class="form-control" id="keteranganModal" name="keterangan" rows="3" required></textarea>
		    </div>
		  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
        <button type="button" class="btn btn-primary" onclick="saveData(); refesh();">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Script JavaScript -->

<script>
      const openSignoutModal = () => {
      var modal = document.getElementById("signoutModal");
      modal.style.display = "block";
    }

    const closeSignoutModal = () => {
      var modal = document.getElementById("signoutModal");
      modal.style.display = "none";
    }
</script>
<script src="js/create.js"></script>
<script src="js/read.js"></script>
<script src="js/update.js"></script>
<script src="js/delete.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>