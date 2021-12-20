<?PHP
	if(isset($_POST['cari_bahan'])){
		$id_pembeliancr = $_POST['id_pembelian'];
		$nama_bahancr = $_POST['nama_bahan'];
		$tgl_detailpembelianawalcr = $_POST['tgl_detailpembelianawalcr'];
		if($tgl_detailpembelianawalcr==""){
			$tgl_detailpembelianawalcr = date("2010-01-01");
		}
		$tgl_detailpembelianakhircr = $_POST['tgl_detailpembelianakhircr'];
		if($tgl_detailpembelianakhircr ==""){
			$tgl_detailpembelianakhircr  = date("Y-m-d");
		}
	}else{
		$id_pembeliancr = "";
		$nama_bahancr = "";
		$tgl_detailpembelianawalcr = date("2010-01-01");
		$tgl_detailpembelianakhircr = date("Y-m-d");
	}
	
	$_SESSION['id_pembelian'] = $id_pembeliancr;
	$_SESSION['nama_bahan'] = $nama_bahancr;
	$_SESSION['tgl_detailpembelianawalcr'] = $tgl_detailpembelianawalcr;
	$_SESSION['tgl_detailpembelianakhircr'] = $tgl_detailpembelianakhircr;
?>

<script src="php/datepicker/lib/zebra_datepicker.js"></script>
<link rel="stylesheet" href="php/datepicker/lib/css/default.css" />

<script type="text/javascript">
$(document).ready(function() {
		oTable = $('#table_pembelian').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		hidemsg();
		
	$('#tgl_detailpembelianawalcr').Zebra_DatePicker({
//			direction:-1,
			format : 'Y-m-d',
            months : ['01','02','03','04','05','06','07','08','09','10','11','12'],
            days : ['Sun','Mon','Tue','Wed','Thur','Fri','Sat'],
            days_abbr : ['Sun','Mon','Tue','Wed','Thur','Fri','Sat'],
            show_icon : false
        });


	$('#tgl_detailpembelianakhircr').Zebra_DatePicker({
//			direction:-1,
			format : 'Y-m-d',
            months : ['01','02','03','04','05','06','07','08','09','10','11','12'],
            days : ['Sun','Mon','Tue','Wed','Thur','Fri','Sat'],
            days_abbr : ['Sun','Mon','Tue','Wed','Thur','Fri','Sat'],
            show_icon : false
        });	
		
		$(".readonly").keydown(function(e){
			e.preventDefault();
		});
		
		$(".readonly").attr('required', false);
});
</script>

<div class="form-section">
<h2>Halaman Laporan Data Pembelian</h2>

<div class="main-page">
	<div class="four-grids four-grids-custom">


<form action="" method="post"  enctype="multipart/form-data">
              <table style="width:100%" cellpadding="3" cellspacing="3">
              <tr><td>
                <div class="form-group">
                  <label class="control-label">No Invoice</label>
                  <input class="form-control" name="id_pembelian" id="id_pembelian">
                </div>
             </td></tr>
             <tr><td>
                <div class="form-group">
                  <label class="control-label">Nama Bahan</label>
                  <input class="form-control" name="nama_bahan" id="nama_bahan">
                </div>
             </td></tr>
             <tr><td>
                <div class="form-group">
                  <label class="control-label">Tanggal Awal Pembelian</label>
                  <input class="form-control readonly" name="tgl_detailpembelianawalcr" id="tgl_detailpembelianawalcr">
                </div>
             </td></tr>
	<tr><td>
                <div class="form-group">
                  <label class="control-label">Tanggal Akhir Pembelian</label>
                  <input class="form-control readonly" name="tgl_detailpembelianakhircr" id="tgl_detailpembelianakhircr">
                </div>
             </td></tr></table>
	<div class="form-group">
    	<input name="cari_bahan" type="submit" value="CARI" class="tambah_data btn btn-primary" />
        <a href="laporan/laporandetailpembelian_pdf.php" target="_blank"><input name="print_bahan" type="button" value="PRINT" class="tambah_data btn btn-print-pdf" /></a>
        <input name="batal_data" type="reset" value="BATAL" class="batal_data btn btn-default"/>
    </div>
</form>  

<table width="100%" cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered table-hover" id="table_pembelian" align="center">
	<thead>
  <tr>
  		<td width="10%">No</td>
        <td>INVOICE</td>
        <td>ID Detail Pembelian</td>
        <td>Nama Bahan</td>
        <td>Tanggal</td>
        <td>Qty(grm)</td>
        <td>Harga</td>
  </tr>
	</thead>
	<tbody>
<?PHP

$query = "select pb.*, dp.*, b.nama_bahan from pembelian pb, detailpembelian dp, bahan b where dp.idbahan_detailpembelian=b.id_bahan and dp.id_detailpembelian=pb.iddetailpembelian_pembelian and pb.id_pembelian LIKE '%$id_pembeliancr%' and b.nama_bahan LIKE '%$nama_bahancr%' and dp.tgl_detailpembelian BETWEEN '$tgl_detailpembelianawalcr%' and '$tgl_detailpembelianakhircr%'";
		
$result = mysqli_query($id_mysql,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

$no = 1;		
while ($row = mysqli_fetch_array($result)){
	
	$id_pembelian = $row['id_pembelian'];	
	$id_detailpembelian = $row['id_detailpembelian'];
	$tgl_detailpembelian = $row['tgl_detailpembelian'];
	$qty_detailpembelian = $row['qty_detailpembelian'];
	$harga_detailpembelian = number_format($row['harga_detailpembelian']);
	$nama_bahan = $row['nama_bahan'];
	
print (" <tr align=\"center\">
<td>$no</td>
<td>$id_pembelian</td>
<td>$id_detailpembelian</td>
<td>$nama_bahan</td>
<td>$tgl_detailpembelian</td>
<td>$qty_detailpembelian</td>
<td>$harga_detailpembelian</td>
</tr>

");
?>
<?php
$no++;
}
?>

	</tbody>
</table>

			<div class="form-group">
            <a href="halaman.php?tag=laporanpembelian"><label style="float:right; cursor:pointer;">Laporan Pembelian</label></a>
            </div>

            <div class="clearfix"></div>
        </div>

	<div class="clearfix"> </div>
</div>

</div>