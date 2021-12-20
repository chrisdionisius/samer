<?php
session_start();
include "../php/connect.php";

$awalperiode_analisis = $_SESSION['awalperiode_analisis'];
$akhirperiode_analisis = $_SESSION['akhirperiode_analisis'];
$nama_menu = $_SESSION['nama_menu'];
$klasifikasi_mm = $_SESSION['klasifikasi_mm'];
$klasifikasi_cm = $_SESSION['klasifikasi_cm'];

$mmratemasing = $_SESSION['mmratemasing'];
$hargajual_menumasing = $_SESSION['hargajual_menumasing'];
$hargapokok_menumasing = $_SESSION['hargapokok_menumasing'];
$cm_menumasing = $_SESSION['cm_menumasing'];
			
$mm_menumasing = $_SESSION['mm_menumasing'];
$totalhargajualmasing = $_SESSION['totalhargajualmasing'];
$totalhargapokokmasing = $_SESSION['totalhargapokokmasing'];
$totalcmmasing = $_SESSION['totalcmmasing'];

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
    $pdf->Cell(0,1,"LAPORAN ANALISIS DATA MENU",0,0,'C');
	$pdf->Line(20,2.4,1,2.4);
	$pdf->Ln(3);
	$pdf->setFont('arial','',9);
	
				
	$pdf->text(14,3,"Periode",'C');	
	$pdf->text(15.5,3,':','C');
	$pdf->text(16,3, $awalperiode_analisis." s/d ".$akhirperiode_analisis ,'C');
				
	$pdf->SetFont('arial','',9);
	$pdf->SetWidths(array( 1, 7, 2.75, 2.75, 2.75, 2.75));
	$pdf->SetHeight(0.1);
	$pdf->SetFillColor(10,120,160);
	$pdf->SetTextColor(255);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Row2(array("No.", "Nama Menu", "Harga Jual", "MM", "MM%", "Klasifikasi MM"));
		
	$no = 1;
	$arrlength = count($nama_menu);
	for($x = 0; $x < $arrlength; $x++) {
		
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->SetDrawColor(1,1,1);	
		$pdf->SetFont('times','',9);
		$pdf->Row2(array($no, $nama_menu[$x], $hargajual_menumasing[$x], $mm_menumasing[$x], $mmratemasing[$x], $klasifikasi_mm[$x]));
		$no++;
	}
		
	$pdf->Ln();
	
	
	//Tabel Baru
	$pdf->SetFont('arial','',9);
	$pdf->SetWidths(array( 1, 2.1, 2, 2, 1.3, 1.3, 2.5, 2.5, 2, 2.3));
	$pdf->SetHeight(0.1);
	$pdf->SetFillColor(10,120,160);
	$pdf->SetTextColor(255);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Row2(array("No.", "Nama Menu", "H. Jual", "H. Pokok", "CM", "MM", "Total H. Jual", "Total H. Pokok", "T. CM", "Klasifikasi CM"));
		
	$no = 1;
	$arrlength = count($nama_menu);
	for($x = 0; $x < $arrlength; $x++) {
		
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->SetDrawColor(1,1,1);	
		$pdf->SetFont('times','',9);
		$pdf->Row2(array($no, $nama_menu[$x], $hargajual_menumasing[$x], $hargapokok_menumasing[$x], $cm_menumasing[$x], $mm_menumasing[$x], $totalhargajualmasing[$x], $totalhargapokokmasing[$x], $totalcmmasing[$x], $klasifikasi_cm[$x]));
		$no++;
	}
		
	$pdf->Ln();
	
	//Tabel Baru
	$pdf->SetFont('arial','',9);
	$pdf->SetWidths(array( 1, 7, 4, 3, 4));
	$pdf->SetHeight(0.1);
	$pdf->SetFillColor(10,120,160);
	$pdf->SetTextColor(255);
	$pdf->SetDrawColor(0,0,0);
	$pdf->Row2(array("No.", "Nama Menu", "Klasifikasi MM", "Klasifikasi CM", "Kategori"));
		
	$no = 1;
	$arrlength = count($nama_menu);
	for($x = 0; $x < $arrlength; $x++) {
		
		if($klasifikasi_mm[$x]=="H" and $klasifikasi_cm[$x]=="H"){
			$kategori_menu = "Star/Bintang";
		}
		if($klasifikasi_mm[$x]=="H" and $klasifikasi_cm[$x]=="L"){
			$kategori_menu = "Plow Horse/Kuda Bajak";
		}
		if($klasifikasi_mm[$x]=="L" and $klasifikasi_cm[$x]=="H"){
			$kategori_menu = "Puzzle/Teka Teki";
		}
		if($klasifikasi_mm[$x]=="L" and $klasifikasi_cm[$x]=="L"){
			$kategori_menu = "Dog/Anjing";
		}
				
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->SetDrawColor(1,1,1);	
		$pdf->SetFont('times','',9);
		$pdf->Row2(array($no, $nama_menu[$x], $klasifikasi_mm[$x], $klasifikasi_cm[$x], $kategori_menu));
		$no++;
	}
	
	$pdf->Ln();
		
	$pdf->SetFont('arial','B',9);
	$pdf->SetWidths(array( 19));
	$pdf->SetHeight(0.1);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(255, 255, 255);
	$pdf->Row(array("Pengertian Kategori Menu :"));
		
	$pdf->SetFont('arial','',9);
	$pdf->SetWidths(array( 19));
	$pdf->SetHeight(0.1);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(255, 255, 255);
	$pdf->Row(array("1. Star : Dipertahankan, jenis menu ini agar dipertahankan dengan baik kualitas maupun harga jualnya."));
		
	$pdf->SetFont('arial','',9);
	$pdf->SetWidths(array( 19));
	$pdf->SetHeight(0.1);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(255, 255, 255);
	$pdf->Row(array("2. Plow Horse : Ditinjau dari harganya, jenis makanan ini perlu ditinjau lagi harga jualnya dengan food costnya."));
	
	$pdf->SetFont('arial','',9);
	$pdf->SetWidths(array( 19));
	$pdf->SetHeight(0.1);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(255, 255, 255);
	$pdf->Row(array("3. Puzzle : Disusun kembali, menu diletakkan kembali pada posisi yang lebih strategis."));
	
	$pdf->SetFont('arial','',9);
	$pdf->SetWidths(array( 19));
	$pdf->SetHeight(0.1);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0);
	$pdf->SetDrawColor(255, 255, 255);
	$pdf->Row(array("4. Dog : Diganti atau dihapus, jenis menu ini perlu dipertimbangkan untuk diganti dengan menu yang baru."));
	
		
	$pdf->Ln();
$pdf->Cell(19,1,'','T');
$pdf->Ln(1);
$pdf->SetFont('arial','',9.5);
	
	
	$pdf->Output();

?>