<?php 
    include_once("../../../config/koneksi.php");

    class BarangController { 
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function tambahBarang() {
            $setAuto = mysqli_query($this->kon, "SELECT MAX(id_barang) AS max_id FROM barang");
			$result = mysqli_fetch_assoc($setAuto);
			$max_id = $result['max_id'];

			if (is_numeric($max_id)) {
				$nounik = $max_id + 1;
			} else {
				$nounik = 1;
			} return $nounik;
        }

        public function tambahDataBarang($data) {
            $id_barang = $data['id_barang'];
            $nama_barang = $data['nama_barang'];
            $nama_supplier = $data['nama_supplier'];
            $kode_barang = $data['kode_barang'];

            $ekstensi_diperbolehkan = array('jpeg', 'jpg', 'png');
			$namagambar = $_FILES['gambar']['name'];
			$x = explode('.', $namagambar);
			$ekstensi = strtolower(end($x));
			$ukuran = $_FILES['gambar']['size'];
			$file_temp = $_FILES['gambar']['tmp_name'];

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
				if ($ukuran <= 2000000) {
					move_uploaded_file($file_temp, '../aset/' . $namagambar);
					$insertData = mysqli_query($this->kon, "INSERT INTO barang(id_barang, nama_barang, nama_supplier, kode_barang, gambar) VALUES ('$id_barang', '$nama_barang', '$nama_supplier', '$kode_barang', '$namagambar')");
					
					if ($insertData) {
						return "Data berhasil disimpan";
					} else {
						return "Gagal menyimpan data";
					}
				} else {
					echo "<div style='color: red'>
							Ukuran file terlalu besar! Silahkan pilih file yang lebih kecil.
						</div>";
				}
			} else {
				echo "<div style='color: red'>
						Ekstensi file yang di upload tidak diizinkan!
					</div>";
			}
        }
    }
    
?>