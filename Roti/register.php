<?php 
include 'header.php';
?>

<div class="container" style="padding: 60px 15px 100px;">
	<div class="row justify-content-center">
		<div class="col-md-8 col-lg-6">
			<div class="thumbnail" style="padding: 40px; border: none; box-shadow: var(--shadow-medium);">
				<h2 class="section-title" style="margin-top: 0; margin-bottom: 30px; text-align: center;">Daftar Akun Baru</h2>
				<p class="text-center" style="color: var(--text-light); margin-bottom: 30px;">
					Bergabunglah dengan kami dan nikmati kemudahan berbelanja kue premium!
				</p>
				<form action="proses/register.php" method="POST">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="nama" style="font-weight: 600; color: var(--text-dark);">
									<i class="fa fa-user" style="margin-right: 8px; color: var(--accent-color);"></i>Nama Lengkap
								</label>
								<input type="text" class="form-control" id="nama" placeholder="Masukkan nama lengkap" name="nama" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="email" style="font-weight: 600; color: var(--text-dark);">
									<i class="fa fa-envelope" style="margin-right: 8px; color: var(--accent-color);"></i>Email
								</label>
								<input type="email" class="form-control" id="email" placeholder="contoh@email.com" name="email" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="username" style="font-weight: 600; color: var(--text-dark);">
									<i class="fa fa-at" style="margin-right: 8px; color: var(--accent-color);"></i>Username
								</label>
								<input type="text" class="form-control" id="username" placeholder="Pilih username" name="username" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="telp" style="font-weight: 600; color: var(--text-dark);">
									<i class="fa fa-phone" style="margin-right: 8px; color: var(--accent-color);"></i>Nomor Telepon
								</label>
								<input type="text" class="form-control" id="telp" placeholder="+62xxxxxxxxxx" name="telp" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="password" style="font-weight: 600; color: var(--text-dark);">
									<i class="fa fa-lock" style="margin-right: 8px; color: var(--accent-color);"></i>Password
								</label>
								<input type="password" class="form-control" id="password" placeholder="Minimal 6 karakter" name="password" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="konfirmasi" style="font-weight: 600; color: var(--text-dark);">
									<i class="fa fa-lock" style="margin-right: 8px; color: var(--accent-color);"></i>Konfirmasi Password
								</label>
								<input type="password" class="form-control" id="konfirmasi" placeholder="Ulangi password" name="konfirmasi" required>
							</div>
						</div>
					</div>

					<div class="text-center" style="margin-top: 30px;">
						<button type="submit" class="btn btn-success" style="padding: 15px 40px; font-size: 16px;">
							<i class="fa fa-user-plus"></i> Daftar Sekarang
						</button>
						<p style="margin-top: 20px; color: var(--text-light);">
							Sudah punya akun? <a href="user_login.php" style="color: var(--accent-color); font-weight: 600;">Masuk di sini</a>
						</p>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
include 'footer.php';
?>