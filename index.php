<?php 
session_start();
if(!isset($_SESSION['ssLoginRM'])){
  header('location: otentikasi/index.php');
  exit();
}
require 'config.php';
$title = 'Dashboard - App Asesmen';
require 'templates/header.php';
require 'templates/sidebar.php';

$fullname = isset($_SESSION['ssUserFullname']) ? $_SESSION['ssUserFullname'] : 'Pengguna';
$jabatan_kode = isset($_SESSION['ssUserJab']) ? $_SESSION['ssUserJab'] : '2';

$jmlPPKS = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT count(*) as jml FROM tbl_ppks"))['jml'];
$jmlLayanan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT count(*) as jml FROM tbl_layanan"))['jml'];
$jmlAsesmen = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT count(*) as jml FROM tbl_asesmen"))['jml'];

// --- PROSES AMBIL DATA RIIL UNTUK GRAFIK ---
$data_grafik = [];
for ($i = 1; $i <= 12; $i++) {
    // Menghitung record di tbl_asesmen berdasarkan bulan pada kolom tgl_asesmen
    $sql_chart = "SELECT count(*) as total FROM tbl_asesmen WHERE MONTH(tgl_asesmen) = '$i' AND YEAR(tgl_asesmen) = YEAR(CURDATE())";
    $query_chart = mysqli_query($koneksi, $sql_chart);
    $res = mysqli_fetch_assoc($query_chart);
    $data_grafik[] = (int)$res['total']; 
}
$json_data_grafik = json_encode($data_grafik);
?>

<style>
    .bg-gradient-primary { background: linear-gradient(45deg, #4e73df, #224abe); }
    .bg-gradient-success { background: linear-gradient(45deg, #1cc88a, #13855c); }
    .bg-gradient-warning { background: linear-gradient(45deg, #f6c23e, #dda20a); }
    .card-stat { transition: transform 0.2s; border: none; border-radius: 15px; overflow: hidden; }
    .card-stat:hover { transform: translateY(-5px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; }
    .card-icon { font-size: 3.5rem; opacity: 0.3; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100 bg-light">
  
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-2 mb-4 border-bottom">
    <div>
        <h1 class="h2 fw-bold">Dashboard</h1>
        <p class="text-muted">Halo <strong><?= $fullname ?></strong>, selamat datang kembali.</p>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-outline-primary shadow-sm">
         <i class="bi bi-calendar-event"></i> <?= date('d M Y') ?>
       </button>
    </div>
  </div>

  <div class="row g-4 mb-4">
      <div class="col-xl-4 col-md-6">
          <div class="card card-stat bg-gradient-primary text-white shadow h-100 py-2 position-relative">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col me-2">
                          <div class="text-uppercase fw-bold mb-1" style="font-size: 0.8rem; letter-spacing: 1px;">Data PPKS</div>
                          <div class="h1 mb-0 fw-bold"><?= $jmlPPKS ?></div>
                          <small>Jumlah Terdaftar</small>
                      </div>
                      <div class="col-auto"><i class="bi bi-people-fill card-icon text-white"></i></div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-4 col-md-6">
          <div class="card card-stat bg-gradient-success text-white shadow h-100 py-2 position-relative">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col me-2">
                          <div class="text-uppercase fw-bold mb-1" style="font-size: 0.8rem; letter-spacing: 1px;">Data Layanan</div>
                          <div class="h1 mb-0 fw-bold"><?= $jmlLayanan ?></div>
                          <small>Jenis Bantuan</small>
                      </div>
                      <div class="col-auto"><i class="bi bi-box-seam-fill card-icon text-white"></i></div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-4 col-md-6">
          <div class="card card-stat bg-gradient-warning text-white shadow h-100 py-2 position-relative">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col me-2">
                          <div class="text-uppercase fw-bold mb-1" style="font-size: 0.8rem; letter-spacing: 1px;">Total Asesmen</div>
                          <div class="h1 mb-0 fw-bold"><?= $jmlAsesmen ?></div>
                          <small>Laporan Masuk</small>
                      </div>
                      <div class="col-auto"><i class="bi bi-clipboard-data-fill card-icon text-white"></i></div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-12">
          <div class="card shadow mb-4 border-0" style="border-radius: 15px;">
              <div class="card-header py-3 bg-white border-bottom-0" style="border-radius: 15px 15px 0 0;">
                  <h6 class="m-0 fw-bold text-primary"><i class="bi bi-bar-chart-fill me-2"></i> Laporan Asesmen Bulanan (Tahun <?= date('Y') ?>)</h6>
              </div>
              <div class="card-body">
                  <div style="position: relative; height: 350px; width: 100%;">
                      <canvas id="chartBatang"></canvas>
                  </div>
              </div>
          </div>
      </div>
  </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('chartBatang').getContext('2d');
        const dataInput = <?= $json_data_grafik ?>; 

        new Chart(ctx, {
            type: 'bar', // GANTI KE GRAFIK BATANG
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Jumlah Asesmen Masuk',
                    data: dataInput,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)', // Warna Biru Cerah
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { 
                            stepSize: 1, // Angka bulat, tidak desimal
                            color: '#000'
                        }
                    },
                    x: {
                        ticks: { color: '#000' }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Sembunyikan legenda agar lebih bersih
                    }
                }
            }
        });
    });
</script>

<?php require 'templates/footer.php'; ?>