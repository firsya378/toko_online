<?php
require 'config.php';

$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM PRODUK WHERE id_produk=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>
<h1>Edit Produk</h1>

<form action="proses_edit.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_produk" value="<?= $data['id_produk'] ?>">

    Nama Produk: <input type="text" name="nama_produk" value="<?= htmlspecialchars($data['nama_produk']) ?>" required><br><br>
    Harga Produk: <input type="number" name="harga_produk" value="<?= $data['harga_produk'] ?>" min="0" step="100" required><br><br>
    Tanggal Pembelian: <input type="date" name="tanggal_pembelian" value="<?= $data['tanggal_pembelian'] ?>" required><br><br>
    Deskripsi (opsional): <textarea name="deskripsi"><?= htmlspecialchars($data['deskripsi'] ?? '') ?></textarea><br><br>

    Foto Lama:
    <?php if (!empty($data['foto_produk'])): ?>
        <br><img src="uploads/<?= $data['foto_produk'] ?>" width="120" alt="<?= htmlspecialchars($data['nama_produk']) ?>"><br>
    <?php else: ?>
        <br>- Tidak ada foto -<br>
    <?php endif; ?>

    Ganti Foto (opsional):
    <input type="file" name="foto_produk" accept="image/*"><br><br>

    <input type="submit" value="Update Produk">
</form>

<a href="index.php">Kembali ke Daftar Produk</a>
</body>
</html>
