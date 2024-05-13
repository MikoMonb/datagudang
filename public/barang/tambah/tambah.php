<?php 
    include_once("../../../config/koneksi.php");
    include_once("barangtambah.php");

    $barangController = new BarangController($kon);

    if(isset($_POST['submit'])) {
        $id_barang = $barangController->tambahBarang();

        $data = [
            'id_barang' => $id_barang,
            'nama_barang' => $_POST['nama_barang'],
            'nama_supplier' => $_POST['nama_supplier'],
            'kode_barang' => $_POST['kode_barang'],
        ];

        $message = $barangController->tambahDataBarang($data);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tambah Barang</title>
</head>
<body>
    <h1>Tambah Data Barang</h1>
    <a href="../dashboard.php">| Home |</a>
    <form action="tambah.php" method="post" name="tambah" enctype="multipart/form-data">
        <table border="0">
            <tr>
                <td>ID Barang</td>
                <td> : </td>
                <td><input type="text" name="id_barang" id="id_barang" value="<?php echo($barangController->tambahBarang())?>" readonly></td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td> : </td>
                <td><input type="text" name="nama_barang" required></td>
            </tr>
            <tr>
                <td>Nama Supplier</td>
                <td> : </td>
                <td><input type="text" name="nama_supplier" required></td>
            </tr>
            <tr>
                <td>Kode Barang</td>
                <td> : </td>
                <td><input type="text" name="kode_barang" required></td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td> : </td>
                <td><input type="file" name="gambar" required></td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Tambah Data">
        <?php if (isset($message)): ?>
            <div class="sucess-message">
                <?php echo($message) ?>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>