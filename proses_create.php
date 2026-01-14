<?php
require 'config.php';

$nama = trim($_POST['nama_peminjam']);
$kelas = trim($_POST['kelas']);
$ruang = trim($_POST['ruangan_dipinjam']);
$tgl_pinjam = $_POST['tanggal_pinjam'];
$tgl_kembali = $_POST['tanggal_kembali'] ?: null;
$ket = trim($_POST['keterangan']);

$foto = null;

if (!empty($_FILES['foto_peminjaman']['name'])) {
    $ext = pathinfo($_FILES['foto_peminjaman']['name'], PATHINFO_EXTENSION);
    $foto = time() . "_" . rand(1000, 9999) . "." . $ext;

    move_uploaded_file($_FILES['foto_peminjaman']['tmp_name'], "uploads/" . $foto);
}

$stmt = $conn->prepare("
    INSERT INTO PEMINJAMAN 
    (nama_peminjam, kelas, ruangan_dipinjam, tanggal_pinjam, tanggal_kembali, keterangan, foto_peminjaman) 
    VALUES (?, ?, ?, ?, ?, ?, ?)
");
$stmt->bind_param("sssssss", $nama, $kelas, $ruang, $tgl_pinjam, $tgl_kembali, $ket, $foto);
$stmt->execute();

header("Location: index.php");
exit();
