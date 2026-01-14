<?php 
session_start();
if(!isset($_SESSION['ssLoginRM'])){
  header('location: ../otentikasi/index.php');
  exit();
}

require '../config.php';
$title = 'Ganti Password - SIKS PPKS';
require '../templates/header.php';
require '../templates/sidebar.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100" style="background-color: #f8f9fc;">
  <div class="pt-4 pb-2 mb-4 border-bottom">
    <h3 class="fw-bold text-dark mb-0">Pengaturan Keamanan</h3>
    <p class="text-muted small">Kelola password akun Anda untuk menjaga keamanan data.</p>
  </div>

  <div class="row">
    <div class="col-lg-8 col-xl-6">
      <div class="card border-0 shadow-sm rounded-0">
        <div class="card-header bg-white py-3 border-bottom">
          <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-shield-lock me-2"></i> Perbarui Password</h5>
        </div>
        <div class="card-body p-4">
          <form action="../user/proses-user.php" method="POST">
            
            <div class="row mb-3">
              <label class="col-sm-4 col-form-label fw-bold text-secondary">Password Saat Ini</label>
              <div class="col-sm-8">
                <input type="password" name="oldPass" class="form-control rounded-0" placeholder="Masukkan password lama" required>
              </div>
            </div>

            <hr class="text-muted opacity-25 my-4">

            <div class="row mb-3">
              <label class="col-sm-4 col-form-label fw-bold text-secondary">Password Baru</label>
              <div class="col-sm-8">
                <input type="password" name="newPass" class="form-control rounded-0" placeholder="Minimal 6 karakter" required>
              </div>
            </div>

            <div class="row mb-4">
              <label class="col-sm-4 col-form-label fw-bold text-secondary">Ulangi Password</label>
              <div class="col-sm-8">
                <input type="password" name="confPass" class="form-control rounded-0" placeholder="Konfirmasi password baru" required>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-8 offset-sm-4">
                <button type="submit" name="ganti-password" class="btn btn-primary px-4 rounded-0 shadow-sm">
                  <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                </button>
                <button type="reset" class="btn btn-light px-4 rounded-0 border ms-2">
                   Batal
                </button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card border-0 shadow-sm rounded-0 bg-primary text-white p-3">
          <div class="card-body">
              <h6 class="fw-bold"><i class="bi bi-info-circle me-2"></i> Tips Keamanan</h6>
              <ul class="small mt-3 ps-3">
                  <li class="mb-2">Jangan gunakan password yang sama dengan aplikasi lain.</li>
                  <li class="mb-2">Gunakan kombinasi huruf besar, kecil, angka, dan simbol.</li>
                  <li>Disarankan mengganti password secara berkala setiap 3-6 bulan.</li>
              </ul>
          </div>
      </div>
    </div>
  </div>
</main>

<?php require '../templates/footer.php'; ?>