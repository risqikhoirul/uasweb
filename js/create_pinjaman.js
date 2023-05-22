const form = document.getElementById("myForm");

// Buat event listener untuk form ketika dikirim
form.addEventListener("submit", (event) => {
  event.preventDefault(); // Jangan lakukan pengiriman data secara default

  // Ambil nilai dari input jenis, nilai, user, dan keterangan
  const jenisInput = document.getElementById("jenis");
  const nilaiInput = document.getElementById("nilai");
  const tanggalInput = document.getElementById("tanggal");

  const jenis = jenisInput.value;
  const nilai = nilaiInput.value;
  const tanggal = tanggalInput.value;

  // Buat objek FormData dan tambahkan nilai dari input jenis, nilai, user, dan tanggal ke dalamnya
  const formData = new FormData();
  formData.append("jenis", jenis);
  formData.append("nilai", nilai);
  formData.append("user", userId);
  formData.append("tanggal", tanggal);

  // Lakukan pengiriman data ke server menggunakan fetch()
  fetch("api/create_pinjaman.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status) {
        // Tampilkan modal sukses
        const successModal = new bootstrap.Modal(document.getElementById("successModal"));
        successModal.show();

        // Mengosongkan nilai input setelah pengiriman data berhasil
        jenisInput.value = "";
        nilaiInput.value = "";
        tanggalInput.value = "";
      } else {
        // Tampilkan modal gagal
        const failureModal = new bootstrap.Modal(document.getElementById("failureModal"));
        failureModal.show();
      }
      console.log(data); // Cetak respons dari server di console
      // Lakukan sesuatu setelah data berhasil dikirim ke server
    })
    .catch((error) => console.error(error)); // Tangani jika terjadi error
});
