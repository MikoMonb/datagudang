<?php
    include_once("../../config/koneksi.php");
    require("../../library/fpdf.php");

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

    $pdf->SetFont('Times', 'B', 13);
    $pdf->Cell(0, 15, '', 0, 1);
    $pdf->Cell(250, 10, 'Data Barang Gudang', 0, 0, 'R');

    $pdf->Cell(10, 17, '', 0, 1);	
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(10, 7, 'No', 1, 0, 'C');
    $pdf->Cell(30, 7, 'ID Data', 1, 0, 'C');
    $pdf->Cell(30, 7, 'No. Nota', 1, 0, 'C');
    $pdf->Cell(110, 7, 'tanggal Order', 1, 0, 'C');
    $pdf->Cell(22, 7, 'Tanggal Diterima', 1, 0, 'C');
    $pdf->Cell(22, 7, 'Nama Barang', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Quantity', 1, 0, 'C');

    $pdf->Cell(10, 7, '', 0, 1);
    $pdf->SetFont('Times', '', 10);

    $no = 1;
    $data = "SELECT gudang.id_datagudang, barang.nama_barang, gudang.quantity, 
                gudang.tanggal_order, gudang.tanggal_diterima, gudang.no_nota as nota,
                FROM gudang
                JOIN barang ON barang.id_barang = gudang_idbarang";

    $ambildata = mysqli_query($kon, $data) or die(mysqli_error($kon));
    $num = mysqli_num_rows($ambildata);

    $prevGudangID = null;
    $rowSpanCounts = [];

    if ($num > 0) {
        while ($row = mysqli_fetch_array($ambildata)) {
            $gudangID = $row['id_datagudang'];
            $rowSpanCounts[$gudangID][] = $row;
        }

        mysqli_data_seek($ambildata, 0);
        $no = 1;
        foreach ($rowSpanCounts as $gudangID => $rows) {
            $rowSpanCount = count($rows);
            $firstRow = true;
            foreach ($rows as $key => $userAmbilData) {
                if ($firstRow) {
                    $pdf->Cell(10, 6 * $rowSpanCount, $no++, 1, 0, 'C');
                    $pdf->Cell(30, 6 * $rowSpanCount, $userAmbilData['id_datagudang'], 1, 0, 'C');
                    $pdf->Cell(30, 6 * $rowSpanCount, $userAmbilData['namagudang'], 1, 0, 'C');
                    $firstRow = false;
                } else {
                    $pdf->Cell(10, 6 * $rowSpanCount, '', 0, 0, 'C');
                    $pdf->Cell(30, 6 * $rowSpanCount, '', 0, 0, 'C');
                    $pdf->Cell(30, 6 * $rowSpanCount, '', 0, 0, 'C');
                }

                $pdf->Cell(110, 6, $userAmbilData['nama_buku'], 1, 0, 'C');
                $pdf->Cell(22, 6, $userAmbilData['jumlah_buku'], 1, 0, 'C');
                $pdf->Cell(22, 6, $userAmbilData['stok'], 1, 0, 'C');
                $pdf->Cell(30, 6, $userAmbilData['tanggal_pinjam'], 1, 1, 'C');
            }
        }
    }

    $pdf->Output();
?>