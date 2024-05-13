<?php 
    include_once("../../../config/koneksi.php");

    class BarangController {
        private $kon; 
        
        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function getBarangData($id) {
            $result = mysqli_query($this->kon, "SELECT * FROM barang WHERE id_barang = '$id'");
            return mysqli_fetch_array($result);
        }
    }

    $barangController = new BarangController($kon);
    $id = $_GET['id'];
    $barangData = $barangController->getBarangData($id);

    if ($barangData) {
        $id = $barangData['id_barang'];
        $nama_barang = $barangData['nama_barang'];
        $nama_supplier = $barangData['nama_supplier'];
        $kode_barang = $barangData['kode_barang'];
    }
?>