<?php
// --- BAGIAN 1: LOGIKA PROSES (PHP) ---
session_start();
// Cek Login
if(!isset($_SESSION['ssLoginRM'])){ header('location: ../otentikasi/index.php'); exit(); }
require_once '../config.php';
// Judul Halaman (Penting agar sidebar menyala biru)
$title = 'Ganti Password';
// Proses saat tombol Simpan ditekan
if(isset($_POST['simpan'])){
    $user_id = $_SESSION['ssUser'];
    $pass_lama = $_POST['pass_lama'];
    $pass_baru = $_POST['pass_baru'];
    $konfirmasi = $_POST['konfirmasi_pass']; // Sesuai name di form bawah
    // 1. Ambil data user dari database untuk cek password lama
    $query = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$user_id'");
    $data = mysqli_fetch_assoc($query);
    // 2. Validasi Password Lama (Database Plain Text sesuai sistem Anda)
    if($pass_lama !== $data['password']){
        echo "<script>alert('Gagal! Password Lama salah.'); document.location='ganti-password.php';</script>";
        exit;
    }
    // 3. Validasi Password Baru & Konfirmasi
    if($pass_baru !== $konfirmasi){
        echo "<script>alert('Gagal! Password Baru dan Konfirmasi tidak cocok.'); document.location='ganti-password.php';</script>";
        exit;
    }
    // 4. Update Password ke Database
    $queryUpdate = mysqli_query($koneksi, "UPDATE tbl_user SET password = '$pass_baru' WHERE username = '$user_id'");
    if($queryUpdate){
        echo "<script>alert('Berhasil! Password telah diganti. Silakan login ulang.'); document.location='../otentikasi/logout.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan sistem.'); document.location='ganti-password.php';</script>";
    }
}
require_once '../templates/header.php';
require_once '../templates/sidebar.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100 bg-light">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-4 border-bottom">
    <div>
        <h1 class="h2 fw-bold">Ganti Password</h1>
        <p class="text-muted">Perbarui keamanan akun Anda secara berkala.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">
          <form action="" method="post">
            <div class="mb-3">
              <label class="form-label fw-bold small">Password Lama</label>
              <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-lock"></i></span>
                <input type="password" name="pass_lama" class="form-control border-start-0" placeholder="Masukkan password saat ini" required>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold small">Password Baru</label>
              <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-key"></i></span>
                <input type="password" name="pass_baru" class="form-control border-start-0" placeholder="Masukkan password baru" required>
              </div>
            </div>
            <div class="mb-4">
              <label class="form-label fw-bold small">Konfirmasi Password Baru</label>
              <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-check-circle"></i></span>
                <input type="password" name="konfirmasi_pass" class="form-control border-start-0" placeholder="Ulangi password baru" required>
              </div>
            </div>
            <div class="d-grid">
              <button type="submit" name="simpan" class="btn btn-primary shadow-sm">
                <i class="bi bi-save me-1"></i> Simpan Perubahan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mt-4 mt-lg-0">
        <div class="alert alert-info border-0 shadow-sm rounded-3">
            <h5 class="fw-bold"><i class="bi bi-info-circle me-2"></i>Petunjuk Keamanan</h5>
            <ul class="mb-0 small">
                <li>Gunakan minimal 8 karakter.</li>
                <li>Gunakan kombinasi huruf dan angka.</li>
                <li>Jangan gunakan password yang mudah ditebak (misal: 123456).</li>
            </ul>
        </div>
    </div>
  </div>
</main>
<?php require_once '../templates/footer.php'; ?>