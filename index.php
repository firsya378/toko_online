<?php
require 'config.php';

$result = $conn->query("SELECT * FROM PEMINJAMAN ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Peminjaman Ruang</title>
</head>
<body>
<h1>Daftar Peminjaman Ruang</h1>
<a href="create.php">Tambah Peminjaman</a>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Peminjam</th>
        <th>Kelas</th>
        <th>Ruangan</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Keterangan</th>
        <th>Foto Peminjaman</th>
        <th>Aksi</th>
    </tr>
    <?php
    $no = 1; 
    while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($row['nama_peminjam']) ?></td>
        <td><?= htmlspecialchars($row['kelas']) ?></td>
        <td><?= htmlspecialchars($row['ruangan_dipinjam']) ?></td>
        <td><?= $row['tanggal_pinjam'] ?></td>
        <td><?= $row['tanggal_kembali'] ?></td>
        <td><?= htmlspecialchars($row['keterangan']) ?></td>
        <td>
            <?php if($row['foto_peminjaman']): ?>
                <img src="uploads/<?= $row['foto_peminjaman'] ?>" width="80">
            <?php else: ?>
                -
            <?php endif; ?>
        </td>
        <td>
            <a href="edit.php?id=<?= $row['id_peminjaman'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $row['id_peminjaman'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
