<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_evotingku"; // ✅ sesuai dengan nama database kamu yang asli

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
