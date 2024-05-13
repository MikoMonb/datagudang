<?php 
    include_once("../../config/koneksi.php");

    if(isset($_GET['cari'])) {
        $cari = $_GET['cari'];
    }

    $perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 15;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

    $query = "SELECT gudang.id_datagudang, barang.nama_barang, gudang.quantity, 
                gudang.tanggal_order, gudang.tanggal_diterima, gudang.no_nota as nota, barang.gambar 
                FROM gudang
                JOIN barang ON barang.id_barang = gudang_idbarang";

    if (!empty($cari)) {
        $query .= " WHERE gudang.id_datagudang LIKE '%".$cari."%'
                    OR gudang.no_nota LIKE '%".$cari."%'";
    }
    
    $query .= " ORDER BY gudang.id_datagudang DESC LIMIT $start, $perPage";
    $ambildata = mysqli_query($kon, $query) or die(mysqli_error($kon));
    $num = mysqli_num_rows($ambildata);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Gudang</title>
</head>
<body>
    <form action="dashboard.php" method="get">
        <label for="">Cari: </label>
        <input type="text" name="cari" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
        <input type="submit" name="" id="" value="Cari">
    </form>
    <?php include("controller/tabel_template.php") ?>
    <?php  
        $totalData = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM gudang"));
        $totalPage = ceil($totalData / $perPage);
        include("controller/pagination_template.php");
    ?>
</body>
</html>