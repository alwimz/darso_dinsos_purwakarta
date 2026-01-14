<?php
session_start();
if(!isset($_SESSION['ssLoginRM'])){ header('location: ../otentikasi/index.php'); exit(); }
require '../config.php';
$title = 'Laporan SIKS PPKS';
require '../templates/header.php';
require '../templates/sidebar.php';
// Parameter pencarian agar tabel tidak kosong
$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';
$cari_layanan = isset($_GET['cari_layanan']) ? mysqli_real_escape_string($koneksi, $_GET['cari_layanan']) : '';
// Otomatis aktifkan tab yang sedang dicari
$active_tab = isset($_GET['cari_layanan']) ? 'layanan' : 'asesmen';
?>
<style>
    .filter-wrapper { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
    .table thead th, .table tbody td { color: #000 !important; }
</style>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100" style="background-color: #f8f9fc;">
  <div class="pt-4 pb-3 mb-3">
    <h3 class="fw-bold text-dark mb-0">Pusat Laporan SIKS PPKS</h3>
    <p class="text-muted small mb-0">Riwayat Pemeriksaan & Distribusi Layanan</p>
  </div>
  <ul class="nav nav-tabs border-0 mb-3" id="myTab" role="tablist">
    <li class="nav-item">
      <button class="nav-link <?= $active_tab == 'asesmen' ? 'active' : '' ?> fw-bold border-0 shadow-sm me-2 px-4" data-bs-toggle="tab" data-bs-target="#asesmen" type="button">1. Laporan Asesmen</button>
    </li>
    <li class="nav-item">
      <button class="nav-link <?= $active_tab == 'layanan' ? 'active' : '' ?> fw-bold border-0 shadow-sm px-4" data-bs-toggle="tab" data-bs-target="#layanan" type="button">2. Laporan Layanan</button>
    </li>
  </ul>
  <div class="card border-0 shadow-sm rounded-0">
    <div class="card-body p-3">
      <div class="tab-content">
        <div class="tab-pane fade <?= $active_tab == 'asesmen' ? 'show active' : '' ?>" id="asesmen">
          <form action="" method="get" class="mb-3">
            <div class="input-group shadow-sm" style="max-width: 250px;">
              <input type="text" name="keyword" class="form-control border-0 small text-dark" placeholder="Cari NIK..." value="<?= $keyword ?>">
              <button class="btn btn-primary btn-sm px-3" type="submit"><i class="bi bi-search"></i> Cari</button>
            </div>
          </form>
          <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0 small">
              <thead class="bg-light fw-bold text-center">
                <tr>
                  <th>No</th>
                  <th>No. Asesmen</th>
                  <th>NIK</th>
                  <th>Tanggal</th>
                  <th>Nama PPKS</th>
                  <th>Kondisi PPKS</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $sql_asesmen = "SELECT * FROM tbl_asesmen INNER JOIN tbl_ppks ON tbl_asesmen.nik = tbl_ppks.nik WHERE 1=1";
                if($keyword) { $sql_asesmen .= " AND tbl_ppks.nik LIKE '%$keyword%'"; }
                $sql_asesmen .= " ORDER BY tgl_asesmen DESC";
                $query_asesmen = mysqli_query($koneksi, $sql_asesmen);
                while($data = mysqli_fetch_assoc($query_asesmen)){
                ?>
                <tr>
                  <td class="text-center"><?= $no++ ?></td>
                  <td class="fw-bold"><?= $data['no_asesmen'] ?></td>
                  <td><?= $data['nik'] ?></td>
                  <td><?= date('d/m/Y', strtotime($data['tgl_asesmen'])) ?></td>
                  <td class="fw-bold"><?= $data['nama_ppks'] ?></td>
                  <td><?= substr($data['kondisi_ppks'], 0, 40) ?>...</td>
                  <td class="text-center">
                    <a href="laporan.php?id=<?= $data['no_asesmen'] ?>" target="_blank" class="fw-bold text-primary">Cetak</a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane fade <?= $active_tab == 'layanan' ? 'show active' : '' ?>" id="layanan">
          <div class="filter-wrapper">
            <form action="" method="get" class="m-0">
                <div class="input-group shadow-sm" style="max-width: 400px;">
                    <input type="text" name="cari_layanan" class="form-control border-0 small text-dark" placeholder="Cari Jenis Layanan..." value="<?= $cari_layanan ?>">
                    <button class="btn btn-primary btn-sm px-3" type="submit">Cari</button>
                </div>
            </form>
            <?php if (isset($_SESSION['ssUserJab']) && $_SESSION['ssUserJab'] == '1') : ?>
            <button type="button" onclick="exportLayananExcel()" class="btn btn-success btn-sm shadow-sm px-3">
                <i class="bi bi-file-earmark-excel me-1"></i> Download Excel
            </button>
            <?php endif; ?>
          </div>
          <div class="table-responsive">
            <table id="tableLayanan" border="1" class="table table-bordered align-middle mb-0 small">
              <thead class="bg-light fw-bold text-center">
                <tr>
                  <th>No</th>
                  <th>Layanan Yang Diberikan</th>
                  <th>Penerima Layanan (Nama PPKS)</th>
                  <th>Jenis PPKS</th>
                  <th>NIK PPKS</th>
                  <th>Petugas</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no_l = 1;
                $sql_l = "SELECT * FROM tbl_asesmen INNER JOIN tbl_ppks ON tbl_asesmen.nik = tbl_ppks.nik WHERE 1=1";
                if($cari_layanan) { $sql_l .= " AND tbl_asesmen.layanan_dibutuhkan LIKE '%$cari_layanan%'"; }
                $sql_l .= " ORDER BY tgl_asesmen DESC";
                $queryL = mysqli_query($koneksi, $sql_l);
                if(mysqli_num_rows($queryL) > 0) {
                    while($dL = mysqli_fetch_assoc($queryL)){
                    ?>
                    <tr>
                      <td align="center"><?= $no_l++ ?></td>
                      <td class="fw-bold"><?= $dL['layanan_dibutuhkan'] ?></td>
                      <td><?= $dL['nama_ppks'] ?></td>
                      <td><?= $dL['jenis_ppks'] ?></td>
                      <td class="td-nik"><?= $dL['nik'] ?></td>
                      <td><?= $dL['petugas_asesmen'] ?></td>
                    </tr>
                    <?php }
                } else {
                    echo "<tr><td colspan='6' class='text-center py-3'>Data tidak ditemukan</td></tr>";
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
function exportLayananExcel() {
    let table = document.getElementById("tableLayanan").cloneNode(true);
    let nikCells = table.querySelectorAll('.td-nik');
    nikCells.forEach(cell => { cell.innerHTML = ' ' + cell.innerText; });
    let tableHTML = table.innerHTML;
    let excelTemplate = `
        <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
        <head><meta charset="UTF-8"></head>
        <body>
            <table border="0">
                <tr><th colspan="6" style="font-size:16px; text-align:center;">LAPORAN DISTRIBUSI LAYANAN SOSIAL</th></tr>
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
    downloadLink.download = 'Laporan_Layanan_PPKS.xls';
    downloadLink.click();
}
</script>
<?php require '../templates/footer.php'; ?>