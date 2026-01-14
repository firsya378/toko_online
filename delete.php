<?php
require 'config.php';

$id = (int)$_GET['id'];

// cek foto lama
$res = $conn->query("SELECT foto_produk FROM PRODUK WHERE id_produk=$id");
$data = $res->fetch_assoc();

if ($data && !empty($data['foto_produk']) && file_exists("uploads/" . $data['foto_produk'])) {
    unlink("uploads/" . $data['foto_produk']);
}

$stmt = $conn->prepare("DELETE FROM PRODUK WHERE id_produk=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: index.php");
exit();
