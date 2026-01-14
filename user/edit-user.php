<?php 
session_start();
if(!isset($_SESSION['ssLoginRM'])){ header('location: ../otentikasi/index.php'); exit(); }
require '../config.php';
$title = 'Edit User';
require '../templates/header.php';
require '../templates/sidebar.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Keamanan: Bersihkan ID dari karakter berbahaya
$id = mysqli_real_escape_string($koneksi, $id);

// Query data user berdasarkan id_user
$query = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE id_user = '$id'"); 

// Cek jika data ditemukan
if(mysqli_num_rows($query) < 1) {
    echo "<script>alert('Data tidak ditemukan'); window.location='index.php';</script>";
    exit;
}

$data = mysqli_fetch_assoc($query);

// Cek gambar, jika kosong pakai default
$foto = !empty($data['gambar']) ? $data['gambar'] : 'user.png';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100" style="background-color: #f8f9fc;">
  
  <div class="d-flex justify-content-between align-items-center pt-4 pb-3 mb-3">
    <h3 class="fw-bold text-dark mb-0">Edit User</h3>
    <a href="index.php" class="text-decoration-none text-secondary fw-bold">
      <i class="bi bi-arrow-left"></i> Kembali
    </a>
  </div>

  <form action="proses-user.php" method="POST" enctype="multipart/form-data">
    <div class="card border-0 shadow-sm rounded-0">
      <div class="card-body p-4">
        <div class="row">
          
          <div class="col-lg-3 text-center mb-4">
            <div class="mb-3">
              <img src="../assets/gambar/<?= $foto ?>" alt="Preview Foto" class="img-thumbnail rounded-circle shadow-sm tampil" style="width: 120px; height: 120px; object-fit: cover;">
            </div>
            
            <input type="hidden" name="gambarLama" value="<?= isset($data['gambar']) ? $data['gambar'] : '' ?>">
            
            <input type="hidden" name="id" value="<?= $id ?>">
            
            <label class="btn btn-outline-secondary btn-sm w-100 rounded-0">
                Ganti Foto
                <input type="file" name="gambar" id="gambar" class="d-none" onchange="imgView()">
            </label>
          </div>

          <div class="col-lg-9">
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label small fw-bold text-secondary">Username</label>
                <input type="text" name="username" class="form-control rounded-0" value="<?= isset($data['username']) ? $data['username'] : '' ?>" readonly style="background-color: #e9ecef;">
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                <input type="text" name="fullname" class="form-control rounded-0" value="<?= isset($data['fullname']) ? $data['fullname'] : '' ?>" required>
              </div>
            </div>

            <div class="mb-3">
  <label class="form-label small fw-bold text-secondary">Jabatan</label>
  <select name="jabatan" class="form-select rounded-0" required>
    <?php $jbt = isset($data['jabatan']) ? $data['jabatan'] : ''; ?>
    <option value="1" <?= $jbt == 1 ? 'selected' : '' ?>>Administrator</option>
    <option value="2" <?= $jbt == 2 ? 'selected' : '' ?>>Supervisor</option>
    <option value="3" <?= $jbt == 3 ? 'selected' : '' ?>>Petugas</option>
  </select>
</div>
            <div class="mb-4">
              <label class="form-label small fw-bold text-secondary">Alamat</label>
              <textarea name="alamat" class="form-control rounded-0" rows="3"><?= isset($data['alamat']) ? $data['alamat'] : '' ?></textarea>
            </div>

            <div class="d-flex justify-content-end">
               <button type="submit" name="edit" class="btn btn-primary btn-sm px-4 rounded-0 shadow-sm">
                Simpan Perubahan
               </button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </form>
</main>

<script>
  function imgView(){
    let gambar = document.getElementById('gambar');
    let tampil = document.querySelector('.tampil');
    if(gambar.files && gambar.files[0]){
        let fileReader = new FileReader();
        fileReader.readAsDataURL(gambar.files[0]);
        fileReader.addEventListener('load', (e) => {
          tampil.src = e.target.result;
        })
    }
  }
</script>

<?php require '../templates/footer.php'; ?>