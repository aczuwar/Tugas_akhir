<?php 
session_start();
include '../koneksi/koneksi.php';
if(!isset($_SESSION['admin'])){
	header('location:index.php');
}
$current = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Bestie Bakery</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">
	<script  src="../js/jquery.js"></script>
	<script  src="../js/bootstrap.min.js"></script>


    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
    :root{
        --admin-bg:#0d1b2a;
        --admin-surface:#ffffff;
        --admin-accent:#2fbf71;
        --admin-accent-2:#1b263b;
        --admin-muted:#6c7a89;
        --admin-radius:12px;
        --admin-shadow:0 8px 24px rgba(0,0,0,0.08);
    }
    html, body{ height:100%; }
    body{ margin:0; background:#f5f7fb; color:#223; font-family:"Inter","Segoe UI", Tahoma, Geneva, Verdana, sans-serif; display:flex; flex-direction:column; }
    .navbar{ border:none; border-radius:0; box-shadow: var(--admin-shadow); background:#fff; }
    .navbar-default .navbar-nav>li>a{ color:#0d1b2a; }
    .navbar-default .navbar-nav>li>a:hover{ color: var(--admin-accent); }
    .navbar .dropdown-menu{ border-radius:10px; box-shadow: var(--admin-shadow); }
    .btn{ border-radius:10px; border:none; }
    .btn-success{ background: var(--admin-accent); }
    .btn-success:hover{ background:#27a463; }
    .btn-warning{ background:#1b95e0; }
    .btn-warning:hover{ background:#167dc0; }
    .btn-danger{ background:#ef5350; }
    .panel, .thumbnail, .well{ border:none; border-radius: var(--admin-radius); box-shadow: var(--admin-shadow); }
    .table>thead>tr>th{ background:#f1f5f9; color:#334; border-bottom:1px solid #e5eaf0; }
    .table>tbody>tr>td{ vertical-align: middle; }
    .form-control{ border-radius:10px; border:1px solid #e2e8f0; box-shadow:none; }
    .form-control:focus{ border-color: var(--admin-accent); box-shadow: 0 0 0 2px rgba(47,191,113,.15); }
    .admin-header{ background: linear-gradient(180deg, rgba(13,27,42,.80), rgba(27,38,59,.65)); color:#fff; padding:16px 0; margin-bottom:16px; }
    footer{ margin-top:auto; }
    .page-container{ padding: 16px 0 24px; }
    .sidebar .nav>li>a{ color:#fff; border-radius:8px; margin:4px 10px; padding:10px 12px; display:flex; align-items:center; gap:10px; }
    .sidebar .nav>li>a:hover{ background: linear-gradient(90deg, rgba(32,78,141,.35), rgba(187,133,255,.25)); text-decoration:none; box-shadow: inset 0 0 0 1px rgba(255,255,255,.06); }
    .sidebar .dropdown-menu>li>a{ padding:8px 14px; }
    .sidebar .nav>li.active>a{ background: linear-gradient(90deg, rgba(47,191,113,.35), rgba(27,38,59,.35)); font-weight:600; }
    .btn, .nav a, .dropdown-menu a, .form-control{ transition: all .2s ease; }
    .sidebar-header{ padding:18px; color:#fff; font-weight:700; letter-spacing:.4px; border-bottom:1px solid rgba(255,255,255,.08); display:flex; align-items:center; gap:10px; }
    .sidebar-header .logo-circle{ width:34px; height:34px; border-radius:50%; background: radial-gradient(circle at 30% 30%, #7aa2ff, #a48bff); display:inline-block; }
    .topbar{ background:#fff; box-shadow: var(--admin-shadow); padding:10px 16px; display:flex; align-items:center; justify-content:space-between; margin-bottom:14px; border-radius:10px; }
    .topbar .search{ max-width: 320px; width: 100%; }
    .topbar .icons{ display:flex; align-items:center; gap:14px; color:#445; }
    </style>

</head>
<body>

	<div class="container-fluid" style="padding:0;">
		<div class="row" style="margin:0;">
            <aside class="sidebar col-sm-3 col-md-2" style="padding:0; background: linear-gradient(180deg, #0e1f3a, #2a2f4f); min-height:100vh; position:fixed; top:0; bottom:0; left:0;">
                <div class="sidebar-header"><span class="logo-circle"></span><span>Admin Panel CustomerApp</span></div>
                <ul class="nav nav-pills nav-stacked" style="padding:12px 6px;">
                    <li class="<?php echo $current==='halaman_utama.php' ? 'active' : '';?>"><a href="halaman_utama.php" style="color:#fff;"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a></li>
					<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;"><i class="fa-solid fa-database"></i><span>Data Master</span> <span class="caret"></span></a>
						<ul class="dropdown-menu" style="background:#1b263b;">
                            <li class="<?php echo $current==='m_produk.php' ? 'active' : '';?>"><a href="m_produk.php" style="color:#fff;"><i class="fa-solid fa-bread-slice"></i> Master Produk</a></li>
                            <li class="<?php echo $current==='m_customer.php' ? 'active' : '';?>"><a href="m_customer.php" style="color:#fff;"><i class="fa-solid fa-users"></i> Master Customer</a></li>
						</ul>
					</li>
					<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;"><i class="fa-solid fa-repeat"></i><span>Data Transaksi</span> <span class="caret"></span></a>
						<ul class="dropdown-menu" style="background:#1b263b;">
                            <li class="<?php echo $current==='produksi.php' ? 'active' : '';?>"><a href="produksi.php" style="color:#fff;"><i class="fa-solid fa-industry"></i> Produksi</a></li>
                            <li class="<?php echo $current==='inventory.php' ? 'active' : '';?>"><a href="inventory.php" style="color:#fff;"><i class="fa-solid fa-boxes-stacked"></i> Inventory</a></li>
						</ul>
					</li>
					<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;"><i class="fa-solid fa-chart-column"></i><span>Laporan</span> <span class="caret"></span></a>
						<ul class="dropdown-menu" style="background:#1b263b;">
                            <li class="<?php echo $current==='laporan_penjualan.php' ? 'active' : '';?>"><a href="laporan_penjualan.php" style="color:#fff;"><i class="fa-solid fa-receipt"></i> Laporan Penjualan</a></li>
                            <li class="<?php echo $current==='laporan_profit.php' ? 'active' : '';?>"><a href="laporan_profit.php" style="color:#fff;"><i class="fa-solid fa-sack-dollar"></i> Laporan Profit</a></li>
                            <li class="<?php echo $current==='laporan_omset.php' ? 'active' : '';?>"><a href="laporan_omset.php" style="color:#fff;"><i class="fa-solid fa-chart-line"></i> Laporan Omset</a></li>
                            <li class="<?php echo $current==='laporan_pembatalan.php' ? 'active' : '';?>"><a href="laporan_pembatalan.php" style="color:#fff;"><i class="fa-solid fa-ban"></i> Laporan Pembatalan</a></li>
                            <li class="<?php echo $current==='laporan_inventory.php' ? 'active' : '';?>"><a href="laporan_inventory.php" style="color:#fff;"><i class="fa-solid fa-clipboard-list"></i> Laporan Inventory</a></li>
                            <li class="<?php echo $current==='laporan_produksi.php' ? 'active' : '';?>"><a href="laporan_produksi.php" style="color:#fff;"><i class="fa-solid fa-gears"></i> Laporan Produksi</a></li>
						</ul>
					</li>
					<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;"><i class="fa-solid fa-screwdriver-wrench"></i><span>Pemeliharaan</span> <span class="caret"></span></a>
						<ul class="dropdown-menu" style="background:#1b263b;">
                            <li><a href="../DATABASE/backup.php" style="color:#fff;"><i class="fa-solid fa-database"></i> Backup Database</a></li>
                            <li><a href="../DATABASE/retrieve.php" style="color:#fff;"><i class="fa-solid fa-file-arrow-down"></i> Retrieve Database</a></li>
						</ul>
					</li>
					<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;"><i class="fa-solid fa-user-shield"></i><span>Admin</span> <span class="caret"></span></a>
						<ul class="dropdown-menu" style="background:#1b263b;">
                            <li><a href="proses/logout.php" style="color:#fff;"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
						</ul>
					</li>
				</ul>
			</aside>
            <section class="col-sm-9 col-md-10 col-sm-offset-3 col-md-offset-2 page-container">
                <div class="topbar">
                    <h3 style="margin:0; font-weight:700; letter-spacing:.3px;">📊 Dashboard Utama</h3>
                    <div class="icons">
                        <form class="search" method="GET" action="#" onsubmit="return false;">
                            <input type="text" class="form-control" placeholder="Cari...">
                        </form>
                        <i class="fa-regular fa-bell"></i>
                        <i class="fa-solid fa-user-circle"></i>
                    </div>
                </div>
