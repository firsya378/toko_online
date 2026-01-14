<?php
require 'config.php';

$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM PEMINJAMAN WHERE id_peminjaman=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Peminjaman</title>
</head>
<body>
<h1>Edit Peminjaman</h1>

<form action="proses_edit.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_peminjaman" value="<?= $data['id_peminjaman'] ?>">

    Nama: <input type="text" name="nama_peminjam" value="<?= htmlspecialchars($data['nama_peminjam']) ?>" required><br><br>
    Kelas: <input type="text" name="kelas" value="<?= htmlspecialchars($data['kelas']) ?>"><br><br>
    Ruangan: <input type="text" name="ruangan_dipinjam" value="<?= htmlspecialchars($data['ruangan_dipinjam']) ?>" required><br><br>
    Tanggal Pinjam: <input type="date" name="tanggal_pinjam" value="<?= $data['tanggal_pinjam'] ?>" required><br><br>
    Tanggal Kembali: <input type="date" name="tanggal_kembali" value="<?= $data['tanggal_kembali'] ?>"><br><br>
    Keterangan: <textarea name="keterangan"><?= htmlspecialchars($data['keterangan']) ?></textarea><br><br>

    Foto Lama:
    <?php if ($data['foto_peminjaman']): ?>
        <br><img src="uploads/<?= $data['foto_peminjaman'] ?>" width="120"><br>
    <?php else: ?>
        <br>- Tidak ada foto -<br>
    <?php endif; ?>

    Ganti Foto (opsional):
    <input type="file" name="foto_peminjaman" accept="image/*"><br><br>

    <input type="submit" value="Update">
</form>

<a href="index.php">Kembali</a>
</body>
</html>
