<?php 
include 'header.php';
$kode = mysqli_real_escape_string($conn,$_GET['produk']);
$result = mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk = '$kode'");
$row = mysqli_fetch_assoc($result);

?>
<div class="container" style="padding: 60px 15px 100px;">
    <h2 class="section-title">Detail Produk</h2>

	<div class="row">
		<div class="col-md-5">
            <div class="thumbnail" style="border: none; box-shadow: var(--shadow-medium); overflow: hidden;">
                <img src="image/produk/<?= $row['image']; ?>" style="width:100%; height: 400px; object-fit: cover; transition: var(--transition);">
            </div>
		</div>

		<div class="col-md-7">
			<div class="thumbnail" style="padding: 30px; border: none; box-shadow: var(--shadow-medium); height: 400px;">
				<form action="proses/add.php" method="GET">
					<input type="hidden" name="kd_cs" value="<?= $kode_cs; ?>">
					<input type="hidden" name="produk" value="<?= $kode;  ?>">
					<input type="hidden" name="hal"  value="2">
					
					<h3 style="margin-top: 0; color: var(--text-dark); font-weight: 700;"><?= $row['nama']; ?></h3>
					
					<div style="margin: 20px 0;">
						<span style="font-size: 28px; font-weight: 700; color: var(--accent-color);">Rp.<?= number_format($row['harga']); ?></span>
					</div>
					
					<div style="margin: 20px 0; padding: 20px; background: rgba(255, 107, 107, 0.05); border-radius: var(--border-radius); border-left: 4px solid var(--accent-color);">
						<h5 style="margin-top: 0; color: var(--text-dark);"><i class="fa fa-info-circle" style="color: var(--accent-color); margin-right: 8px;"></i>Deskripsi Produk</h5>
						<p style="margin-bottom: 0; color: var(--text-light); line-height: 1.6;"><?= $row['deskripsi'];  ?></p>
					</div>
					
					<div style="margin: 25px 0;">
						<label style="font-weight: 600; color: var(--text-dark); margin-bottom: 10px; display: block;">
							<i class="fa fa-shopping-cart" style="color: var(--accent-color); margin-right: 8px;"></i>Jumlah:
						</label>
						<input class="form-control" type="number" min="1" name="jml" value="1" style="max-width: 120px; display: inline-block; margin-right: 15px;">
					</div>
					
					<div style="margin-top: 30px;">
						<?php 
						if(isset($_SESSION['user'])){
							?>
							<button type="submit" class="btn btn-success" style="margin-right: 15px; padding: 15px 30px;">
								<i class="fa fa-shopping-cart"></i> Tambahkan ke Keranjang
							</button>
							<?php 
						}else{
							?>
							<a href="keranjang.php" class="btn btn-success" style="margin-right: 15px; padding: 15px 30px;">
								<i class="fa fa-shopping-cart"></i> Tambahkan ke Keranjang
							</a>
							<?php 
						}
						?>
						<a href="index.php" class="btn btn-warning" style="padding: 15px 30px;">
							<i class="fa fa-arrow-left"></i> Kembali Belanja
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


    <?php 
    // Reviews section
    $avgQ = mysqli_query($conn, "SELECT AVG(rating) as avg_rating, COUNT(*) as total FROM review WHERE kode_produk = '$kode'");
    $avg = mysqli_fetch_assoc($avgQ);
    $avg_rating = $avg && $avg['avg_rating'] ? round($avg['avg_rating'], 1) : 0;
    $total_review = $avg && $avg['total'] ? (int)$avg['total'] : 0;

    function render_stars($value, $size = 'medium'){
        $full = floor($value);
        $half = ($value - $full) >= 0.5 ? 1 : 0;
        $empty = 5 - $full - $half;
        $size_class = $size === 'large' ? 'fa-lg' : ($size === 'small' ? 'fa-sm' : '');
        
        $out = '';
        for($i=0;$i<$full;$i++){ 
            $out .= '<i class="fa fa-star '.$size_class.'" style="color:#ffd700; margin-right: 2px;"></i> '; 
        }
        if($half){ 
            $out .= '<i class="fa fa-star-half-alt '.$size_class.'" style="color:#ffd700; margin-right: 2px;"></i> '; 
        }
        for($i=0;$i<$empty;$i++){ 
            $out .= '<i class="fa fa-star-o '.$size_class.'" style="color:#ddd; margin-right: 2px;"></i> '; 
        }
        return $out;
    }
    ?>

    <a id="ulasan"></a>
    <div class="row" style="margin-top: 40px;">
        <div class="col-md-12">
            <h3 class="section-title" style="margin-bottom: 30px; text-align: left;">Ulasan & Rating Produk</h3>
            
            <!-- Rating Summary -->
            <div class="row">
                <div class="col-md-4">
                    <div class="thumbnail" style="padding: 30px; text-align: center; border: none; box-shadow: var(--shadow-light);">
                        <div style="font-size: 48px; font-weight: 700; color: var(--accent-color); margin-bottom: 10px;">
                            <?= $avg_rating; ?>
                        </div>
                        <div style="margin-bottom: 10px;">
                            <?= render_stars($avg_rating, 'large'); ?>
                        </div>
                        <div style="color: var(--text-light); font-size: 14px;">
                            Berdasarkan <?= $total_review; ?> ulasan
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="thumbnail" style="padding: 25px; border: none; box-shadow: var(--shadow-light);">
                        <?php
                        // Get rating distribution
                        $rating_dist = array();
                        for($i=5; $i>=1; $i--){
                            $distQ = mysqli_query($conn, "SELECT COUNT(*) as count FROM review WHERE kode_produk = '$kode' AND rating = $i");
                            $dist = mysqli_fetch_assoc($distQ);
                            $count = $dist ? (int)$dist['count'] : 0;
                            $percentage = $total_review > 0 ? round(($count / $total_review) * 100) : 0;
                            $rating_dist[$i] = array('count' => $count, 'percentage' => $percentage);
                        }
                        ?>
                        
                        <h5 style="margin-top: 0; color: var(--text-dark); margin-bottom: 20px;">
                            <i class="fa fa-chart-bar" style="color: var(--accent-color); margin-right: 8px;"></i>
                            Distribusi Rating
                        </h5>
                        
                        <?php for($i=5; $i>=1; $i--): ?>
                        <div style="display: flex; align-items: center; margin-bottom: 12px;">
                            <span style="width: 20px; font-weight: 600; color: var(--text-dark);"><?= $i ?></span>
                            <i class="fa fa-star" style="color: #ffd700; margin: 0 8px;"></i>
                            <div style="flex: 1; background: #f0f0f0; height: 8px; border-radius: 4px; margin-right: 10px; position: relative;">
                                <div style="width: <?= $rating_dist[$i]['percentage'] ?>%; background: linear-gradient(90deg, var(--accent-color), var(--accent-hover)); height: 100%; border-radius: 4px; transition: width 0.5s ease;"></div>
                            </div>
                            <span style="width: 60px; font-size: 12px; color: var(--text-light);"><?= $rating_dist[$i]['count'] ?></span>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            <!-- Individual Reviews -->
            <div style="margin-top: 30px;">
                <h5 style="color: var(--text-dark); margin-bottom: 20px;">
                    <i class="fa fa-comments" style="color: var(--accent-color); margin-right: 8px;"></i>
                    Ulasan Pelanggan (<?= $total_review ?>)
                </h5>
                
                <?php 
                $revQ = mysqli_query($conn, "SELECT r.id_review, r.rating, r.tanggal, c.nama FROM review r JOIN customer c ON c.kode_customer = r.kode_customer WHERE r.kode_produk = '$kode' ORDER BY r.tanggal DESC LIMIT 10");
                if(mysqli_num_rows($revQ) > 0){
                    while($rv = mysqli_fetch_assoc($revQ)){
                        ?>
                        <div id="review-<?= (int)$rv['id_review']; ?>" class="thumbnail" style="padding: 20px; margin-bottom: 15px; border: none; box-shadow: var(--shadow-light);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <div style="display: flex; align-items: center;">
                                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, var(--accent-color), var(--accent-hover)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                        <i class="fa fa-user" style="color: white; font-size: 16px;"></i>
                                    </div>
                                    <div>
                                        <strong style="color: var(--text-dark); font-size: 16px;"><?= htmlspecialchars($rv['nama']); ?></strong>
                                        <div style="margin-top: 4px;">
                                            <?= render_stars((int)$rv['rating'], 'small'); ?>
                                        </div>
                                    </div>
                                </div>
                                <span style="font-size: 12px; color: var(--text-light); background: rgba(255, 107, 107, 0.1); padding: 4px 8px; border-radius: 12px;">
                                    <?= date('d M Y', strtotime($rv['tanggal'])); ?>
                                </span>
                            </div>
                        </div>
                        <?php 
                    }
                } else {
                    ?>
                    <div class="thumbnail" style="padding: 40px; text-align: center; border: none; box-shadow: var(--shadow-light);">
                        <i class="fa fa-comment-o" style="font-size: 48px; color: var(--accent-color); margin-bottom: 15px;"></i>
                        <h5 style="color: var(--text-dark); margin-bottom: 10px;">Belum Ada Ulasan</h5>
                        <p style="color: var(--text-light); margin-bottom: 0;">Jadilah yang pertama memberikan ulasan untuk produk ini!</p>
                    </div>
                    <?php
                }
                ?>
            </div>

            

            <!-- Rating Form -->
            <div style="margin-top: 40px;">
                <?php if(isset($_SESSION['kd_cs'])){ ?>
                    <?php 
                    // Cek apakah user sudah pernah review produk ini
                    $hasReviewedQ = mysqli_query($conn, "SELECT 1 FROM review WHERE kode_produk = '$kode' AND kode_customer = '".$_SESSION['kd_cs']."' LIMIT 1");
                    $hasReviewed = $hasReviewedQ && mysqli_num_rows($hasReviewedQ) > 0;
                    ?>
                    
                    <div class="thumbnail" style="padding: 30px; border: none; box-shadow: var(--shadow-medium);">
                        <h4 style="margin-top: 0; color: var(--text-dark); margin-bottom: 25px;">
                            <i class="fa fa-star" style="color: var(--accent-color); margin-right: 8px;"></i>
                            Berikan Rating & Ulasan
                        </h4>
                        
                        <?php if($hasReviewed){ ?>
                            <div class="alert alert-success" style="border-radius: var(--border-radius); border: none; background: rgba(78, 205, 196, 0.1); color: var(--text-dark);">
                                <i class="fa fa-check-circle"></i> Terima kasih! Anda sudah memberikan ulasan untuk produk ini.
                            </div>
                        <?php } else { ?>
                            <form action="proses/review_add.php" method="POST" id="ratingForm">
                                <input type="hidden" name="kode_produk" value="<?= $kode; ?>">
                                <input type="hidden" name="rating" id="selectedRating" value="5" required>
                                
                                <div style="margin-bottom: 25px;">
                                    <label style="font-weight: 600; color: var(--text-dark); margin-bottom: 15px; display: block;">
                                        <i class="fa fa-star" style="color: var(--accent-color); margin-right: 8px;"></i>
                                        Pilih Rating:
                                    </label>
                                    
                                    <div class="star-rating" style="display: flex; align-items: center; gap: 5px; margin-bottom: 10px;">
                                        <?php for($i=1; $i<=5; $i++): ?>
                                            <i class="fa fa-star-o rating-star" 
                                               data-rating="<?= $i ?>" 
                                               style="font-size: 24px; color: #ddd; cursor: pointer; transition: var(--transition);"
                                               onmouseover="highlightStars(<?= $i ?>)"
                                               onmouseout="resetStars()"
                                               onclick="selectRating(<?= $i ?>)">
                                            </i>
                                        <?php endfor; ?>
                                        <span id="ratingText" style="margin-left: 15px; font-weight: 600; color: var(--text-dark);">Sangat Baik</span>
                                    </div>
                                </div>
                                
                                <div style="margin-bottom: 25px;">
                                    <div class="alert alert-info" style="border-radius: var(--border-radius); border: none; background: rgba(255, 217, 61, 0.1); color: var(--text-dark);">
                                        <i class="fa fa-info-circle"></i> 
                                        <strong>Tips:</strong> Anda juga bisa memberikan tanggapan lebih detail melalui WhatsApp: 
                                        <a href="https://wa.me/6287804616097?text=Halo%20saya%20ingin%20beri%20tanggapan%20untuk%20produk%20<?= urlencode($row['nama']); ?>" 
                                           target="_blank" style="color: var(--accent-color); font-weight: 600;">
                                            <i class="fa fa-whatsapp"></i> Klik di sini
                                        </a>
                                    </div>
                                </div>
                                
                                <div style="text-center">
                                    <button type="submit" class="btn btn-success" style="padding: 15px 40px; font-size: 16px;">
                                        <i class="fa fa-paper-plane"></i> Kirim Rating
                                    </button>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <?php $next = urlencode('detail_produk.php?produk='.$kode); ?>
                    <div class="thumbnail" style="padding: 30px; text-align: center; border: none; box-shadow: var(--shadow-medium);">
                        <i class="fa fa-user-lock" style="font-size: 48px; color: var(--accent-color); margin-bottom: 20px;"></i>
                        <h4 style="margin-top: 0; color: var(--text-dark); margin-bottom: 15px;">Login Diperlukan</h4>
                        <p style="color: var(--text-light); margin-bottom: 25px;">Anda harus login terlebih dahulu untuk memberikan rating dan ulasan.</p>
                        <a href="user_login.php?next=<?= $next; ?>" class="btn btn-warning" style="padding: 15px 30px;">
                            <i class="fa fa-sign-in"></i> Login untuk Memberikan Rating
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>

<script>
let selectedRating = 5;
const ratingTexts = {
    1: 'Buruk',
    2: 'Kurang', 
    3: 'Cukup',
    4: 'Baik',
    5: 'Sangat Baik'
};

function highlightStars(rating) {
    const stars = document.querySelectorAll('.rating-star');
    stars.forEach((star, index) => {
        if (index < rating) {
            star.style.color = '#ffd700';
            star.className = 'fa fa-star rating-star';
        } else {
            star.style.color = '#ddd';
            star.className = 'fa fa-star-o rating-star';
        }
    });
    document.getElementById('ratingText').textContent = ratingTexts[rating];
}

function resetStars() {
    const stars = document.querySelectorAll('.rating-star');
    stars.forEach((star, index) => {
        if (index < selectedRating) {
            star.style.color = '#ffd700';
            star.className = 'fa fa-star rating-star';
        } else {
            star.style.color = '#ddd';
            star.className = 'fa fa-star-o rating-star';
        }
    });
    document.getElementById('ratingText').textContent = ratingTexts[selectedRating];
}

function selectRating(rating) {
    selectedRating = rating;
    document.getElementById('selectedRating').value = rating;
    
    const stars = document.querySelectorAll('.rating-star');
    stars.forEach((star, index) => {
        if (index < rating) {
            star.style.color = '#ffd700';
            star.className = 'fa fa-star rating-star';
        } else {
            star.style.color = '#ddd';
            star.className = 'fa fa-star-o rating-star';
        }
    });
    document.getElementById('ratingText').textContent = ratingTexts[rating];
}

// Initialize stars on page load
document.addEventListener('DOMContentLoaded', function() {
    resetStars();
});
</script>

<?php 
include 'footer.php';
?>