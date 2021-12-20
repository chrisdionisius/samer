<?php
session_start();
require('../fpdf17/fpdf.php');
require('../php/connect.php');
ini_set('max_execution_time', 300);
	
class PDF extends FPDF
{
function Header()
	{
		//Logo
		$this->Image('../images/logo.png', 15 , 3, 30, 20);
		//Arial bold 15
		$this->SetFont('Arial','B',15);
		//pindah ke posisi ke tengah untuk membuat judul
		$this->Cell(80);
		//judul
		$this->Cell(18,12,'Nota Pembelian',0,0,'C');
		//pindah baris
		$this->Ln(7);
		$this->SetFont('Arial','B',5);
		$this->Cell(80);
		//judul
		//$this->Cell(18,12,'Jln. Telagasari No H+3 - Ungasan, Kuta Selatan | Telp : 08970873532 | BBM : 5E9A4D0D | e-Mail : iConnectStore@outlook.com',0,0,'C');
		$this->Ln(36);
		//buat garis horisontal
		$this->Line(10,25,200,25);
	}
// Load data
function LoadData($file)
{
	// Read file lines
	$lines = file($file);
	$data = array();
	foreach($lines as $line)
		$data[] = explode(';',trim($line));
	return $data;
}
function LoadDataFromSQL($sql)
{
	$hasil=mysqli_query($id_mysql,$sql) or die(mysql_error());

	$data = array();
	while($rows=mysqli_fetch_array($hasil)){
		$data[] = $rows;

}
	return $data;
	


}


// Colored table
function FancyTable($header, $data){
$id_pembelian= json_decode(base64_decode($_GET['idp']));
$get_pembelian = mysqli_fetch_array(mysqli_query($id_mysql,"select id_pembelian from pembelian where id_pembelian ='$id_pembelian'"));
$date = date("Y-m-d");

				$this->setFont('arial','',9);	
				$this->text(12,32,'NO INVOICE','C');	
				$this->text(35,32,':','C');
				$this->text(38,32,$get_pembelian['id_pembelian'],'C');
				$this->text(12,37,'Tanggal Print','C');	
				$this->text(35,37,':','C');
				$this->text(38,37,$date,'C');
				$this->text(12,42,'Keterangan','C');	
				$this->text(35,42,':','C');
				$this->text(38,42,'-','C');
	
	// Colors, line width and bold font
	$this->SetFillColor(180,0,49);
	$this->SetTextColor(255);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.3);
	$this->SetFont('arial','',8);
	// Header
	$w = array( 8, 105, 39, 39);
	for($i=0;$i<count($header);$i++)
	
	$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	$this->Ln();
	// Color and font restoration
	$this->SetFillColor(204,200,201);
	$this->SetTextColor(0);
	$this->SetFont('');
	// Data
	$fill = false;
	$no=1;		
	foreach($data as $row)
	{
	
		$this->Cell($w[0],6,$no,'LR',0,'C',$fill);
		$this->Cell($w[1],6,$row[0],'LR',0,'L',$fill);
		$this->Cell($w[2],6,$row[1],'LR',0,'C',$fill);
		$this->Cell($w[3],6,number_format($row[2]),'LR',0,'C',$fill);
		$this->Ln();
		$fill = !$fill;
	$no++;
		
	
	}
	// Closing line
	
	$this->Cell(array_sum($w),0,'','T');
	$this->Ln();
	$this->setFont('arial','',10);	
	$a=100;
	$id_pembelian= json_decode(base64_decode($_GET['idp']));
	$query = mysqli_query($id_mysql,"SELECT * from pembelian where id_pembelian='$id_pembelian' ");
		
		$no = 1;
		$baris=1;
		while($r=mysqli_fetch_array($query)){
			$totalqty_pembelian = $r['totalqty_pembelian'];
			$totalharga_pembelian = number_format($r['totalharga_pembelian']);
		}
	
	$this->Cell($w[0],10,'','L',0,'C','');
	$this->Cell($w[1],10,'Total Qty :','',0,'R','');
	$this->Cell($w[2],10,$totalqty_pembelian,'',0,'C','');
	$this->Cell($w[3],10,'','',0,'C','');
	$this->Ln();
	$this->Cell($w[0],6,'','L',0,'C','');
	$this->Cell($w[1],6,'','',0,'C','');
	$this->Cell($w[2],6,'Total','',0,'R','2223344');
	$this->Cell($w[3],6,"IDR. ".$totalharga_pembelian,'R',0,'L','2223344');
	$this->Cell(-190,20,'','T');
}

function Footer()
	{
		//atur posisi 1.5 cm dari bawah
		$this->SetY(-15);
		//buat garis horizontal
		$this->Line(10,$this->GetY(),200,$this->GetY());
		//Arial italic 9
		$this->SetFont('Arial','I',9);
		//nomor halaman
		$this->Cell(0,10,'Halaman '.$this->PageNo().' dari {nb}',0,0,'R');
	}
}


$pdf = new PDF('P','mm','A4');
// Column headings
$header = array('No', ' Nama Bahan', 'Qty(grm)', 'Harga');
// Data loading
$id_pembelian= json_decode(base64_decode($_GET['idp']));
$getiddetailpembelian_pembelian = mysqli_fetch_array(mysqli_query($id_mysql,"select iddetailpembelian_pembelian from pembelian where id_pembelian ='$id_pembelian'"));
$id_detailpembelian = $getiddetailpembelian_pembelian['iddetailpembelian_pembelian'];
$query="SELECT b.nama_bahan, db.qty_detailpembelian, db.harga_detailpembelian from bahan b, detailpembelian db where b.id_bahan=db.idbahan_detailpembelian and db.id_detailpembelian='$id_detailpembelian'" ;
 
$data = $pdf->LoadDataFromSQL($query);
$pdf->SetFont('Arial','',8);
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->FancyTable($header,$data);
$pdf->Output();
?>