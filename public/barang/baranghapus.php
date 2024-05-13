<?php 
    include_once("../../config/koneksi.php");

    class BarangController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function deleteBarang($id) {
            $result = mysqli_query($this->kon, "SELECT gambar FROM barang WHERE id_barang = '$id'");
            $row = mysqli_fetch_assoc($result);
            $gambar = $row['gambar'];

            $deletedata = mysqli_query($this->kon, "SELECT FROM barang WHERE id_barang = '$id'");

            if ($deletedata) {
                $gambar_dir = "aset/";

                if ($gambar && file_exists($gambar_dir . $gambar)) {
                    unlink($gambar_dir . $gambar);
                }
                return "Data sukses di hapus";
            } else {
                return "Data gagal di hapus";
            }
        }
    }

    $barangController = new BarangController($kon);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $message = $barangController->deleteBarang($id);
        echo $message;
		header("Location: dashboard.php");
    }
?>