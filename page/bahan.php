<?PHP
$id_bahan = "";

if(isset($_POST['simpan_bahan'])){
	$id_bahan = "\\//";
	$nama_bahan = $_POST['nama_bahan'];
	$harga_bahan = str_replace(",", "",$_POST['harga_bahan']);
	$query_bahan = "INSERT INTO bahan(nama_bahan, harga_bahan, stockawal_bahan, stocksisa_bahan, stockjual_bahan) VALUES ('$nama_bahan', '$harga_bahan',  '0',  '0',  '0')";
}

if(isset($_POST['ubah_bahan'])){
	$id_bahan = $_POST['id_bahan'];
	$nama_bahan = $_POST['nama_bahan'];
	$harga_bahan = str_replace(",", "",$_POST['harga_bahan']);
	$query_bahan = "UPDATE bahan SET nama_bahan='$nama_bahan', harga_bahan='$harga_bahan' WHERE id_bahan='$id_bahan'";
}

if($id_bahan!=""){
	if(CheckKey("SELECT id_bahan from bahan where nama_bahan='$nama_bahan' and id_bahan!='$id_bahan'")==true){
		$msg= "<label style='color:#C00'> Data Bahan Makanan Sudah Terdaftar Dalam Database </label>";
	}else{
		$input_bahan = mysqli_query($id_mysql,$query_bahan);
		if($input_bahan){
			$msg= "<label> Data Bahan Makanan Berhasil Diupdate </label>";
		}else{
			$msg= "<label style='color:#C00'>  Data Bahan Makanan Gagal Diupdate </label>";
		}
	}
}
?>

<script type="text/javascript">
$(document).ready(function() {
		oTable = $('#table_bahan').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		hidemsg();
});


function edit_bahan(id_bahan, nama_bahan, harga_bahan){
	document.getElementById('id_bahan').value = id_bahan;
	document.getElementById('nama_bahan').value = nama_bahan;
	document.getElementById('harga_bahan').value = formatAngka2(harga_bahan);
};

</script>

<div class="form-section">
<h2>Halaman Data Bahan Makanan</h2>

<div class="main-page">
	<div class="four-grids four-grids-custom">

<div id="pesan" style="height:30px"><center><?php echo $msg; ?></center></div>

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
                  <input class="form-control" name="nama_bahan" id="nama_bahan" required>
                </div>
             </td></tr>
            <tr><td>
                <div class="form-group">
                  <label class="control-label">Harga/1000gr</label>
                  <input class="form-control" name="harga_bahan" id="harga_bahan" onkeypress="return goodchars(event,'0123456789',this);" onKeyUp="formatAngka(this, ',')" required>
                </div>
             </td></tr></table>
	<div class="form-group">
    	<input name="simpan_bahan" type="submit" value="SIMPAN" class="tambah_data btn btn-primary" />
        <input name="reset_data" type="reset" value="RESET" class="reset_data btn btn-default" />
        <input name="ubah_bahan" type="submit" value="UBAH" class="ubah_data btn btn-primary" hidden/>
        <input name="batal_data" type="reset" value="BATAL" class="batal_data btn btn-default" onclick="batal();" hidden/>
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
        <td width="10%">Pilihan</td> 
  </tr>
	</thead>
	<tbody>
<?PHP

$query = "select * from bahan";


$result = mysqli_query($id_mysql,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

$no = 1;		
while ($row = mysqli_fetch_array($result)){
	$id_bahan=$row['id_bahan'];
	$nama_bahan = $row['nama_bahan'];
	$harga_bahan = $row['harga_bahan'];
	$stocksisa_bahan = $row['stocksisa_bahan'];
	$harga = number_format($harga_bahan);
	
print (" <tr align=\"center\">
<td>$no</td>
<td hidden>$id_bahan</td>
<td>$nama_bahan</td>
<td>$harga</td>
<td>$stocksisa_bahan</td>
<td width=\"10%\"><a href=\"#\"><img src=\"images/edit.png\" style=\"width:20px; height:20px;\" onclick=\"edit_bahan('$id_bahan', '$nama_bahan', '$harga_bahan'); ubah();\" \></a></td>
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