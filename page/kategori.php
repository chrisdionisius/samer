<?PHP

$id_kategori = "";

if (isset($_POST['simpan_kategori'])) {
	$id_kategori = "\\//";
	$nama_kategori = $_POST['nama_kategori'];
	$query_kategori = "INSERT INTO kategori(nama_kategori) VALUES ('$nama_kategori')";
}


if (isset($_POST['ubah_kategori'])) {
	$id_kategori = $_POST['id_kategori'];
	$nama_kategori = $_POST['nama_kategori'];
	$query_kategori = "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id_kategori'";
}


if($id_kategori!=""){
	if(CheckKey("SELECT id_kategori from kategori where nama_kategori='$nama_kategori' and id_kategori!='$id_kategori'")==true){
		$msg= "<label style='color:#C00'> Data Kategori Sudah Terdaftar Dalam Database </label>";
	}else{
		$update_kategori=mysqli_query($id_mysql,$query_kategori)or die ('Data Kategori Gagal Diperbaharui');
		if($update_kategori){
			$msg= "<label> Data Kategori Berhasil Diupdate </label>";
		}else{
			$msg= "<label style='color:#C00'> Data Kategori Gagal Diupdate </label>";
		}
	}
}
?>

<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#table_kategori').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });

    hidemsg();
});


function edit_pet(id_kategori, nama_kategori) {
    document.getElementById('id_kategori').value = id_kategori;
    document.getElementById('nama_kategori').value = nama_kategori;
};
</script>

<div class="form-section">
    <h2>Halaman Data Kategori</h2>

    <div class="main-page">
        <div class="four-grids four-grids-custom">

            <div id="pesan" style="height:30px">
                <center><?php echo $msg; ?></center>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <table style="width:100%" cellpadding="3" cellspacing="3">
                    <tr>
                        <td>
                            <div class="form-group" hidden>
                                <label class="control-label">ID</label>
                                <input class="form-control" name="id_kategori" id="id_kategori">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="control-label">Nama Kategori</label>
                                <input class="form-control" name="nama_kategori" id="nama_kategori" required>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="form-group">
                    <input name="simpan_kategori" type="submit" value="SIMPAN" class="tambah_data btn btn-primary" />
                    <input name="reset_data" type="reset" value="RESET" class="reset_data btn btn-default" />
                    <input name="ubah_kategori" type="submit" value="UBAH" class="ubah_data btn btn-primary" hidden />
                    <input name="batal_data" type="reset" value="BATAL" class="batal_data btn btn-default"
                        onclick="batal();" hidden />
                </div>
            </form>

            <table width="100%" cellpadding="0" cellspacing="0" border="1"
                class="table table-striped table-bordered table-hover" id="table_kategori" align="center">
                <thead>
                    <tr>
                        <td width="10%">No</td>
                        <td hidden>ID</td>
                        <td>Kategori</td>
                        <td width="10%">Pilihan</td>
                    </tr>
                </thead>
                <tbody>
                    <?PHP

$query = "select * from kategori";


$result = mysqli_query($id_mysql,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

$no = 1;		
while ($row = mysqli_fetch_array($result)){
	$id_kategori=$row['id_kategori'];
	$nama_kategori = $row['nama_kategori'];
	
print (" <tr align=\"center\">
<td>$no</td>
<td hidden>$id_kategori</td>
<td>$nama_kategori</td>
<td width=\"10%\"><a href=\"#\"><img src=\"images/edit.png\" style=\"width:20px; height:20px;\" onclick=\"edit_pet('$id_kategori', '$nama_kategori'); ubah();\" \></a></td>
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