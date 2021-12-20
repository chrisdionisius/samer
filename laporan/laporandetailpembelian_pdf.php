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
		$this->Image('../images/logo.png', 15 , 3, 40, 20);
		//Arial bold 15
		$this->SetFont('Arial','B',15);
		//pindah ke posisi ke tengah untuk membuat judul
		$this->Cell(80);
		//judul
		$this->Cell(130,12,'LAPORAN DETAIL PEMBELIAN',0,0,'C');
		//pindah baris
		$this->Ln(32);
		//buat garis horisontal
		$this->Line(10,25,280,25);
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
function FancyTable($header, $data)
{
$tgl_detailpembelianawalcr = $_SESSION['tgl_detailpembelianawalcr'];
$tgl_detailpembelianakhircr = $_SESSION['tgl_detailpembelianakhircr'];
if($tgl_detailpembelianawalcr==""){
	$tgl_detailpembelianawalcr = date("2010-01-01");
}
if($tgl_detailpembelianakhircr ==""){
	$tgl_detailpembelianakhircr  = date("Y-m-d");
}
$date = date("Y-m-d");

	$this->setFont('arial','',9);	
				$this->text(12,32,'Periode','C');	
				$this->text(38,32,':','C');
				$this->text(41,32, $tgl_detailpembelianawalcr." s/d ".$tgl_detailpembelianakhircr,'C');

	// Colors, line width and bold font
	$this->SetFillColor(180,0,49);
	$this->SetTextColor(255);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.3);
	$this->SetFont('','');
	// Header
	$w = array( 10, 40, 40, 83, 40, 30, 30);
	for($i=0;$i<count($header);$i++)
	
		$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	$this->Ln();
	// Color and font restoration
	$this->SetFillColor(204,200,201);
	$this->SetTextColor(0);
	$this->SetFont('arial','',7);
	// Data
	$fill = false;
	$no=1;
	$total_qty=0;
	$total_harga=0;
	foreach($data as $row)
	{
	
		$this->Cell($w[0],6,$no,'LR',0,'C',$fill);
		$this->Cell($w[1],6,$row[0],'LR',0,'L',$fill);
		$this->Cell($w[2],6,$row[1],'LR',0,'L',$fill);
		$this->Cell($w[3],6,$row[2],'LR',0,'L',$fill);
        $this->Cell($w[4],6,$row[3],'LR',0,'C',$fill);
		$this->Cell($w[5],6,$row[4],'LR',0,'C',$fill);
		$this->Cell($w[6],6,number_format($row[5]),'LR',0,'C',$fill);
		
		$total_qty = $total_qty + $row[4];
		$total_harga = $total_harga + $row[5];
		
		$this->Ln();
		$fill = !$fill;
	$no++;
		
	
	}
	// Closing line
	$this->Cell(array_sum($w),0,'','T');
    $this->Ln();
	$this->setFont('arial','',7);	
	$a=110;
	$this->Ln();

	$this->Cell($w[0],6,'','L',0,'C','');
	$this->Cell($w[1],6,'','',0,'C','');
	$this->Cell($w[2],6,'','',0,'C','');
	$this->Cell($w[3],6,'','',0,'R','');
	$this->Cell($w[4],6,'TOTAL : ','',0,'R','');
    $this->Cell($w[5],6,number_format($total_qty)."(grm)",'RL',0,'C','');
	$this->Cell($w[6],6,'Rp. ' .number_format($total_harga),'RL',0,'C','');
	$this->Cell(30,6,'','TR',0,'L','');


	$this->Ln();
	$this->Cell(273,6,'','LR',0,'L','2223344');
	$this->Cell(-273,20,'','T');
		
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


$pdf = new PDF('L','mm','A4');
// Column headings
$header = array('No', 'INVOICE', ' ID Detail Pembelian', 'Nama Bahan ', 'Tgl Pembelian', 'Qty(grm)', 'Harga');
// Data loading

$id_pembeliancr = $_SESSION['id_pembelian'];
$nama_bahancr = $_SESSION['nama_bahan'];
$tgl_detailpembelianawalcr = $_SESSION['tgl_detailpembelianawalcr'];
$tgl_detailpembelianakhircr = $_SESSION['tgl_detailpembelianakhircr'];
if($tgl_detailpembelianawalcr==""){
	$tgl_detailpembelianawalcr = date("2010-01-01");
}
if($tgl_detailpembelianakhircr ==""){
	$tgl_detailpembelianakhircr  = date("Y-m-d");
}

$query="select pb.id_pembelian, dp.id_detailpembelian, b.nama_bahan, dp.tgl_detailpembelian, dp.qty_detailpembelian, dp.harga_detailpembelian from pembelian pb, detailpembelian dp, bahan b where dp.idbahan_detailpembelian=b.id_bahan and dp.id_detailpembelian=pb.iddetailpembelian_pembelian and pb.id_pembelian LIKE '%$id_pembeliancr%' and b.nama_bahan LIKE '%$nama_bahancr%' and dp.tgl_detailpembelian BETWEEN '$tgl_detailpembelianawalcr%' and '$tgl_detailpembelianakhircr%'";
 
$data = $pdf->LoadDataFromSQL($query);
$pdf->SetFont('Arial','',8);
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->FancyTable($header,$data);
$pdf->Output();
?>