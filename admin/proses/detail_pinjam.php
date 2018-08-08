<?php
	include '../confiq.php';
	include '../session.php';
	// memanggil library FPDF
	require('libraryPDF/fpdf.php');
	// intance object dan memberikan pengaturan halaman PDF
	$pdf = new FPDF('l','mm','A5');
	// membuat halaman baru
	$pdf->AddPage();
	// setting jenis font yang akan digunakan
	$pdf->SetFont('Arial','B',16);
	// mencetak string 
	$pdf->Cell(190,7,'BUKTI PEMINJAMAN BUKU SIE-LI',0,1,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(190,7,'PERPUSTAKAAN ONLINE',0,1,'C');
	 
	// Memberikan space kebawah agar tidak terlalu rapat
	$pdf->Cell(10,7,'',0,1);
	 
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(22,6,'NO PINJAM',1,0);
	$pdf->Cell(55,6,'NAMA ANGGOTA',1,0);
	$pdf->Cell(40,6,'BUKU',1,0);
	$pdf->Cell(40,6,'TANGGAL KEMBALI',1,0);
	$pdf->Cell(20,6,'DESC',1,1);
	 
	$pdf->SetFont('Arial','',10);
	
	if(empty($_GET['id'])){
		header('location:../index.php');
	}else{
		$id = $_GET['id'];
	}
	$sql = "
		SELECT tbpinjam.NoPinjam,
                  tbanggota.Nama,
                  tbbuku.JudulBuku,
                  tbpinjam.TglKembali,
                  tbpinjam.Deskripsi
          FROM tbpinjam 
          INNER JOIN tbanggota ON tbpinjam.IdAnggota = tbanggota.IdAnggota 
          INNER JOIN tbbuku ON tbpinjam.KdBuku = tbbuku.KdBuku WHERE tbpinjam.NoPinjam = '$id'
	";
	$query = $conn->query($sql);
	while ($row = $query->fetch_array()){
	    $pdf->Cell(22,6,$row['NoPinjam'],1,0);
	    $pdf->Cell(55,6,$row['Nama'],1,0);
	    $pdf->Cell(40,6,$row['JudulBuku'],1,0);
	    $pdf->Cell(40,6,$row['TglKembali'],1,0); 
	    $pdf->Cell(20,6,$row['Deskripsi'],1,1);
	}

	$date = date('d-m-Y');

	$pdf->Cell(10,20,'',0,1);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(190,7,'Denpasar, '.$date,0,1);

	$pdf->Cell(10,25,'',0,1);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(190,7,'( '.$NamaAdmin.' )',0,1);
	 
	$pdf->Output();
?>