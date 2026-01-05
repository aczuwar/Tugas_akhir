<?php 
include 'header.php';
?>
<?php 
function render_stars_card($value){
    $full = floor($value);
    $half = ($value - $full) >= 0.5 ? 1 : 0;
    $empty = 5 - $full - $half;
    $out = '';
    for($i=0;$i<$full;$i++){ $out .= '<i class="glyphicon glyphicon-star" style="color:#f5b301"></i> '; }
    if($half){ $out .= '<i class="glyphicon glyphicon-star" style="color:#f5b301; opacity:.6"></i> '; }
    for($i=0;$i<$empty;$i++){ $out .= '<i class="glyphicon glyphicon-star-empty" style="color:#f5b301"></i> '; }
    return $out;
}
?>
<!-- HERO Section -->
<div class="jumbotron">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8 col-md-offset-2 text-center">
                <h1 style="margin-bottom: 20px; font-weight: 700; letter-spacing: 1px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                    <i class="fa fa-birthday-cake" style="margin-right: 15px; color: var(--accent-color);"></i>
                    Bestie Cake & Bakery
                </h1>
                <p style="font-size: 18px; line-height: 1.8; margin-bottom: 30px; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                    Rasakan kelezatan kue berkualitas premium dengan cita rasa yang tak terlupakan. 
                    Kami menyediakan berbagai macam kue lezat dan bergizi untuk setiap momen istimewa Anda.
                </p>
                <div style="margin-top: 30px;">
                    <a href="produk.php" class="btn btn-success" style="margin-right: 15px; padding: 15px 30px; font-size: 16px;">
                        <i class="fa fa-shopping-bag"></i> Lihat Produk
                    </a>
                    <a href="about.php" class="btn btn-warning" style="padding: 15px 30px; font-size: 16px;">
                        <i class="fa fa-info-circle"></i> Tentang Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PRODUK SECTION -->
<div class="container" style="padding: 60px 15px;">
    <h2 class="section-title">Produk Kami</h2>
    <p class="text-center" style="font-size: 16px; color: var(--text-light); margin-bottom: 50px; max-width: 600px; margin-left: auto; margin-right: auto;">
        Nikmati koleksi kue premium kami yang dibuat dengan bahan-bahan berkualitas tinggi dan resep rahasia yang telah teruji selama puluhan tahun.
    </p>

	<div class="row">
		<?php 
		$result = mysqli_query($conn, "SELECT * FROM produk");
		while ($row = mysqli_fetch_assoc($result)) {
			?>
            <div class="col-sm-6 col-md-4" style="margin-bottom: 30px;">
				<div class="thumbnail" style="border: none; box-shadow: var(--shadow-light); transition: var(--transition);">
                    <div style="position: relative; overflow: hidden;">
                        <img src="image/produk/<?= $row['image']; ?>" loading="lazy" style="width:100%; height:280px; object-fit:cover; transition: var(--transition);">
                        <div style="position: absolute; top: 15px; right: 15px; background: var(--accent-color); color: white; padding: 5px 10px; border-radius: 15px; font-size: 12px; font-weight: 600;">
                            NEW
                        </div>
                    </div>
					<div class="caption" style="padding: 25px;">
						<h3 style="margin-bottom: 10px; font-weight: 600; color: var(--text-dark);"><?= $row['nama'];  ?></h3>
                        <h4 style="color: var(--accent-color); font-weight: 700; margin-bottom: 15px;">Rp.<?= number_format($row['harga']); ?></h4>
                        <?php 
                        $kp = mysqli_real_escape_string($conn, $row['kode_produk']);
                        $qrev = mysqli_query($conn, "SELECT AVG(rating) as avg_rating, COUNT(*) as total FROM review WHERE kode_produk = '$kp'");
                        $rrev = mysqli_fetch_assoc($qrev);
                        $avg = ($rrev && $rrev['avg_rating']) ? round($rrev['avg_rating'],1) : 0;
                        $tot = ($rrev && $rrev['total']) ? (int)$rrev['total'] : 0;
                        ?>
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom: 20px;">
                            <div style="display: flex; align-items: center; gap: 2px;">
                                <?= render_stars_card($avg); ?>
                            </div>
                            <span style="font-weight:600; font-size:14px; color:var(--text-dark);"><?= $avg; ?>/5</span>
                            <span style="font-size:13px; color:var(--text-light);">(<?= $tot; ?> ulasan)</span>
                        </div>
                        
                        
                        <?php /* modal removed; redirect to detail page reviews instead */ ?>
                        <div class="row product-actions" style="margin: 0;">
								<div class="col-md-6" style="padding: 0 5px;">
									<a href="detail_produk.php?produk=<?= $row['kode_produk']; ?>" class="btn btn-warning btn-block">
										<i class="fa fa-eye"></i> Detail
									</a> 
								</div>
							<?php if(isset($_SESSION['kd_cs'])){ ?>
										<div class="col-md-6" style="padding: 0 5px;">
											<a href="proses/add.php?produk=<?= $row['kode_produk']; ?>&kd_cs=<?= $kode_cs; ?>&hal=1" class="btn btn-success btn-block" role="button">
												<i class="fa fa-shopping-cart"></i> Tambah
											</a>
										</div>
								<?php 
							}
							else{
								?>
										<div class="col-md-6" style="padding: 0 5px;">
											<a href="keranjang.php" class="btn btn-success btn-block" role="button">
												<i class="fa fa-shopping-cart"></i> Tambah
											</a>
										</div>

								<?php 
							}
							?>

						</div>

					</div>
				</div>
			</div>
			<?php 
		}
		?>
	</div>

</div>
<br>
<br>
<br>
<br>
<?php 
include 'footer.php';
?>