<?php
session_start();
if(!isset($_SESSION['ssLoginRM'])){ header('location: ../otentikasi/index.php'); exit(); }
require_once '../config.php';
// Judul halaman
$title = 'Data Asesmen';
require_once '../templates/header.php';
require_once '../templates/sidebar.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100 bg-light">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-4 border-bottom">
    <div>
        <h1 class="h2 fw-bold">Data Asesmen</h1>
        <p class="text-muted">Daftar riwayat pemeriksaan PPKS masuk.</p>
    </div>
    <div class="d-flex gap-2">
        <?php if (isset($_SESSION['ssUserJab']) && $_SESSION['ssUserJab'] == '1') : ?>
        <button type="button" onclick="exportAsesmenExcel()" class="btn btn-success btn-sm px-3 shadow-sm rounded-3">
          <i class="bi bi-file-earmark-excel me-1"></i> Download Excel
        </button>
        <?php endif; ?>
        <a href="tambah-data.php" class="btn btn-primary btn-sm px-3 shadow-sm rounded-3">
          <i class="bi bi-plus-lg me-1"></i> Input Asesmen
        </a>
    </div>
  </div>
  <div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="tableAsesmen" class="table table-bordered table-hover align-middle mb-0 small" style="border-color: #dee2e6;">
              <thead class="bg-light text-dark fw-bold">
                <tr class="text-center">
                  <th class="py-3 border-1">No</th>
                  <th class="py-3 border-1">No. Asesmen</th>
                  <th class="py-3 border-1">Tanggal</th>
                  <th class="py-3 border-1">Nama PPKS</th>
                  <th class="py-3 border-1">Layanan Dibutuhkan</th>
                  <th class="py-3 border-1">Petugas</th>
                  <th class="py-3 border-1 text-center no-print" style="width: 120px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                // Query mengambil data dari tbl_asesmen
                $sql = "SELECT * FROM tbl_asesmen INNER JOIN tbl_ppks ON tbl_asesmen.nik = tbl_ppks.nik ORDER BY tgl_asesmen DESC";
                $query = mysqli_query($koneksi, $sql);
                if(mysqli_num_rows($query) > 0) {
                    while($data = mysqli_fetch_assoc($query)){
                    ?>
                    <tr>
                      <td class="text-center"><?= $no++; ?></td>
                      <td class="fw-bold text-dark"><?= $data['no_asesmen']; ?></td>
                      <td><?= date('d/m/Y', strtotime($data['tgl_asesmen'])); ?></td>
                      <td class="fw-bold"><?= $data['nama_ppks']; ?></td>
                      <td style="white-space: normal !important; word-wrap: break-word; max-width: 350px;">
                          <?= $data['layanan_dibutuhkan']; ?>
                      </td>
                      <td><span class="badge bg-light text-dark border"><?= $data['petugas_asesmen']; ?></span></td>
                      <td class="text-center no-print">
                        <a href="edit-data.php?id=<?= $data['no_asesmen']; ?>" class="text-decoration-none fw-bold text-secondary small">Edit</a>
                        <span class="mx-1 text-muted">|</span>
                        <a href="proses-data.php?aksi=hapus&id=<?= $data['no_asesmen']; ?>" class="text-decoration-none fw-bold text-danger small" onclick="return confirm('Hapus data ini?')">Hapus</a>
                      </td>
                    </tr>
                    <?php }
                } else {
                    echo "<tr><td colspan='7' class='text-center py-4 text-muted'>Tidak ada data asesmen ditemukan.</td></tr>";
                } ?>
              </tbody>
            </table>
        </div>
    </div>
  </div>
</main>
<script>
function exportAsesmenExcel() {
    let table = document.getElementById("tableAsesmen").cloneNode(true);
    let actions = table.querySelectorAll('.no-print');
    actions.forEach(el => el.remove());
    let tableHTML = table.innerHTML;
    let excelTemplate = `
        <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
        <head><meta charset="UTF-8"></head>
        <body>
            <table border="0">
                <tr><th colspan="6" style="font-size:16px; text-align:center;">DATA RIWAYAT ASESMEN PPKS</th></tr>
                <tr><td colspan="6"></td></tr>
            </table>
            <table border="1">${tableHTML}</table>
        </body>
        </html>`;
    let dataType = 'application/vnd.ms-excel';
    let downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    downloadLink.href = 'data:' + dataType + ', ' + encodeURIComponent(excelTemplate);
    downloadLink.download = 'Data_Asesmen_PPKS.xls';
    downloadLink.click();
}
</script>
<?php require_once '../templates/footer.php'; ?>