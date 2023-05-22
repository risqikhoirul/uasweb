const userId = document.getElementById("user-id").value;
let currentPage = 1; // Melacak halaman saat ini
let totalPages = 1; // Melacak jumlah halaman total

// Fungsi untuk mengambil data dari API dan membuat baris tabel
const readTable = (page) => {
  fetch(`api/index.php?user=${userId}&page=${page}`)
    .then((response) => response.json())
    .then((data) => {
      let rows = "";
      let count = (page - 1) * 10 + 1;

      if (!data.status) {
        rows = `
          <tr>
            <td colspan="6"><center>Tidak ada data</center></td>
          </tr>
        `;
      } else {
        data.data.forEach((item) => {
          rows += `
            <tr>
              <td>${count++}</td>
              <td>${item.jenis}</td>
              <td>Rp. ${item.nilai}</td>
              <td>${item.keterangan}</td>
              <td>${item.created_at}</td>
              <td>
                <button class="btn btn-sm btn-primary edit-btn" onclick="openModal(); fromUp(${item.no});">Edit</button>
                <button class="btn btn-sm btn-danger delete-btn" onclick="deleteTable(${item.no}); refesh();">Delete</button>
              </td>
            </tr>
          `;
        });
      }
      document.getElementById("table-data").innerHTML = rows;
      totalPages = data.totalPages; // Memperbarui jumlah halaman total
    })
    .catch((error) => {
      console.error("Terjadi kesalahan:", error);
    });
};

// Fungsi untuk memperbarui tampilan data sesuai halaman saat ini
const updateData = () => readTable(currentPage);

// Mengambil data untuk halaman pertama
updateData();

// Event listener untuk tombol Previous
document.getElementById("previousPage").addEventListener("click", function () {
  if (currentPage > 1) {
    currentPage--;
    updateData();
  }
});

// Event listener untuk tombol Next
document.getElementById("nextPage").addEventListener("click", function () {
  if (currentPage < totalPages) {
    currentPage++;
    updateData();
  }
});

// untuk memperbarui tabel
const refesh = () => setTimeout(updateData, 500);
