<?php 
    include_once("../../../config/koneksi.php");
    include_once("viewdata.php");

    $barangController = new BarangController($kon);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman View Barang</title>
</head>
<body>
    <a href="../dashboard.php">| Home |</a>
    <br><br>
    <form action="view.php" method="post" name="update_data">
        <table>
            <tr>
                <td>ID Barang</td>
                <td> : </td>
                <td><?php echo $id ?></td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td> : </td>
                <td><?php echo $nama_barang ?></td>
            </tr>
            <tr>
                <td>Nama Supplier</td>
                <td> : </td>
                <td><?php echo $nama_supplier ?></td>
            </tr>
            <tr>
                <td>Kode Barang</td>
                <td> : </td>
                <td><?php echo $kode_barang ?></td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td> : </td>
                <td>
                    <?php $data = mysqli_query($kon, "SELECT * FROM barang WHERE id_barang = '$id'");
                        while ($row = mysqli_fetch_array($data)) : ?>
                        <a href="#" onclick="window.open('../aset/<?php echo $row['gambar']; ?>', '_blank';)"></a>
                        <img src="../aset/<?php echo $row['gambar']; ?>" alt="<?php echo $row['gambar'] ?>" width='150' height='200'>
                    <?php endwhile; ?>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>