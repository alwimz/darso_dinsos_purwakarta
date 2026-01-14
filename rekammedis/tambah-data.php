<?php 
session_start();
if(!isset($_SESSION['ssLoginRM'])) header('location: ../otentikasi/index.php');
require '../config.php';
$title = 'Input Asesmen - Database Asesmen';
require '../templates/header.php';
require '../templates/sidebar.php';

// Auto Number: DA-001
$q = mysqli_query($koneksi, "SELECT max(no_asesmen) as kode FROM tbl_asesmen");
$data = mysqli_fetch_array($q);
$kode = $data['kode'];
$urutan = (int) substr($kode, 3, 3);
$urutan++;
$no_asesmen = "DA-" . sprintf("%03s", $urutan);
?>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Input Data Asesmen</h1>
  </div>

  <form action="proses-data.php" method="POST">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">Data PPKS (Klien)</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Cari NIK</label>
                        <div class="input-group">
                            <input type="text" id="cari_nik" class="form-control" placeholder="Masukkan NIK">
                            <button class="btn btn-secondary" type="button" id="btnCari">Cari</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIK (Otomatis)</label>
                        <input type="text" name="nik" id="hasil_nik" class="form-control" readonly required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama PPKS</label>
                        <input type="text" id="hasil_nama" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis PPKS</label>
                        <input type="text" id="hasil_jenis" class="form-control" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">Detail Asesmen</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">No. Asesmen</label>
                        <input type="text" name="no_asesmen" value="<?= $no_asesmen ?>" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Asesmen</label>
                        <input type="date" name="tgl" value="<?= date('Y-m-d') ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Petugas Asesmen</label>
                        <select name="petugas" class="form-select" required>
                            <option value="">-- Pilih Petugas --</option>
                            <?php 
                            $qu = mysqli_query($koneksi, "SELECT fullname FROM tbl_user WHERE jabatan = 3");
                            while($du = mysqli_fetch_array($qu)){
                                echo "<option value='".$du['fullname']."'>".$du['fullname']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kondisi PPKS</label>
                        <textarea name="kondisi" class="form-control" rows="3" placeholder="Jelaskan kondisi fisik, mental, ekonomi dan keluarga. Jika ada tuliskan Desil DTSEN PPKS" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Layanan yang Diberikan (Pisahkan dengan koma)</label>
                        <input type="text" name="layanan" class="form-control" id="tokenfield" placeholder="Ketik layanan lalu tekan koma atau enter" required />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" name="simpan" class="btn btn-primary w-100"><i class="bi bi-save"></i> Simpan Data Asesmen</button>
  </form>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

<script>
    // Fitur Cari NIK
    document.getElementById('btnCari').addEventListener('click', function(){
        let nik = document.getElementById('cari_nik').value;
        if(!nik) { alert('Isi NIK dulu!'); return; }
        fetch('get_ppks.php?nik=' + nik)
        .then(response => response.json())
        .then(data => {
            if(data.status == 'ok'){
                document.getElementById('hasil_nik').value = data.data.nik;
                document.getElementById('hasil_nama').value = data.data.nama_ppks;
                document.getElementById('hasil_jenis').value = data.data.jenis_ppks;
            } else {
                alert('Data PPKS tidak ditemukan!');
            }
        });
    });

    // Fitur Tokenfield (Tagging seperti Foto Klien)
    $(document).ready(function(){
        <?php
        $ql = mysqli_query($koneksi, "SELECT jenis_layanan FROM tbl_layanan");
        $nmLayanan = [];
        while($dl = mysqli_fetch_array($ql)){ $nmLayanan[] = $dl['jenis_layanan']; }
        ?>
        
        $('#tokenfield').tokenfield({
            autocomplete: {
                source: [<?= '"' . implode('", "', $nmLayanan) . '"' ?>],
                delay: 100
            },
            showAutocompleteOnFocus: true
        });
    });
</script>

<?php require '../templates/footer.php'; ?>