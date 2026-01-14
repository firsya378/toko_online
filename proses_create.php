<?php
require 'config.php';

$nama_produk = trim($_POST['nama_produk']);
$harga_produk = (int)$_POST['harga_produk'];
$tanggal_pembelian = $_POST['tanggal_pembelian'];
$deskripsi = trim($_POST['deskripsi'] ?? '');

$foto_produk = null;

// Upload foto jika ada
if (!empty($_FILES['foto_produk']['name']) && $_FILES['foto_produk']['error'] == 0) {
    // Validasi tipe file
    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
    $file_type = $_FILES['foto_produk']['type'];
    
    if (!in_array($file_type, $allowed_types)) {
        die("Hanya file gambar (JPG, PNG, GIF, WebP) yang diizinkan.");
    }
    
    // Validasi ukuran file (max 5MB)
    $max_size = 5 * 1024 * 1024; // 5MB
    if ($_FILES['foto_produk']['size'] > $max_size) {
        die("Ukuran file maksimal 5MB.");
    }
    
    // Generate nama file unik
    $ext = pathinfo($_FILES['foto_produk']['name'], PATHINFO_EXTENSION);
    $foto_produk = time() . "_" . rand(1000, 9999) . "." . strtolower($ext);
    
    // Pindahkan file ke folder uploads
    if (!move_uploaded_file($_FILES['foto_produk']['tmp_name'], "uploads/" . $foto_produk)) {
        die("Gagal mengupload file.");
    }
}

// Insert data ke database
$stmt = $conn->prepare("
    INSERT INTO PRODUK 
    (nama_produk, harga_produk, foto_produk, tanggal_pembelian, deskripsi) 
    VALUES (?, ?, ?, ?, ?)
");
$stmt->bind_param("sisss", $nama_produk, $harga_produk, $foto_produk, $tanggal_pembelian, $deskripsi);
$stmt->execute();

header("Location: index.php");
exit();
