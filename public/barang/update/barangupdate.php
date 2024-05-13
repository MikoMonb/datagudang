<?php 
    include_once("../../../config/koneksi.php");

    class BarangController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function updateBarang($id, $nama_barang, $nama_supplier, $kode_barang) {
            $result = mysqli_query($this->kon, "UPDATE barang SET nama_barang = '$nama_barang', nama_supplier = '$nama_supplier', kode_barang = '$kode_barang' WHERE id_barang = '$id'");

            if ($result) {
                return "Data sukses di update";
            } else {
                return "Data gagal di update";
            }
        }

        public function getDataBarang($id) {
            $sql = "SELECT * FROM barang WHERE id_barang = '$id'";
            $ambildata = $this->kon->query($sql);

            if ($result = mysqli_fetch_array($ambildata)) {
                return $result;
            } else {
                return false;
            }
        }
    }
?>