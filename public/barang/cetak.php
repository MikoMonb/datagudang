<?php  
	include_once("../../config/koneksi.php");
	require("../../library/fpdf.php");

	$pdf = new FPDF('L', 'mm', 'A4');
	$pdf->AddPage();

	$pdf->SetFont('Times', 'B', 13);
	$pdf->Cell(0, 15, '', 0, 1);
	$pdf->Cell(250, 10, 'Data Barang', 0, 0, 'R');

	$pdf->Cell(10, 17, '', 0, 1);	
	$pdf->SetFont('Times', 'B', 9);
	$pdf->Cell(30, 7, 'ID Barang', 1, 0, 'C');
	$pdf->Cell(120, 7, 'Nama Barang', 1, 0, 'C');
	$pdf->Cell(60, 7, 'Nama Supplier', 1, 0, 'C');
	$pdf->Cell(40, 7, 'Kode Barang', 1, 0, 'C');

	$pdf->Cell(10, 7, '', 0, 1);
	$pdf->SetFont('Times', '', 10);

	$no = 1;
	$data = mysqli_query($kon, "SELECT * FROM barang ORDER BY id_barang ASC");

	while ($d = mysqli_fetch_array($data)) {
        $pdf->Cell(30, 6, $d['id_barang'], 1, 0, 'C');
		$pdf->Cell(120, 6, $d['nama_barang'], 1, 0, 'C');
		$pdf->Cell(60, 6, $d['nama_supplier'], 1, 0, 'C');
		$pdf->Cell(40, 6, $d['kode_barang'], 1, 0, 'C');
        $pdf->Ln();
	}

	$pdf->Output();
?>