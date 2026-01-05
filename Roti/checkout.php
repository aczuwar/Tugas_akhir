<?php 
include 'header.php';
$kd = mysqli_real_escape_string($conn,$_GET['kode_cs']);
$cs = mysqli_query($conn, "SELECT * FROM customer WHERE kode_customer = '$kd'");
$rows = mysqli_fetch_assoc($cs);
?>

<div class="container" style="padding: 60px 15px 100px;">
    <h2 class="section-title">Checkout</h2>
    <p class="text-center" style="color: var(--text-light); margin-bottom: 40px;">
        Lengkapi data pengiriman untuk menyelesaikan pesanan Anda
    </p>
	<div class="row">
		<div class="col-md-6">
			<div class="thumbnail" style="padding: 25px; margin-bottom: 20px;">
				<h4 style="margin-top: 0; color: var(--text-dark); margin-bottom: 20px;">
					<i class="fa fa-shopping-cart" style="color: var(--accent-color); margin-right: 10px;"></i>
					Daftar Pesanan
				</h4>
				<table class="table table-striped" style="margin-bottom: 0;">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Harga</th>
							<th>Qty</th>
							<th>Sub Total</th>
						</tr>
					</thead>
				<?php 
				$result = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_customer = '$kd'");
				$no = 1;
				$hasil = 0;
				while($row = mysqli_fetch_assoc($result)){
					?>
					<tr>
						<td><?= $no; ?></td>
						<td><?= $row['nama_produk']; ?></td>
						<td>Rp.<?= number_format($row['harga']); ?></td>
						<td><?= $row['qty']; ?></td>
						<td>Rp.<?= number_format($row['harga'] * $row['qty']);  ?></td>
					</tr>
					<?php 
					$total = $row['harga'] * $row['qty'];
					$hasil += $total;
					$no++;
				}
				?>
					<tr>
						<td colspan="5" style="text-align: right; font-weight: bold; font-size: 16px; color: var(--accent-color);">
							Grand Total = Rp.<?= number_format($hasil); ?>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="col-md-6">
			<div class="thumbnail" style="padding: 25px;">
				<h4 style="margin-top: 0; color: var(--text-dark); margin-bottom: 20px;">
					<i class="fa fa-shipping-fast" style="color: var(--accent-color); margin-right: 10px;"></i>
					Data Pengiriman
				</h4>
				
				<div class="alert alert-success" style="border-radius: var(--border-radius); border: none; background: rgba(78, 205, 196, 0.1); color: var(--text-dark);">
					<i class="fa fa-check-circle"></i> Pastikan pesanan Anda sudah benar
				</div>
				
				<div class="alert alert-warning" style="border-radius: var(--border-radius); border: none; background: rgba(255, 217, 61, 0.1); color: var(--text-dark);">
					<i class="fa fa-info-circle"></i> Lengkapi form di bawah ini untuk pengiriman
				</div>
				
				<form action="proses/order.php" method="POST">
					<input type="hidden" name="kode_cs" value="<?= $kd; ?>">
					<div class="form-group">
						<label for="inputNama" style="font-weight: 600; color: var(--text-dark);">
							<i class="fa fa-user" style="margin-right: 8px; color: var(--accent-color);"></i>Nama
						</label>
						<input type="text" class="form-control" id="inputNama" placeholder="Nama" name="nama" value="<?= $rows['nama']; ?>" readonly style="background: #f8f9fa;">
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="inputProvinsi" style="font-weight: 600; color: var(--text-dark);">
									<i class="fa fa-map-marker-alt" style="margin-right: 8px; color: var(--accent-color);"></i>Provinsi
								</label>
								<input type="text" class="form-control" id="inputProvinsi" placeholder="Masukkan provinsi" name="prov" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="inputKota" style="font-weight: 600; color: var(--text-dark);">
									<i class="fa fa-city" style="margin-right: 8px; color: var(--accent-color);"></i>Kota
								</label>
								<input type="text" class="form-control" id="inputKota" placeholder="Masukkan kota" name="kota" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label for="inputAlamat" style="font-weight: 600; color: var(--text-dark);">
									<i class="fa fa-home" style="margin-right: 8px; color: var(--accent-color);"></i>Alamat Lengkap
								</label>
								<textarea class="form-control" id="inputAlamat" placeholder="Masukkan alamat lengkap" name="almt" rows="3" required></textarea>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="inputKodePos" style="font-weight: 600; color: var(--text-dark);">
									<i class="fa fa-mail-bulk" style="margin-right: 8px; color: var(--accent-color);"></i>Kode Pos
								</label>
								<input type="text" class="form-control" id="inputKodePos" placeholder="12345" name="kopos" required>
							</div>
						</div>
					</div>

					<div class="text-center" style="margin-top: 30px;">
						<button type="submit" class="btn btn-success" style="margin-right: 15px; padding: 15px 30px;">
							<i class="fa fa-credit-card"></i> Order Sekarang
						</button>
						<a href="keranjang.php" class="btn btn-danger" style="padding: 15px 30px;">
							<i class="fa fa-times"></i> Cancel
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<?php 
include 'footer.php';
?>