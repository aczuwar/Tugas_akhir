<?php 
session_start();
include '../koneksi/koneksi.php';

if(!isset($_SESSION['kd_cs'])){
    header('Location: ../user_login.php');
    exit;
}

$kode_cs = $_SESSION['kd_cs'];
$kode_produk = mysqli_real_escape_string($conn, $_POST['kode_produk']);
$rating = (int)$_POST['rating'];

if($rating < 1) { $rating = 1; }
if($rating > 5) { $rating = 5; }

$now = date('Y-m-d H:i:s');

$sql = "INSERT INTO review(kode_produk, kode_customer, rating, tanggal) VALUES('$kode_produk', '$kode_cs', $rating, '$now')";
mysqli_query($conn, $sql);
@mysqli_query($conn, "INSERT INTO review_giver(kode_produk, kode_customer, tanggal) VALUES('$kode_produk', '$kode_cs', '$now')");

header('Location: ../detail_produk.php?produk='.$kode_produk);
exit;
?>


