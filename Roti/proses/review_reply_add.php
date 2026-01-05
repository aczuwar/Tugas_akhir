<?php 
session_start();
include '../koneksi/koneksi.php';

if(!isset($_SESSION['kd_cs'])){
    header('Location: ../user_login.php');
    exit;
}

$kode_cs = $_SESSION['kd_cs'];
$id_review = (int)$_POST['id_review'];
$kode_produk = mysqli_real_escape_string($conn, $_POST['kode_produk']);
$komentar = mysqli_real_escape_string($conn, $_POST['komentar']);
$now = date('Y-m-d H:i:s');

$sql = "INSERT INTO review_reply(id_review, kode_customer, komentar, tanggal) VALUES($id_review, '$kode_cs', '$komentar', '$now')";
mysqli_query($conn, $sql);

header('Location: ../detail_produk.php?produk='.$kode_produk.'#review-'.$id_review);
exit;
?>


