<?php 
    include_once("../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Barang</title>
</head>
<body>
    <form action="dashboard.php" method="get">
        <label>Cari: </label>
        <input type="text" name="cari">
        <input type="submit" value="Cari">
    </form>
    <?php 
        if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
        }
    ?>
    <table border="1">
        <h1>Data Barang</h1>
        <a href="tambah/tambah.php">| Tambah Data |</a>
        <a href="cetak.php" target="_blank">| Cetak |</a>
        <a href="../dashboard.php">| Home |</a>
            <?php 
                if (isset($_GET['cari'])) {
                    $cari = $_GET['cari'];
                    $ambildata = mysqli_query($kon, "SELECT * FROM barang WHERE id_barang LIKE '%".$cari."%' OR nama_barang LIKE '%".$cari."%' OR nama_supplier LIKE '%".$cari."%' OR kode_barang LIKE '%".$cari."%'");
                } else {
                    $ambildata = mysqli_query($kon, "SELECT * FROM barang ORDER BY id_barang ASC");
                    $num = mysqli_num_rows($ambildata);
                }
            ?>
        <tr>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Nama Supplier</th>
            <th>Kode Barang</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
        <?php 
            while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                echo "<tr>";
                echo "<td>" . $id = $userAmbilData['id_barang'] . "</td>";
                echo "<td>" . $nama_barang = $userAmbilData['nama_barang'] . "</td>";
                echo "<td>" . $nama_supplier = $userAmbilData['nama_supplier'] . "</td>";
                echo "<td>" . $kode_barang = $userAmbilData['kode_barang'] . "</td>";
                echo "<td>";
                    $data = mysqli_query($kon, "SELECT * FROM barang WHERE id_barang = '{$userAmbilData['id_barang']}'");
                    while ($row = mysqli_fetch_array($data)) {
                        echo "<a href='javascript:void(0);' onclick=\"window.open(aset/{$row['gambar']}', '_blank');\">
                        <img src='aset/{$row['gambar']}' alt='Gambar Barang' width='150' height='200'></a>";
                    }
                echo "</td>";
                echo "<td>
                    <a href='update/update.php?id=" .$userAmbilData['id_barang']. "'>Update</a> |
                    <a href='view/view.php?id=" .$userAmbilData['id_barang']. "'>View</a> |
                    <a href='baranghapus.php?id=" .$userAmbilData['id_barang']. "'>Hapus</a> |
                </td>";
            }
        ?>
    </table>
</body>
</html>