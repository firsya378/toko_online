<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>
<h1>Tambah Produk</h1>

<form action="proses_create.php" method="post" enctype="multipart/form-data">
    Nama Produk: <input type="text" name="nama_produk" required><br><br>
    Harga Produk: <input type="number" name="harga_produk" min="0" step="100" required><br><br>
    Tanggal Pembelian: <input type="date" name="tanggal_pembelian" required><br><br>
    Deskripsi: <textarea name="deskripsi"></textarea><br><br>

    Foto Produk (opsional):
    <input type="file" name="foto_produk" accept="image/*"><br><br>

    <input type="submit" value="Simpan Produk">
</form>

<a href="index.php">Kembali ke Daftar Produk</a>
</body>
</html>
