<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse border-end">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column gap-1">
      <li class="nav-item">
        <a class="nav-link <?= ($title == 'Dashboard - App Asesmen') ? 'active' : '' ?> d-flex align-items-center gap-2" href="<?= $main_url ?>index.php">
          <i class="bi bi-speedometer2"></i> Dashboard
        </a>
      </li>
      <?php if($_SESSION['ssUserJab'] == 1) { ?>
      <li class="nav-item">
        <a class="nav-link <?= ($title == 'User Management') ? 'active' : '' ?> d-flex align-items-center gap-2" href="<?= $main_url ?>user/index.php">
          <i class="bi bi-people-fill"></i> Kelola Users
        </a>
      </li>
      <?php } ?>
      <li class="nav-item">
        <a class="nav-link <?= ($title == 'Ganti Password') ? 'active' : '' ?> d-flex align-items-center gap-2" href="<?= $main_url ?>user/ganti-password.php">
          <i class="bi bi-shield-lock"></i> Ganti Password
        </a>
      </li>
      <li class="nav-item mt-3 mb-1">
        <small class="text-secondary px-3 fw-bold" style="font-size: 0.7rem;">DATA UTAMA</small>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= ($title == 'Data PPKS') ? 'active' : '' ?> d-flex align-items-center gap-2" href="<?= $main_url ?>pasien/index.php">
          <i class="bi bi-person-lines-fill"></i> Data PPKS
        </a>
      </li>
      <?php if($_SESSION['ssUserJab'] != 3) { ?>
      <li class="nav-item">
        <a class="nav-link <?= ($title == 'Data Pelayanan') ? 'active' : '' ?> d-flex align-items-center gap-2" href="<?= $main_url ?>obat/index.php">
          <i class="bi bi-box-seam"></i> Pelayanan
        </a>
      </li>
      <?php } ?>
      <li class="nav-item">
        <a class="nav-link <?= ($title == 'Data Asesmen') ? 'active' : '' ?> d-flex align-items-center gap-2" href="<?= $main_url ?>rekammedis/index.php">
          <i class="bi bi-clipboard2-check"></i> Data Asesmen
        </a>
      </li>
      <?php if($_SESSION['ssUserJab'] == 1) { ?>
      <li class="nav-item">
        <a class="nav-link <?= ($title == 'Bukti Asesmen' || $title == 'Input Bukti Asesmen') ? 'active' : '' ?> d-flex align-items-center gap-2" href="<?= $main_url ?>bukti-asesmen/index.php">
          <i class="bi bi-file-earmark-check"></i> Bukti Asesmen
        </a>
      </li>
      <?php } ?>
      <?php if($_SESSION['ssUserJab'] != 3) { ?>
      <li class="nav-item mt-3 mb-1">
        <small class="text-secondary px-3 fw-bold" style="font-size: 0.7rem;">PELAPORAN</small>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= ($title == 'Laporan SIKS PPKS') ? 'active' : '' ?> d-flex align-items-center gap-2" href="<?= $main_url ?>riwayat-perekaman/index.php">
          <i class="bi bi-file-earmark-bar-graph"></i> Laporan
        </a>
      </li>
      <?php } ?>
      <li class="nav-item mt-4 pt-2 border-top">
        <a class="nav-link text-danger fw-bold d-flex align-items-center gap-2" href="<?= $main_url ?>otentikasi/logout.php" onclick="return confirm('Yakin ingin keluar?')">
          <i class="bi bi-box-arrow-right"></i> Keluar Aplikasi
        </a>
      </li>
    </ul>
  </div>
</nav>