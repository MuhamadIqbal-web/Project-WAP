<?php
$host = "mysql-db";
$user = "user";
$pass = "user";   // sesuai MYSQL_PASSWORD
$db   = "wap";    // sesuai MYSQL_DATABASE

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
