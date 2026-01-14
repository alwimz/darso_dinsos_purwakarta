<?php 
session_start();
if(!isset($_SESSION['ssLoginRM'])) header('location: ../otentikasi/index.php');
// Proteksi: Hanya Administrator yang bisa akses
if($_SESSION['ssUserJab'] != 1){
  echo "<script>alert('Akses ditolak! Hanya Administrator yang bisa mengakses halaman ini.'); window.location='../index.php';</script>"; exit();
}
require '../config.php';
$title = 'Bukti Asesmen';
require '../templates/header.php';
require '../templates/sidebar.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100" style="background-color: #f8f9fc;">
  <div class="d-flex justify-content-between align-items-center pt-4 pb-3 mb-3">
    <div>
        <h3 class="fw-bold text-dark mb-0">Bukti Asesmen</h3>
        <p class="text-muted small mb-0">Kelola Link Bukti Asesmen</p>
    </div>
    <a href="tambah-data.php" class="btn btn-primary btn-sm px-3 shadow-sm rounded-3">
      <i class="bi bi-plus-lg me-1"></i> Tambah Bukti
    </a>
  </div>

  <?php if(isset($_GET['msg'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?php 
        if($_GET['msg'] == 'disimpan') echo 'Bukti asesmen berhasil disimpan!';
        elseif($_GET['msg'] == 'diupdate') echo 'Bukti asesmen berhasil diperbarui!';
      ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <div class="card border-0 shadow-sm rounded-0">
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0" style="border-color: #dee2e6;">
              <thead class="bg-light">
                <tr>
                  <th class="py-3 text-center small fw-bold text-dark">No</th>
                  <th class="py-3 small fw-bold text-dark">No. Asesmen</th>
                  <th class="py-3 small fw-bold text-dark">NIK</th>
                  <th class="py-3 small fw-bold text-dark">Nama PPKS</th>
                  <th class="py-3 small fw-bold text-dark">Link Bukti</th>
                  <th class="py-3 text-center small fw-bold text-dark" style="width: 100px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                $sql = "SELECT a.no_asesmen, a.nik, a.link_bukti, p.nama_ppks 
                        FROM tbl_asesmen a 
                        INNER JOIN tbl_ppks p ON a.nik = p.nik 
                        ORDER BY a.tgl_asesmen DESC";
                $query = mysqli_query($koneksi, $sql);
                while($data = mysqli_fetch_assoc($query)):
                ?>
                  <tr>
                    <td class="text-center text-dark small"><?= $no++; ?></td>
                    <td class="text-dark small fw-bold"><?= $data['no_asesmen']; ?></td>
                    <td class="text-dark small"><?= $data['nik']; ?></td>
                    <td class="text-dark small"><?= $data['nama_ppks']; ?></td>
                    <td class="text-dark small">
                      <?php if(!empty($data['link_bukti'])): ?>
                        <a href="<?= $data['link_bukti']; ?>" target="_blank" class="text-primary">
                          <i class="bi bi-link-45deg"></i> Lihat Bukti
                        </a>
                      <?php else: ?>
                        <span class="badge bg-warning text-dark">Belum ada</span>
                      <?php endif; ?>
                    </td>
                    <td class="text-center small">
                      <a href="tambah-data.php?no=<?= $data['no_asesmen'] ?>" class="text-decoration-none fw-bold text-secondary">
                        <i class="bi bi-pencil"></i> Edit
                      </a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
        </div>
    </div>
  </div>
</main>
<?php require '../templates/footer.php'; ?>
