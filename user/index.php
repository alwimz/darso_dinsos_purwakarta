<?php 
session_start();
if(!isset($_SESSION['ssLoginRM'])){ header('location: ../otentikasi/index.php'); exit(); }
require '../config.php';
$title = 'User Management';
require '../templates/header.php';
require '../templates/sidebar.php';

// Proteksi Halaman: Hanya Administrator yang bisa mengelola user
if($_SESSION['ssUserJab'] != 1){
  echo "<script>alert('Akses ditolak!'); window.location='../index.php';</script>"; exit();
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100" style="background-color: #f8f9fc;">
  
  <div class="d-flex justify-content-between align-items-center pt-4 pb-3 mb-3">
    <div>
        <h3 class="fw-bold text-dark mb-0">Manajemen User</h3>
        <p class="text-muted small mb-0">Kelola Akun Petugas, Supervisor & Admin</p>
    </div>
    <a href="tambah-user.php" class="btn btn-primary btn-sm px-3 shadow-sm rounded-3">
      <i class="bi bi-plus-lg me-1"></i> User Baru
    </a>
  </div>

  <div class="card border-0 shadow-sm rounded-0">
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0" style="border-color: #dee2e6;">
              <thead class="bg-light">
                <tr>
                  <th class="py-3 text-center small fw-bold text-dark">No</th>
                  <th class="py-3 small fw-bold text-dark">Foto</th>
                  <th class="py-3 small fw-bold text-dark">Akun</th>
                  <th class="py-3 small fw-bold text-dark">Jabatan</th>
                  <th class="py-3 small fw-bold text-dark">Alamat</th>
                  <th class="py-3 text-center small fw-bold text-dark" style="width: 120px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                $queryUser = mysqli_query($koneksi, "SELECT * FROM tbl_user ORDER BY username ASC");
                while($user = mysqli_fetch_assoc($queryUser)){
                    // LOGIKA JABATAN BARU: 1=Admin, 2=Supervisor, 3=Petugas
                    if($user['jabatan'] == 1) {
                        $jab = "Administrator";
                    } elseif($user['jabatan'] == 2) {
                        $jab = "Supervisor";
                    } else {
                        $jab = "Petugas";
                    }

                    $gambar = !empty($user['gambar']) ? $user['gambar'] : 'user.png';
                    // Menggunakan id_user sebagai primary key sesuai database baru
                    $id_user = $user['id_user']; 
                ?>
                  <tr>
                    <td class="text-center text-dark small"><?= $no++; ?></td>
                    <td>
                        <img src="../assets/gambar/<?= $gambar ?>" alt="User" class="rounded-circle border" style="width: 35px; height: 35px; object-fit: cover;">
                    </td>
                    <td>
                        <div class="fw-bold text-dark small"><?= $user['username']; ?></div>
                        <div class="text-muted" style="font-size: 0.75rem;"><?= $user['fullname']; ?></div>
                    </td>
                    <td class="text-dark small"><?= $jab ?></td>
                    <td class="text-dark small"><?= !empty($user['alamat']) ? substr($user['alamat'], 0, 20).'...' : '-' ?></td>
                    <td class="text-center small">
                      <a href="edit-user.php?id=<?= $id_user ?>" class="text-decoration-none fw-bold text-secondary">Edit</a>
                      <span class="mx-1 text-muted">|</span>
                      <a href="proses-user.php?id=<?= $id_user ?>&gambar=<?= $gambar ?>&aksi=hapus-user" class="text-decoration-none fw-bold text-danger" onclick="return confirm('Hapus user ini?')">Hapus</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
        </div>
    </div>
  </div>
</main>
<?php require '../templates/footer.php'; ?>