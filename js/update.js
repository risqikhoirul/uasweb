let itemNo;

const openModal = () => (document.getElementById("modalForm").style.display = "block");

const fromUp = (no) => (itemNo = no);

const saveData = () => {
  // Ambil nilai dari input select
  const jenisModal = document.getElementById("jenisModal").value;

  // Ambil nilai dari input number
  const nilaiModal = document.getElementById("nilaiModal").value;

  // Ambil nilai dari input textarea
  const keteranganModal = document.getElementById("keteranganModal").value;

  // Lakukan sesuatu dengan nilai input yang telah diambil
  // Contoh: Tampilkan nilai input ke dalam console log
  console.log("No: " + itemNo);
  console.log("Jenis: " + jenisModal);
  console.log("Nilai: " + nilaiModal);
  console.log("Keterangan: " + keteranganModal);

  // Buat objek FormData dan tambahkan nilai dari input jenis, nilai, user, dan keterangan ke dalamnya
  const formData = new FormData();
  formData.append("jenis", jenisModal);
  formData.append("no", itemNo);
  formData.append("nilai", nilaiModal);
  formData.append("keterangan", keteranganModal);

  // Lakukan pengiriman data ke server menggunakan fetch()
  fetch("api/update.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status) {
        document.getElementById("hapus").innerHTML = `<div class="alert alert-success" role="alert">Berhasil merubah data</div>`;
        setTimeout(() => {
          document.getElementById("hapus").innerHTML = "";
        }, 3000);
      } else {
        document.getElementById("hapus").innerHTML = `<div class="alert alert-danger" role="alert">Gagal merubah data</div>`;
        setTimeout(() => {
          document.getElementById("hapus").innerHTML = "";
        }, 3000);
      }
      console.log(data); // Cetak respons dari server di console
      // Lakukan sesuatu setelah data berhasil dikirim ke server
    })
    .catch((error) => console.error(error)); // Tangani jika terjadi error

  // Tutup modal form input
  closeModal();
};

const closeModal = () => (document.getElementById("modalForm").style.display = "none");

// Tambahkan event listener untuk form submission
document.getElementById("myFormModal").addEventListener("submit", function (event) {
  event.preventDefault(); // Jangan lakukan pengiriman data secara default
  saveData();
});
