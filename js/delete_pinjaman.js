const deleteTable = (no) => {
  fetch(`api/delete_pinjaman.php?no=${no}`)
    .then((response) => response.json())
    .then((data) => {
      if (data.status) {
        document.getElementById("hapus").innerHTML = `<div class="alert alert-success" role="alert">Berhasil menghapus data</div>`;
        setTimeout(() => {
          document.getElementById("hapus").innerHTML = "";
        }, 3000);
      } else {
        document.getElementById("hapus").innerHTML = `<div class="alert alert-danger" role="alert">Gagal menghapus data</div>`;
        setTimeout(() => {
          document.getElementById("hapus").innerHTML = "";
        }, 3000);
      }
    });
};
