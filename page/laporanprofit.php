<?PHP
	if(isset($_POST['cari_bahan'])){
		$tgl_awalpenjualan = $_POST['tgl_awalpenjualan'];
		if($tgl_awalpenjualan==""){
			$tgl_awalpenjualan = date("2010-01-01");
		}
		$tgl_akhirpenjualan = $_POST['tgl_akhirpenjualan'];
		if($tgl_akhirpenjualan==""){
			$tgl_akhirpenjualan = date("Y-m-d");
		}
	}else{
		$tgl_awalpenjualan = date("2010-01-01");
		$tgl_akhirpenjualan = date("Y-m-d");
	}
	
	$_SESSION['tgl_awalpenjualan'] = $tgl_awalpenjualan;
	$_SESSION['tgl_akhirpenjualan'] = $tgl_akhirpenjualan;
?>

<script src="php/datepicker/lib/zebra_datepicker.js"></script>
<link rel="stylesheet" href="php/datepicker/lib/css/default.css" />

<script type="text/javascript">
$(document).ready(function() {
		oTable = $('#table_penjualan').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		hidemsg();
		
		$('#tgl_awalpenjualan').Zebra_DatePicker({
//			direction:-1,
			format : 'Y-m-d',
            months : ['01','02','03','04','05','06','07','08','09','10','11','12'],
            days : ['Sun','Mon','Tue','Wed','Thur','Fri','Sat'],
            days_abbr : ['Sun','Mon','Tue','Wed','Thur','Fri','Sat'],
            show_icon : false
        });
		
		$('#tgl_akhirpenjualan').Zebra_DatePicker({
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
<h2>Halaman Laporan Data Penjualan</h2>

<div class="main-page">
	<div class="four-grids four-grids-custom">


<form action="" method="post"  enctype="multipart/form-data">
              <table style="width:100%" cellpadding="3" cellspacing="3">
             <tr><td>
                <div class="form-group">
                  <label class="control-label">Tanggal Awal Penjualan</label>
                  <input class="form-control readonly" name="tgl_awalpenjualan" id="tgl_awalpenjualan">
                </div>
             </td></tr>
             <tr><td>
                <div class="form-group">
                  <label class="control-label">Tanggal Akhir Penjualan</label>
                  <input class="form-control readonly" name="tgl_akhirpenjualan" id="tgl_akhirpenjualan">
                </div>
             </td></tr></table>
	<div class="form-group">
    	<input name="cari_bahan" type="submit" value="CARI" class="tambah_data btn btn-primary" />
        <a href="laporan/laporanprofit_pdf.php" target="_blank"><input name="print_bahan" type="button" value="PRINT" class="tambah_data btn btn-print-pdf" /></a>
        <input name="batal_data" type="reset" value="BATAL" class="batal_data btn btn-default"/>
    </div>
</form>  

<table width="100%" cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered table-hover" id="table_penjualan" align="center">
	<thead>
  <tr>
  		<td width="10%">No</td>
        <td>INVOICE</td>
        <td>ID Detail Penjualan</td>
        <td>Nama Menu</td>
        <td>Tanggal</td>
        <td>Qty</td>
        <td>Harga Pokok</td>
        <td>Harga Jual</td>
        <td>Keuntungan</td>
  </tr>
	</thead>
	<tbody>
<?PHP

$query = "select pb.*, dp.*, m.* from penjualan pb, detailpenjualan dp, menu m where dp.idmenu_detailpenjualan=m.id_menu and dp.id_detailpenjualan=pb.iddetailpenjualan_penjualan and dp.tgl_detailpenjualan BETWEEN '$tgl_awalpenjualan%' and '$tgl_akhirpenjualan%'";
		
$result = mysqli_query($id_mysql,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

$no = 1;		
while ($row = mysqli_fetch_array($result)){
	
	$id_penjualan = $row['id_penjualan'];	
	$id_detailpenjualan = $row['id_detailpenjualan'];
	$tgl_detailpenjualan = $row['tgl_detailpenjualan'];
	$qty_detailpenjualan = $row['qty_detailpenjualan'];
	$harga_detailpenjualan = $row['harga_detailpenjualan'];
	$nama_menu = $row['nama_menu'];
	$rc_menu = $row['rc_menu'];
	$gc_menu = $row['gc_menu'];
	$sc_menu = $row['sc_menu'];
	$hargapokok = round(($row['rc_menu'] + $row['sc_menu'] + $row['gc_menu'])) * $qty_detailpenjualan;
	
	$keuntungan = number_format($harga_detailpenjualan - $hargapokok);
	$hargajual_menu = number_format($harga_detailpenjualan);
	$hargapokok_menu = number_format($hargapokok);
	
print (" <tr align=\"center\">
<td>$no</td>
<td>$id_penjualan</td>
<td>$id_detailpenjualan</td>
<td>$nama_menu</td>
<td>$tgl_detailpenjualan</td>
<td>$qty_detailpenjualan</td>
<td>$hargapokok_menu</td>
<td>$hargajual_menu</td>
<td>$keuntungan</td>
</tr>

");
?>
<?php
$no++;
}
?>

	</tbody>
</table>
            <div class="clearfix"></div>
        </div>

	<div class="clearfix"> </div>
</div>

</div>