<script type="text/javascript">
$(document).ready(function() {
		oTable = $('#table_pembelian').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		hidemsg();
});
</script>

<div class="form-section">
<h2>Halaman Laporan Data Pembelian</h2>

<div class="main-page">
	<div class="four-grids four-grids-custom">

<table width="100%" cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered table-hover" id="table_pembelian" align="center">
	<thead>
  <tr>
  		<td width="10%">No</td>
        <td>INVOICE</td>
        <td>ID Detail Pembelian</td>
        <td>Tanggal</td>
        <td>Total Qty</td>
        <td>Total Harga</td>
        <td>Pilihan</td>
  </tr>
	</thead>
	<tbody>
<?PHP

$query = "select * from pembelian";


$result = mysqli_query($id_mysql,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

$no = 1;		
while ($row = mysqli_fetch_array($result)){
	$id_pembelian=$row['id_pembelian'];
	$iddetailpembelian_pembelian = $row['iddetailpembelian_pembelian'];
	$tgl_pembelian = $row['tgl_pembelian'];
	$totalqty_pembelian = $row['totalqty_pembelian'];
	$totalharga_pembelian = number_format($row['totalharga_pembelian']);
	$arg = base64_encode(json_encode($id_pembelian));
	
print (" <tr align=\"center\">
<td>$no</td>
<td>$id_pembelian</td>
<td>$iddetailpembelian_pembelian</td>
<td>$tgl_pembelian</td>
<td>$totalqty_pembelian</td>
<td>$totalharga_pembelian</td>
<td width=\"10%\"><a href=\"laporan/laporanpembelian_pdf.php?idp=$arg\" target=\"_blank\"><img src=\"images/print.png\" style=\"width:20px; height:20px;\"\" \></a></td>
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
            <a href="halaman.php?tag=laporandetailpembelian"><label style="float:right; cursor:pointer;">Laporan Detail Pembelian</label></a>
            </div>

            <div class="clearfix"></div>
        </div>

	<div class="clearfix"> </div>
</div>

</div>