<?php 
    include_once("../../../config/koneksi.php");
    include_once("barangupdate.php");

    $barangController = new BarangController($kon);

    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $nama_barang = $_POST['nama_barang'];
        $nama_supplier = $_POST['nama_supplier'];
        $kode_barang = $_POST['kode_barang'];

        $message = $barangController->updateBarang($id, $nama_barang, $nama_supplier, $kode_barang);
        echo $message;

        header("Location: ../dashboard.php");
    }

    $id = null;
    $nama_barang = null;
    $nama_supplier = null;
    $kode_barang = null;

    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $result = $barangController->getDataBarang($id);

        if ($result) {
            $id = $result['id_barang'];
            $nama_barang = $result['nama_barang'];
            $nama_supplier = $result['nama_supplier'];
            $kode_barang = $result['kode_barang'];
        } else {
            echo "ID tidak ditemukan.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Update Barang</title>
</head>
<body>
    <h1>Update Data Barang</h1>
    <a href="../dashboard.php">| Home |</a>
    <form action="update.php" name="update" method="post" enctype="multipart/form-data">
        <table border="0">
            <tr>
                <td>ID Barang</td>
                <td> : </td>
                <td><input type="text" name="id" id="id" value="<?php echo $id; ?>" readonly></td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td> : </td>
                <td><input type="text" name="nama_barang" id="nama_barang" value="<?php echo $nama_barang; ?>" required></td>
            </tr>
            <tr>
                <td>Nama Supplier</td>
                <td> : </td>
                <td><input type="text" name="nama_supplier" id="nama_supplier" value="<?php echo $nama_supplier; ?>" required></td>
            </tr>
            <tr>
                <td>Kode Barang</td>
                <td> : </td>
                <td><input type="text" name="kode_barang" id="kode_barang" value="<?php echo $kode_barang; ?>" required></td>
            </tr>
        </table>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>