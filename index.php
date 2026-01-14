<?php
require 'config.php';

$result = $conn->query("SELECT * FROM PRODUK ORDER BY tanggal_pembelian DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
</head>
<body>
<h1>Daftar Produk</h1>
<a href="create.php">Tambah Produk</a>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Foto Produk</th>
        <th>Harga Produk</th>
        <th>Tanggal Pembelian</th>
        <th>Aksi</th>
    </tr>
    <?php
    $no = 1; 
    while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($row['nama_produk']) ?></td>
        <td>
            <?php if($row['foto_produk']): ?>
                <img src="uploads/<?= $row['foto_produk'] ?>" width="80" alt="<?= htmlspecialchars($row['nama_produk']) ?>">
            <?php else: ?>
                <span>-</span>
            <?php endif; ?>
        </td>
        <td>Rp <?= number_format($row['harga_produk'], 0, ',', '.') ?></td>
        <td><?= date('d-m-Y', strtotime($row['tanggal_pembelian'])) ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id_produk'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $row['id_produk'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
