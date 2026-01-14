<?php 
session_start();
if(!isset($_SESSION['ssLoginRM'])){ header('location: ../otentikasi/index.php'); exit(); }
require '../config.php';
$title = 'Data PPKS';
require '../templates/header.php';
require '../templates/sidebar.php';

$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';
?>

<style>
    /* Menjaga warna teks tabel tetap hitam tajam */
    .table thead th, .table tbody td { color: #000 !important; }
    
    /* Wrapper untuk pencarian dan tombol download */
    .filter-section {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 1.5rem;
    }
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100" style="background-color: #f8f9fc;">
  <div class="d-flex justify-content-between align-items-center pt-4 pb-3 mb-3">
    <div>
        <h3 class="fw-bold text-dark mb-0">Data PPKS</h3>
        <p class="text-muted small mb-0">Daftar Pemerlu Pelayanan Kesejahteraan Sosial</p>
    </div>
    <a href="tambah-pasien.php" class="btn btn-primary btn-sm px-3 shadow-sm rounded-3">
      <i class="bi bi-plus-lg me-1"></i> Tambah Baru
    </a>
  </div>
  
  <div class="card border-0 shadow-sm rounded-0">
    <div class="card-body p-3">
        <div class="filter-section">
            <form action="" method="get" class="m-0">
                <div class="input-group input-group-sm shadow-sm" style="width: 250px;">
                    <input type="text" name="keyword" class="form-control border-0 text-dark" placeholder="Cari NIK..." value="<?= $keyword ?>" autocomplete="off">
                    <button class="btn btn-primary px-3" type="submit">Cari</button>
                </div>
            </form>
            
            <?php 
            // Cek jabatan Administrator (Level 1)
            if (isset($_SESSION['ssUserJab']) && $_SESSION['ssUserJab'] == '1') : ?>
            <button type="button" onclick="exportPasienExcel()" class="btn btn-success btn-sm shadow-sm px-3">
                <i class="bi bi-file-earmark-excel me-1"></i> Download Excel
            </button>
            <?php endif; ?>
        </div>

        <div class="table-responsive">
            <table id="tablePasien" class="table table-bordered table-hover align-middle mb-0 small" style="border-color: #dee2e6;">
              <thead class="bg-light">
                <tr class="text-center">
                  <th class="py-3 fw-bold text-dark border-1">No</th>
                  <th class="py-3 fw-bold text-dark border-1">NIK</th>
                  <th class="py-3 fw-bold text-dark border-1">Nama Lengkap</th>
                  <th class="py-3 fw-bold text-dark border-1">Jenis PPKS</th>
                  <th class="py-3 fw-bold text-dark border-1">L/P</th>
                  <th class="py-3 fw-bold text-dark border-1">Alamat</th>
                  <th class="py-3 fw-bold text-dark border-1 no-print" style="width: 120px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                $sql = "SELECT * FROM tbl_ppks";
                if($keyword){ $sql .= " WHERE nik LIKE '%$keyword%' OR nama_ppks LIKE '%$keyword%'"; }
                $sql .= " ORDER BY nama_ppks ASC";
                $query = mysqli_query($koneksi, $sql);
                while($data = mysqli_fetch_assoc($query)){
                ?>
                  <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="fw-bold td-nik"><?= $data['nik']; ?></td>
                    <td><?= $data['nama_ppks']; ?></td>
                    <td><?= $data['jenis_ppks']; ?></td>
                    <td class="text-center"><?= $data['jk']; ?></td>
                    <td><?= $data['alamat']; ?></td>
                    <td class="text-center no-print">
                      <a href="edit-pasien.php?id=<?= $data['nik']; ?>" class="text-decoration-none fw-bold text-secondary">Edit</a>
                      <span class="mx-1 text-muted">|</span>
                      <a href="proses-pasien.php?aksi=hapus&id=<?= $data['nik']; ?>" class="text-decoration-none fw-bold text-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
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
function exportPasienExcel() {
    let table = document.getElementById("tablePasien").cloneNode(true);
    let actions = table.querySelectorAll('.no-print');
    actions.forEach(el => el.remove());
    
    // Mencegah NIK 16 digit berubah menjadi format scientific di Excel
    let nikCells = table.querySelectorAll('.td-nik');
    nikCells.forEach(cell => { cell.innerHTML = '&nbsp;' + cell.innerText; });
    
    let tableHTML = table.innerHTML;
    let excelTemplate = `
        <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
        <head><meta charset="UTF-8"></head>
        <body>
            <table border="0">
                <tr><th colspan="6" style="font-size:16px; text-align:center;">DATABASE PEMERLU PELAYANAN KESEJAHTERAAN SOSIAL (PPKS)</th></tr>
                <tr><th colspan="6" style="font-size:14px; text-align:center;">DINAS SOSIAL SIKS-PPKS</th></tr>
                <tr><td colspan="6"></td></tr>
            </table>
            <table border="1">${tableHTML}</table>
        </body>
        </html>`;
    
    let dataType = 'application/vnd.ms-excel';
    let downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    downloadLink.href = 'data:' + dataType + ', ' + encodeURIComponent(excelTemplate);
    downloadLink.download = 'Data_PPKS_Full.xls';
    downloadLink.click();
}
</script>

<?php require '../templates/footer.php'; ?>