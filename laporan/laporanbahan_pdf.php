<?php
session_start();
include "../php/connect.php";

$nama_bahancr = $_SESSION['nama_bahancr'];
$cari_bahancr = $_SESSION['cari_bahancr'];

	$tgl = date("d-m-Y");

	//define('FPDF_FONTPATH', 'fpdf/font/');
	require('../fpdf17/mc_table.php');
	require('../php/connect.php');
	$pdf=new PDF_MC_Table('P','cm',"a4");
	$pdf->Open();
	$pdf->AddPage();
	$pdf->AliasNbPages();
	$pdf->Image('../images/logo.png',1.3,0.5,3,1.6);
	$pdf->SetMargins(1,1,1.2,1);
	$pdf->SetFont('arial','B',15);
    $pdf->Cell(0,1,"LAPORAN DATA BAHAN MAKANAN",0,0,'C');
	$pdf->Line(20,2.4,1,2.4);
	$pdf->Ln(3);
	$pdf->setFont('arial','',9);
	
				
	$pdf->text(15,3,"Tanggal Print",'C');	
	$pdf->text(17.3,3,':','C');
	$pdf->text(17.5,3, $tgl ,'C');
				
	$pdf->SetFont('arial','',9);
	$pdf->SetWidths(array( 1, 7, 4, 3, 4));
	$pdf->SetHeight(0.1);
	$pdf->SetFillColor(180,0,49);
	$pdf->SetTextColor(255);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Row2(array("No.", "Nama Bahan", "Harga/1000grm", "Stock Sisa(grm)", "Remark"));
		
	$s="172.13.0.2";
	$u="root";
	$p="root";
	$ids_mysql=mysqli_connect ($s, $u, $p);
$query = "select * from bahan where nama_bahan LIKE '%$nama_bahancr%' $cari_bahancr";
$result = mysqli_query($ids_mysql,$query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

$no = 1;
while ($row = mysqli_fetch_array($result)){
	$id_bahan=$row['id_bahan'];
	$nama_bahan = $row['nama_bahan'];
	$harga_bahan = number_format($row['harga_bahan']);
	$stocksisa_bahan = $row['stocksisa_bahan'];

	$pdf->SetFillColor(255,255,255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(1,1,1);	
	$pdf->SetFont('times','',9);
	$pdf->Row2(array($no, $nama_bahan, $harga_bahan, number_format($stocksisa_bahan), ""));
	$no++;
}

	
	$pdf->Ln();
$pdf->Cell(19,1,'','T');
$pdf->Ln(1);
$pdf->SetFont('arial','',9.5);
	

$pdf->Ln(); 
	$pdf->Cell(12,-1,'                          ','',0,'L','');
	$pdf->Cell(1,-1,'                          Operator','',0,'L','');
$pdf->Ln(1); 
	$pdf->Cell(12.4,1,'              ','',0,'L','');
	$pdf->Cell(1,1,'              (....................................)','',0,'L','');

	
	$pdf->Output();

?>