<?php 
session_start();
if(!isset($_SESSION['ssLoginRM'])){ header('location: ../otentikasi/index.php'); exit(); }
require '../config.php';
$title = 'Data Pelayanan';
require '../templates/header.php';
require '../templates/sidebar.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100" style="background-color: #f8f9fc;">
  
  <div class="d-flex justify-content-between align-items-center pt-4 pb-3 mb-3">
    <div>
        <h3 class="fw-bold text-dark mb-0">Data Pelayanan</h3>
        <p class="text-muted small mb-0">Jenis Bantuan & Layanan Sosial</p>
    </div>
    <div class="d-flex gap-2">
        <?php if (isset($_SESSION['ssUserJab']) && $_SESSION['ssUserJab'] == '1') : ?>
        <button type="button" onclick="exportLayananExcel()" class="btn btn-success btn-sm px-3 shadow-sm rounded-3">
          <i class="bi bi-file-earmark-excel me-1"></i> Download Excel
        </button>
        <?php endif; ?>
        <a href="tambah-obat.php" class="btn btn-primary btn-sm px-3 shadow-sm rounded-3">
          <i class="bi bi-plus-lg me-1"></i> Tambah Layanan
        </a>
    </div>
  </div>

  <div class="card border-0 shadow-sm rounded-0">
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="tableDataPelayanan" class="table table-bordered table-hover align-middle mb-0" style="border-color: #dee2e6;">
              <thead class="bg-light">
                <tr>
                  <th class="py-3 text-center small fw-bold text-dark border-1">No</th>
                  <th class="py-3 small fw-bold text-dark border-1">Jenis Layanan</th>
                  <th class="py-3 small fw-bold text-dark border-1">Deskripsi / Detail</th>
                  <th class="py-3 text-center small fw-bold text-dark no-print border-1" style="width: 120px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM tbl_layanan ORDER BY jenis_layanan ASC");
                while($data = mysqli_fetch_assoc($query)){
                ?>
                  <tr>
                    <td class="text-center text-dark small"><?= $no++; ?></td>
                    <td class="text-dark small fw-bold"><?= $data['jenis_layanan']; ?></td>
                    <td class="text-dark small"><?= $data['deskripsi_layanan']; ?></td>
                    <td class="text-center small no-print">
                      <a href="edit-obat.php?id=<?= $data['id_layanan']; ?>" class="text-decoration-none fw-bold text-secondary">Edit</a>
                      <span class="mx-1 text-muted">|</span>
                      <a href="proses-obat.php?aksi=hapus&id=<?= $data['id_layanan']; ?>" class="text-decoration-none fw-bold text-danger" onclick="return confirm('Hapus layanan ini?')">Hapus</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
        </div>
    </div>
  </div>
</main>

<script>
function exportLayananExcel() {
    let table = document.getElementById("tableDataPelayanan").cloneNode(true);
    let actions = table.querySelectorAll('.no-print');
    actions.forEach(el => el.remove());

    let tableHTML = table.innerHTML;
    let excelTemplate = `
        <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
        <head><meta charset="UTF-8"></head>
        <body>
            <table border="0">
                <tr><th colspan="3" style="font-size:16px; text-align:center;">DATA MASTER LAYANAN SOSIAL</th></tr>
                <tr><td colspan="3"></td></tr>
            </table>
            <table border="1">${tableHTML}</table>
        </body>
        </html>`;

    let dataType = 'application/vnd.ms-excel';
    let downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    downloadLink.href = 'data:' + dataType + ', ' + encodeURIComponent(excelTemplate);
    downloadLink.download = 'Data_Master_Layanan.xls';
    downloadLink.click();
}
</script>

<?php require '../templates/footer.php'; ?>