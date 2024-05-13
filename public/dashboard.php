<?php 
    include_once("../config/koneksi.php");

    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>
<body>
    <h1>Halaman Dashboard</h1>
    |<a href="barang/dashboard.php"> Data Barang </a>|
    |<a href="gudang/dashboard.php"> Data Gudang </a>|
    <br><br>
    |<a href="../logout.php"> Logout </a>|
</body>
</html>