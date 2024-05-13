<a href="tambah/tambah.php">| Tambah Data |</a>
<a href="cetak.php" target="_blank">| Cetak |</a>
<a href="../dashboard.php">| Home |</a>
<form action="../dashboard.php" method="get">
    <label for="">Tampilkan: </label>
    <select name="perPage" onchange="this.form.submit()">
        <option value="15" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 5 ? 'selected' : ''; ?>>15</option>
        <option value="25" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 10 ? 'selected' : ''; ?>>25</option>
        <option value="35" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 20 ? 'selected' : ''; ?>>35</option>
        <option value="50" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 30 ? 'selected' : ''; ?>>50</option>    
    </select>
</form>
<table border="1">
    <tr>
        <th> No. </th>
        <th> ID Data </th>
        <th> No. Nota </th>
        <th> Tanggal Order </th>
        <th> Tanggal Diterima </th>
        <th> Nama Barang </th>
        <th> Quantity </th>
        <th> Gambar </th>
        <th> Aksi </th>
    </tr>
    <?php 
        $prevGudangID = null;
        $rowSpanCounts = [];

        if ($num > 0) {
            while ($row = mysqli_fetch_array($ambildata)) {
                $gudangID = $row['id_datagudang'];
                $rowSpanCounts[$gudangID][] = $row;
            }

            mysqli_data_seek($ambildata, 0);
            $no = $start + 1;
            foreach ($rowSpanCounts as $gudangID => $rows) {
                $rowSpanCount = count($rows);
                $firstRow = true;
                foreach ($rows as $key => $userAmbilData) {
                    echo "<tr>";
                    if ($firstRow) {
                        echo "<td rowspan='" . $rowSpanCount . "'>" . $no . "</td>";
                        echo "<td rowspan='" . $rowSpanCount . "'>" . $gudangID . "</td>";
                        echo "<td rowspan='" . $rowSpanCount . "'>" . $userAmbilData['nota'] . "</td>";
                        echo "<td rowspan='" . $rowSpanCount . "'>" . $userAmbilData['tanggal_order'] . "</td>";
                        echo "<td rowspan='" . $rowSpanCount . "'>" . $userAmbilData['tanggal_diterima'] . "</td>";
                        $firstRow = false;
                    }
                        echo "<td>" . $userAmbilData['nama_barang'] . "</td>";
                        echo "<td>" . $userAmbilData['quantity'] . "</td>";
                        echo "<td><img src='../barang/aset/" . $userAmbilData['gambar'] . "' alt='Gambar Barang' width='150' height='200'></td>";

                        if ($key === 0) {
                            echo "<td rowspan='{$rowSpanCount}'>";
                            if (isset($userAmbilData['id_datagudang'])) {
                                echo "<a href='/cetak/cetak.php?id_datagudang={$userAmbilData['id_datagudang']}' target='_blank'>Cetak</a>";
                            }
                            echo "</td>";
                        }
                    echo "</tr>";
                }
            }
        } else {
            echo "<tr><td colspan='9'>Tidak ada data</td></tr>";
        }
    ?>
</table>