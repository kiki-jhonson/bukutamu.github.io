<!-- koneksi -->
<?php 
$server = "localhost";
$username = "root";
$password = "";
$database = "buku_tamu";

$koneksi = mysqli_connect($server, $username ,$password, $database) or die(mysqli_error($koneksi));

