<?php 
include 'header.php';
if(isset($_POST['submit1'])){
	$id_keranjang = $_POST['id'];
	$qty = $_POST['qty'];

	$edit = mysqli_query($conn, "UPDATE keranjang SET qty = '$qty' where id_keranjang = '$id_keranjang'");
	if($edit){
			echo "
		<script>
		alert('KERANJANG BERHASIL DIPERBARUI');
		window.location = 'keranjang.php';
		</script>
		";
	}
}else if(isset($_GET['del'])){
	$id_keranjang = $_GET['id'];
	$del = mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang'");
	if($del){
		echo "
		<script>
		alert('1 PRODUK DIHAPUS');
		window.location = 'keranjang.php';
		</script>
		";
	}
}

?>


<div class="container" style="padding: 60px 15px 100px;">
	<h2 class="section-title">Keranjang Belanja</h2>
	<p class="text-center" style="color: var(--text-light); margin-bottom: 40px;">
		Kelola produk yang ingin Anda beli
	</p>
	
	<div class="thumbnail" style="padding: 30px; border: none; box-shadow: var(--shadow-medium);">
		<table class="table table-striped">
			<?php 
			if(isset($_SESSION['user'])){
				$kode_cs = $_SESSION['kd_cs'];
			// CEK JUMLAH KERANJANG
				$cek = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_customer = '$kode_cs'");
				$jml = mysqli_num_rows($cek);

				if($jml > 0){
					?>	
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Image</th>
							<th scope="col">Nama</th>
							<th scope="col">Harga</th>
							<th scope="col">Qty</th>
							<th scope="col">SubTotal</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<?php 
					if(isset($_SESSION['kd_cs'])){
						$kode_cs = $_SESSION['kd_cs'];

						$result = mysqli_query($conn, "SELECT k.id_keranjang as keranjang, k.kode_produk as kd, k.nama_produk as nama, k.qty as jml, p.image as gambar, p.harga as hrg FROM keranjang k join produk p on k.kode_produk=p.kode_produk WHERE kode_customer = '$kode_cs'");
						$no = 1;
						$hasil = 0;
						while($row = mysqli_fetch_assoc($result)){
				
					?>
					<tbody>
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
						<input type="hidden" name="id" value="<?php echo $row['keranjang']; ?>">
						<tr>
							<th scope="row"><?= $no;  ?></th>
							<td><img src="image/produk/<?= $row['gambar']; ?>" width="100"></td>
							<td><?= $row['nama']; ?></td>
							<td>Rp.<?= number_format($row['hrg']);  ?></td>
							<td><input type="number" name="qty" class="form-control" style="text-align: center;" value="<?= $row['jml']; ?>"></td>
							<td>Rp.<?= number_format($row['hrg'] * $row['jml']);  ?></td>
							<td><button type="submit" name="submit1" class="btn btn-warning">Update</button> | <a href="keranjang.php?del=1&id=<?= $row['keranjang']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin dihapus ?')">Delete</a></td>
						</tr>
						</form>
					<?php 
							$sub = $row['hrg'] * $row['jml'];
							$hasil += $sub;
							$no++;
						}
					}
					 ?>
					 
						<tr style="background: rgba(255, 107, 107, 0.05);">
							<td colspan="6" style="text-align: right; font-weight: bold; font-size: 16px; color: var(--text-dark);">
								Total Belanja:
							</td>
							<td style="font-weight: bold; font-size: 18px; color: var(--accent-color);">
								Rp.<?= number_format($hasil); ?>
							</td>
						</tr>
						<tr>
							<td colspan="7" style="text-align: center; padding: 30px 0;">
								<a href="index.php" class="btn btn-warning" style="margin-right: 15px; padding: 15px 30px;">
									<i class="fa fa-arrow-left"></i> Lanjutkan Belanja
								</a>
								<a href="checkout.php?kode_cs=<?= $kode_cs; ?>" class="btn btn-success" style="padding: 15px 30px;">
									<i class="fa fa-credit-card"></i> Checkout
								</a>
							</td>
						</tr>
						<?php 
					}else{
						?>
						<tr>
							<td colspan="7" class="text-center" style="padding: 60px 0;">
								<div style="color: var(--text-light);">
									<i class="fa fa-shopping-cart" style="font-size: 48px; color: var(--accent-color); margin-bottom: 20px;"></i>
									<h4 style="color: var(--text-dark); margin-bottom: 15px;">Keranjang Belanja Kosong</h4>
									<p style="margin-bottom: 25px;">Belum ada produk yang ditambahkan ke keranjang</p>
									<a href="index.php" class="btn btn-success" style="padding: 15px 30px;">
										<i class="fa fa-shopping-bag"></i> Mulai Belanja
									</a>
								</div>
							</td>
						</tr>
						<?php
					}

				}else{
					?>
					<tr>
						<td colspan="7" class="text-center" style="padding: 60px 0;">
							<div style="color: var(--text-light);">
								<i class="fa fa-user-lock" style="font-size: 48px; color: var(--accent-color); margin-bottom: 20px;"></i>
								<h4 style="color: var(--text-dark); margin-bottom: 15px;">Login Diperlukan</h4>
								<p style="margin-bottom: 25px;">Silahkan login terlebih dahulu sebelum berbelanja</p>
								<a href="user_login.php" class="btn btn-success" style="margin-right: 15px; padding: 15px 30px;">
									<i class="fa fa-sign-in"></i> Login
								</a>
								<a href="register.php" class="btn btn-warning" style="padding: 15px 30px;">
									<i class="fa fa-user-plus"></i> Daftar
								</a>
							</div>
						</td>
					</tr>
					<?php
				}
				?>


			</tbody>
		</table>
	</div>
</div>




<?php 
include 'footer.php';
?>