<?php
require 'config.php';

$id = $_POST['id_peminjaman'];
$nama = trim($_POST['nama_peminjam']);
$kelas = trim($_POST['kelas']);
$ruang = trim($_POST['ruangan_dipinjam']);
$tgl_pinjam = $_POST['tanggal_pinjam'];
$tgl_kembali = $_POST['tanggal_kembali'] ?: null;
$ket = trim($_POST['keterangan']);


// Ambil foto lama
$res = $conn->query("SELECT foto_peminjaman FROM PEMINJAMAN WHERE id_peminjaman=$id");
$lama = $res->fetch_assoc()['foto_peminjaman'];

$foto_baru = $lama;

// Jika upload foto baru
if (!empty($_FILES['foto_peminjaman']['name'])) {
    $ext = pathinfo($_FILES['foto_peminjaman']['name'], PATHINFO_EXTENSION);
    $foto_baru = time() . "_" . rand(1000, 9999) . "." . $ext;

    move_uploaded_file($_FILES['foto_peminjaman']['tmp_name'], "uploads/" . $foto_baru);

    // hapus foto lama
    if ($lama && file_exists("uploads/" . $lama)) {
        unlink("uploads/" . $lama);
    }
}

$stmt = $conn->prepare("
    UPDATE PEMINJAMAN 
    SET nama_peminjam=?, kelas=?, ruangan_dipinjam=?, tanggal_pinjam=?, tanggal_kembali=?, keterangan=?, foto_peminjaman=?
    WHERE id_peminjaman=?
");
$stmt->bind_param("sssssssi", $nama, $kelas, $ruang, $tgl_pinjam, $tgl_kembali, $ket, $foto_baru, $id);
$stmt->execute();

header("Location: index.php");
exit();
