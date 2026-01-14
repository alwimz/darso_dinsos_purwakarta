<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once dirname(__FILE__) . '/../config.php';
if(!isset($_SESSION['ssLoginRM'])){
  header("location: {$main_url}otentikasi/index.php");
  exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? $title : 'App Asesmen'; ?></title>
    <link href="<?= $main_url ?>assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $main_url ?>assets/dashboard/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            color-scheme: light !important;
            var(--warna-utama): #2c599d;
            var(--warna-hover): #1e3d6b;
        }
        body {
            background-color: #f0f2f5 !important;
            color: #333 !important;
        }
        /* Header Navbar */
        .navbar.sticky-top {
            background-color: #2c599d !important; /* Hardcode warna sesuai request */
            border: none !important;
            height: 56px;
            z-index: 1050;
        }
        .navbar-brand {
            background-color: #2c599d !important;
            box-shadow: none !important;
            font-weight: 700;
            letter-spacing: 0.5px;
            font-size: 1.1rem !important;
        }
        /* Sidebar Styling Sesuai File Anda */
        #sidebarMenu {
            background-color: #ffffff !important;
            border-right: 1px solid #e3e6f0 !important;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1) !important;
            min-height: 100vh;
        }
        #sidebarMenu .nav-link {
            color: #4e4e4e !important;
            font-weight: 500;
            padding: 12px 20px;
            margin: 4px 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 8px;
            transition: all 0.2s ease-in-out;
            font-size: 0.9rem;
        }
        #sidebarMenu .nav-link.active {
            color: #ffffff !important;
            background-color: #2c599d !important;
            box-shadow: 0 4px 6px rgba(44, 89, 157, 0.2);
        }
        #sidebarMenu .nav-link i { font-size: 1.1rem; color: #858796; }
        #sidebarMenu .nav-link.active i { color: #ffffff !important; }
        #sidebarMenu .nav-link:hover:not(.active) { background-color: #f8f9fc; color: #2c599d !important; }
        .card { border: none !important; border-radius: 12px !important; box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.05) !important; }
        .table thead th { background-color: #f8f9fc; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; color: #4e4e4e !important; }
        @media (max-width: 767.98px) {
            #sidebarMenu { position: fixed; top: 56px; bottom: 0; left: 0; width: 250px; z-index: 1040; padding-top: 20px; transform: translateX(-100%); transition: transform 0.3s ease-in-out; }
            #sidebarMenu.show { transform: translateX(0); }
            /* TAMBAHAN: Agar Font Header pas di HP */
            .navbar-brand { font-size: 0.9rem !important; }
        }
    </style>
  </head>
  <body>
    <header class="navbar sticky-top flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-white" href="<?= $main_url ?>">
         <i class="bi bi-people-fill me-2"></i>
         <span class="d-none d-md-inline">DARSO - DATABASE ASESMEN REHABILITASI SOSIAL</span>
         <span class="d-inline d-md-none">DARSO MOBILE</span>
      </a>
      <ul class="navbar-nav flex-row d-md-none">
        <li class="nav-item text-nowrap">
          <button class="nav-link px-3 text-white border-0 bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list fs-2"></i>
          </button>
        </li>
      </ul>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <div class="container-fluid">
      <div class="row">