<?php
require 'config.php';

$id = (int)$_GET['id'];

// cek foto lama
$res = $conn->query("SELECT foto_peminjaman FROM PEMINJAMAN WHERE id_peminjaman=$id");
$data = $res->fetch_assoc();

if ($data && $data['foto_peminjaman'] && file_exists("uploads/" . $data['foto_peminjaman'])) {
    unlink("uploads/" . $data['foto_peminjaman']);
}

$stmt = $conn->prepare("DELETE FROM PEMINJAMAN WHERE id_peminjaman=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: index.php");
exit();
