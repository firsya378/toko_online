<!DOCTYPE html>
<html>
<head>
    <title>Tambah Peminjaman</title>
</head>
<body>
<h1>Tambah Peminjaman</h1>

<form action="proses_create.php" method="post" enctype="multipart/form-data">
    Nama Peminjam: <input type="text" name="nama_peminjam" required><br><br>
    Kelas: <input type="text" name="kelas"><br><br>
    Ruangan: <input type="text" name="ruangan_dipinjam" required><br><br>
    Tanggal Pinjam: <input type="date" name="tanggal_pinjam" required><br><br>
    Tanggal Kembali: <input type="date" name="tanggal_kembali"><br><br>
    Keterangan: <textarea name="keterangan"></textarea><br><br>

    Foto Peminjaman:
    <input type="file" name="foto_peminjaman" accept="image/*"><br><br>

    <input type="submit" value="Simpan">
</form>

<a href="index.php">Kembali</a>
</body>
</html>
