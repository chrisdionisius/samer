<?PHP
	if(isset($_POST['cari_bahan'])){
		$nama_bahancr = $_POST['nama_bahan'];
		$status_bahancr = $_POST['status_bahan'];
		if($status_bahancr!=""){
			$cari_bahancr = " and stocksisa_bahan".$status_bahancr;
		}else{
			$cari_bahancr = "";
		}
	}else{
		$nama_bahancr = "";
		$cari_bahancr = "";
	}
	
	$_SESSION['nama_bahancr'] = $nama_bahancr;
	$_SESSION['cari_bahancr'] = $cari_bahancr;
?>

<script type="text/javascript">
$(document).ready(function() {
		oTable = $('#table_bahan').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		hidemsg();
});
</script>

<div class="form-section">
<h2>Halaman Laporan Data Bahan Makanan</h2>

<div class="main-page">
	<div class="four-grids four-grids-custom">

<form action="" method="post"  enctype="multipart/form-data">
              <table style="width:100%" cellpadding="3" cellspacing="3">
              <tr><td>
                <div class="form-group" hidden>
                  <label class="control-label">ID</label>
                  <input class="form-control" name="id_bahan" id="id_bahan">
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
                  <label class="control-label">Status Stock</label>
                  <select name="status_bahan" id="status_bahan" class="form-control">
                  	<option value="">------Pilih Status Bahan------</option>
                    <option value=">0">Tersedia</option>
                    <option value="=0">Habis</option>
                  </select>
                </div>
             </td></tr></table>
	<div class="form-group">
    	<input name="cari_bahan" type="submit" value="CARI" class="tambah_data btn btn-primary" />
        <a href="laporan/laporanbahan_pdf.php" target="_blank"><input name="print_bahan" type="button" value="PRINT" class="tambah_data btn btn-print-pdf" /></a>
        <input name="batal_data" type="reset" value="BATAL" class="batal_data btn btn-default"/>
    </div>
</form>      

<table width="100%" cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered table-hover" id="table_bahan" align="center">
	<thead>
  <tr>
  		<td width="10%">No</td>
        <td hidden>ID</td>
        <td>Nama Bahan</td>
        <td>Harga/1000gr</td>
        <td>Stock(grm)</td>
  </tr>
	</thead>
	<tbody>
<?PHP

$query = "select * from bahan where nama_bahan LIKE '%$nama_bahancr%' $cari_bahancr";


$result = mysqli_query($id_mysql,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

$no = 1;		
while ($row = mysqli_fetch_array($result)){
	$id_bahan=$row['id_bahan'];
	$nama_bahan = $row['nama_bahan'];
	$harga_bahan = number_format($row['harga_bahan']);
	$stocksisa_bahan = $row['stocksisa_bahan'];
	
print (" <tr align=\"center\">
<td>$no</td>
<td hidden>$id_bahan</td>
<td>$nama_bahan</td>
<td>$harga_bahan</td>
<td>$stocksisa_bahan</td>
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