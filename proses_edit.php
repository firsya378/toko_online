<?php
require 'config.php';

$id = (int)$_POST['id_produk'];
$nama_produk = trim($_POST['nama_produk']);
$harga_produk = (int)$_POST['harga_produk'];
$tanggal_pembelian = $_POST['tanggal_pembelian'];
$deskripsi = trim($_POST['deskripsi'] ?? '');

// Ambil foto lama
$res = $conn->query("SELECT foto_produk FROM PRODUK WHERE id_produk=$id");
$foto_lama = $res->fetch_assoc()['foto_produk'];

$foto_baru = $foto_lama;

// Jika upload foto baru
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
    $foto_baru = time() . "_" . rand(1000, 9999) . "." . strtolower($ext);
    
    // Pindahkan file ke folder uploads
    if (!move_uploaded_file($_FILES['foto_produk']['tmp_name'], "uploads/" . $foto_baru)) {
        die("Gagal mengupload file.");
    }
    
    // Hapus foto lama jika ada dan jika bukan foto default/placeholder
    if (!empty($foto_lama) && file_exists("uploads/" . $foto_lama) && $foto_lama != $foto_baru) {
        unlink("uploads/" . $foto_lama);
    }
}

// Update data ke database
$stmt = $conn->prepare("
    UPDATE PRODUK 
    SET nama_produk=?, harga_produk=?, foto_produk=?, tanggal_pembelian=?, deskripsi=?
    WHERE id_produk=?
");
$stmt->bind_param("sisssi", $nama_produk, $harga_produk, $foto_baru, $tanggal_pembelian, $deskripsi, $id);
$stmt->execute();

header("Location: index.php");
exit();
