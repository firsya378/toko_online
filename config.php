<?php
$host = 'localhost';
$user = 'roselina';
$pass = 'Roselina@123';
$db   = 'PEMINJAMAN_RUANG';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// tampilkan error PHP (bisa dimatikan di production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
