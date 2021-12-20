<script type="text/javascript">
$(document).ready(function() {
		oTable = $('#table_penjualan').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		hidemsg();
});
</script>

<div class="form-section">
<h2>Halaman Laporan Data Penjualan</h2>

<div class="main-page">
	<div class="four-grids four-grids-custom">

<table width="100%" cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered table-hover" id="table_penjualan" align="center">
	<thead>
  <tr>
  		<td width="10%">No</td>
        <td>INVOICE</td>
        <td>ID Detail Penjualan</td>
        <td>Tanggal</td>
        <td>Total Qty</td>
        <td>Total Harga</td>
        <td>Pilihan</td>
  </tr>
	</thead>
	<tbody>
<?PHP

$query = "select * from penjualan";


$result = mysqli_query($id_mysql,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

$no = 1;		
while ($row = mysqli_fetch_array($result)){
	$id_penjualan=$row['id_penjualan'];
	$iddetailpenjualan_penjualan = $row['iddetailpenjualan_penjualan'];
	$tgl_penjualan = $row['tgl_penjualan'];
	$totalqty_penjualan = $row['totalqty_penjualan'];
	$totalharga_penjualan = number_format($row['totalharga_penjualan']);
	$arg = base64_encode(json_encode($id_penjualan));
	
print (" <tr align=\"center\">
<td>$no</td>
<td>$id_penjualan</td>
<td>$iddetailpenjualan_penjualan</td>
<td>$tgl_penjualan</td>
<td>$totalqty_penjualan</td>
<td>$totalharga_penjualan</td>
<td width=\"10%\"><a href=\"laporan/laporanpenjualan_pdf.php?idp=$arg\" target=\"_blank\"><img src=\"images/print.png\" style=\"width:20px; height:20px;\"\" \></a></td>
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
            <a href="halaman.php?tag=laporandetailpenjualan"><label style="float:right; cursor:pointer;">Laporan Detail Penjualan</label></a>
            </div>

            <div class="clearfix"></div>
        </div>

	<div class="clearfix"> </div>
</div>

</div>