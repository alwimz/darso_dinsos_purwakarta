<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - DARSO Purwakarta</title>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
      body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }
      .login-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        overflow: hidden;
        background: white;
        /* Menambahkan max-width agar tidak terlalu lebar di layar monitor besar */
        max-width: 650px; 
        width: 100%;
      }
      .login-header {
        background: #0d6efd;
        color: white;
        padding: 40px 30px;
        text-align: center;
      }
      .logo-img {
        width: 220px; /* Logo diperbesar sedikit agar seimbang */
        height: auto;
        margin-bottom: 20px;
      }
      .brand-title {
        font-size: 1.4rem; /* Ukuran font judul DARSO diperbesar */
        line-height: 1.3;
        margin-bottom: 10px;
        letter-spacing: 1px;
      }
      .brand-subtitle {
        font-size: 0.9rem; /* Ukuran subtitle instansi diperbesar */
        line-height: 1.5;
        opacity: 0.9;
        font-weight: 400;
      }
      .form-control {
        border-radius: 10px;
        padding: 15px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
      }
      .btn-login {
        border-radius: 10px;
        padding: 15px;
        font-weight: 700;
        background: linear-gradient(to right, #0d6efd, #0056b3);
        border: none;
      }
    </style>
  </head>
  <body>
    
    <div class="container d-flex justify-content-center">
      <div class="card login-card">
        
        <div class="login-header">
          <img src="../assets/gambar/logodinsosp3a.jpg" alt="Logo Dinsosp3a" class="logo-img">
          
          <h4 class="brand-title fw-bold">DARSO - DATABASE ASESMEN REHABILITASI SOSIAL</h4>
          <div class="brand-subtitle px-md-4">
            DINAS SOSIAL PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK <br>
            <strong>KABUPATEN PURWAKARTA</strong>
          </div>
        </div>

        <div class="card-body p-4 p-md-5">
          <form action="proses-login.php" method="POST">
            <div class="row">
              <div class="col-md-6 mb-4">
                <label class="form-label text-secondary small text-uppercase fw-bold">Username</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                  <input type="text" class="form-control border-start-0 ps-0" name="username" placeholder="ID Petugas" required autofocus>
                </div>
              </div>

              <div class="col-md-6 mb-4">
                <label class="form-label text-secondary small text-uppercase fw-bold">Password</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="bi bi-key text-muted"></i></span>
                  <input type="password" class="form-control border-start-0 ps-0" name="password" placeholder="Kata Sandi" required>
                </div>
              </div>
            </div>

            <div class="d-grid gap-2 mb-4">
              <button class="btn btn-primary btn-login text-white shadow" type="submit" name="login">
                MASUK APLIKASI
              </button>
            </div>

            <div class="text-center pt-3 border-top">
              <small class="text-muted">
                &copy; 2025 DARSO Purwakarta | <strong>Dinas Sosial P3A</strong>
              </small>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>