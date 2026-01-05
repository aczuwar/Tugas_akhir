<?php 
session_start();
include 'koneksi/koneksi.php';
if(isset($_SESSION['kd_cs'])){

	$kode_cs = $_SESSION['kd_cs'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>BESTIE-CAKE BAKERY</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
	<script  src="js/jquery.js"></script>
	<script  src="js/bootstrap.min.js"></script>


    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
    :root{
        --primary-bg:#1a1a2e;
        --secondary-bg:#16213e;
        --accent-color:#ff6b6b;
        --accent-hover:#ff5252;
        --success-color:#4ecdc4;
        --warning-color:#ffd93d;
        --info-color:#6c5ce7;
        --text-dark:#2d3436;
        --text-light:#636e72;
        --border-radius:12px;
        --shadow-light:0 4px 20px rgba(0,0,0,0.08);
        --shadow-medium:0 8px 30px rgba(0,0,0,0.12);
        --shadow-heavy:0 15px 35px rgba(0,0,0,0.1);
        --transition:all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    
    body{ 
        background: linear-gradient(135deg,rgb(236, 236, 236) 0%,rgb(255, 255, 255) 100%);
        background-attachment: fixed;
        color: var(--text-dark); 
        font-family: "Inter", "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 0;
    }
    
    .main-content {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        min-height: 100vh;
        border-radius: 20px 20px 0 0;
        margin-top: 20px;
        box-shadow: var(--shadow-heavy);
    }
    
    /* Top Bar */
    .top{ 
        background: linear-gradient(135deg, var(--primary-bg), var(--secondary-bg));
        color: #ffffff;
        padding: 8px 0;
        font-size: 13px;
        font-weight: 500;
    }
    .top i{ color: var(--accent-color); margin-right: 5px; }
    .top span{ margin: 0 15px; }

    /* Navbar */
    .navbar{ 
        background: rgba(255, 255, 255, 0.98) !important;
        backdrop-filter: blur(20px);
        border: none;
        box-shadow: var(--shadow-light);
        padding: 15px 0;
        transition: var(--transition);
    }
    .navbar-brand{ 
        color: var(--primary-bg) !important; 
        font-weight: 700;
        font-size: 24px;
        letter-spacing: 1px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }
    .navbar-default .navbar-nav>li>a{ 
        color: var(--text-dark);
        font-weight: 500;
        padding: 15px 20px !important;
        border-radius: var(--border-radius);
        margin: 0 5px;
        transition: var(--transition);
    }
    .navbar-default .navbar-nav>li>a:hover{ 
        color: var(--accent-color);
        background: rgba(255, 107, 107, 0.1);
        transform: translateY(-2px);
    }

    /* Headings */
    .section-title{ 
        background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
        font-size: 2.5rem;
        margin: 60px 0 30px 0;
        text-align: center;
        position: relative;
    }
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
        border-radius: 2px;
    }

    /* Buttons */
    .btn{ 
        border-radius: var(--border-radius);
        border: none;
        font-weight: 600;
        padding: 12px 24px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }
    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    .btn:hover::before {
        left: 100%;
    }
    .btn-success{ 
        background: linear-gradient(135deg, var(--success-color), #00b894);
        box-shadow: 0 4px 15px rgba(78, 205, 196, 0.3);
    }
    .btn-success:hover{ 
        background: linear-gradient(135deg, #00b894, var(--success-color));
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(78, 205, 196, 0.4);
    }
    .btn-warning{ 
        background: linear-gradient(135deg, var(--warning-color), #fdcb6e);
        color: var(--text-dark);
        box-shadow: 0 4px 15px rgba(255, 217, 61, 0.3);
    }
    .btn-warning:hover{ 
        background: linear-gradient(135deg, #fdcb6e, var(--warning-color));
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 217, 61, 0.4);
    }
    .btn-danger{ 
        background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
    }
    .btn-danger:hover{ 
        background: linear-gradient(135deg, var(--accent-hover), var(--accent-color));
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4);
    }

    /* Cards */
    .thumbnail{ 
        border: none;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow-light);
        transition: var(--transition);
        background: #ffffff;
    }
    .thumbnail:hover{ 
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--shadow-heavy);
    }
    .thumbnail img {
        transition: var(--transition);
    }
    .thumbnail:hover img {
        transform: scale(1.1);
    }

    /* Tables */
    .table{
        background: #ffffff;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow-light);
    }
    .table>thead>tr>th{ 
        background: linear-gradient(135deg, var(--primary-bg), var(--secondary-bg));
        color: #ffffff;
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .table>tbody>tr>td{ 
        vertical-align: middle;
        border-color: #f8f9fa;
    }
    .table>tbody>tr:hover {
        background: rgba(255, 107, 107, 0.05);
    }

    /* Forms */
    .form-control{ 
        border-radius: var(--border-radius);
        border: 2px solid #e9ecef;
        box-shadow: none;
        padding: 12px 16px;
        transition: var(--transition);
        background: rgba(255, 255, 255, 0.9);
    }
    .form-control:focus{ 
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
        background: #ffffff;
    }

    /* Footer */
    footer{ 
        background: linear-gradient(135deg, var(--primary-bg), var(--secondary-bg));
        color: #ffffff;
        margin-top: 60px;
    }
    footer a{ 
        color: #ffffff;
        transition: var(--transition);
    }
    footer a:hover {
        color: var(--accent-color);
        text-decoration: none;
    }
    footer .copy{ 
        background: rgba(0,0,0,0.2) !important;
        padding: 20px 0;
    }

    /* Jumbotron */
    .jumbotron {
        background: linear-gradient(135deg, rgba(26,26,46,0.9), rgba(22,33,62,0.8)), url('image/home/2.jpg') center/cover no-repeat;
        border-radius: 0;
        margin-bottom: 0;
        padding: 80px 0;
        color: #ffffff;
        text-align: center;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .fade-in-up {
        animation: fadeInUp 0.8s ease-out;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .section-title {
            font-size: 2rem;
        }
        .main-content {
            margin-top: 10px;
            border-radius: 10px 10px 0 0;
        }
    }
    </style>

</head>
<body>
	<div class="container-fluid">
		<div class="row top">
			<div class="container">
				<div class="col-md-4 text-center">
					<span><i class="fa fa-phone"></i> +6287804616097</span>
				</div>
				<div class="col-md-4 text-center">
					<span><i class="fa fa-envelope"></i> bestie-cake@gmail.com</span>
				</div>
				<div class="col-md-4 text-center">
					<span><i class="fa fa-star"></i> BESTIE-CAKE BAKERY</span>
				</div>
			</div>
		</div>
	</div>

	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">
					<i class="fa fa-birthday-cake" style="color: var(--accent-color); margin-right: 8px;"></i>
					BESTIE-CAKE BAKERY
				</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="produk.php"><i class="fa fa-shopping-bag"></i> Produk</a></li>
					<li><a href="about.php"><i class="fa fa-info-circle"></i> Tentang Kami</a></li>
					<li><a href="manual.php"><i class="fa fa-book"></i> Manual</a></li>
					<?php 
					if(isset($_SESSION['kd_cs'])){
					$kode_cs = $_SESSION['kd_cs'];
					$cek = mysqli_query($conn, "SELECT kode_produk from keranjang where kode_customer = '$kode_cs' ");
					$value = mysqli_num_rows($cek);
						?>
						<li>
							<a href="keranjang.php" style="background: var(--accent-color); color: white; border-radius: 20px; padding: 8px 15px !important;">
								<i class="fa fa-shopping-cart"></i> 
								<span class="badge" style="background: white; color: var(--accent-color);"><?= $value ?></span>
							</a>
						</li>
						<?php 
					}else{
						?>
						<li>
							<a href="keranjang.php" style="background: var(--accent-color); color: white; border-radius: 20px; padding: 8px 15px !important;">
								<i class="fa fa-shopping-cart"></i> 
								<span class="badge" style="background: white; color: var(--accent-color);">0</span>
							</a>
						</li>
						<?php 
					}
					if(!isset($_SESSION['user'])){
						?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-user"></i> Akun <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="user_login.php"><i class="fa fa-sign-in"></i> Login</a></li>
								<li><a href="register.php"><i class="fa fa-user-plus"></i> Register</a></li>
							</ul>
						</li>
						<?php 
					}else{
						?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-user-circle"></i> <?= $_SESSION['user']; ?> <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="proses/logout.php"><i class="fa fa-sign-out"></i> Log Out</a></li>
							</ul>
						</li>
						<?php 
					}
					?>
				</ul>
			</div>
		</div>
	</nav>
	
	<div class="main-content fade-in-up">