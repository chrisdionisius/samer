<?PHP
$id_resep = "";
$idmenu_resep = json_decode(base64_decode($_GET['idr']));
$getdata_menu = mysqli_fetch_array(mysqli_query($id_mysql,"select nama_menu from menu where id_menu='$idmenu_resep'"));

if(isset($_GET['idh'])){
	$idresep_hapus = json_decode(base64_decode($_GET['idh']));
	$input_resep = mysqli_query($id_mysql,"delete from resep where id_resep='$idresep_hapus'");
	if($input_resep){
		$msg= "<label> Data Resep Berhasil Diupdate </label>";
	}else{
		$msg= "<label style='color:#C00'>  Data Resep Gagal Diupdate </label>";
	}	
}

if(isset($_POST['simpan_resep'])){
	$id_resep = "\\//";
	$idbahan_resep = $_POST['idbahan_resep'];
	$banyakbahan_resep = $_POST['banyakbahan_resep'];
	$query_resep = "INSERT INTO resep(idmenu_resep, idbahan_resep, banyakbahan_resep, statusbahan_resep) VALUES ('$idmenu_resep', '$idbahan_resep', '$banyakbahan_resep', 'Digunakan')";
}

if(isset($_POST['ubah_resep'])){
	$id_resep = $_POST['id_resep'];
	$idbahan_resep = $_POST['idbahan_resep'];
	$banyakbahan_resep = $_POST['banyakbahan_resep'];
	$query_resep = "UPDATE resep SET idbahan_resep='$idbahan_resep', banyakbahan_resep='$banyakbahan_resep' WHERE id_resep='$id_resep'";
}

if($id_resep!=""){
	if(CheckKey("SELECT id_resep from resep where idmenu_resep='$idmenu_resep' and idbahan_resep='$idbahan_resep' and id_resep!='$id_resep'")==true){
		$msg= "<label style='color:#C00'> Data Resep Sudah Terdaftar Dalam Database </label>";
	}else{
		$input_resep = mysqli_query($id_mysql,$query_resep);
		if($input_resep){
			$msg= "<label> Data Resep Berhasil Diupdate </label>";
		}else{
			$msg= "<label style='color:#C00'>  Data Resep Gagal Diupdate </label>";
		}	
	}
}
?>

<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#table_resep').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });

    hidemsg();
});


function edit_resep(id_resep, idbahan_resep, banyakbahan_resep) {
    document.getElementById('id_resep').value = id_resep;
    document.getElementById('banyakbahan_resep').value = banyakbahan_resep;
    $("#idbahan_resep").find("option").filter(function() {
        return (($(this).val() == idbahan_resep) || ($(this).text() == idbahan_resep))
    }).prop('selected', true);
};
</script>


<div class="form-section">
    <h2>Halaman Data Resep "
        <?PHP echo $getdata_menu['nama_menu']; ?>"
    </h2>

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
                                <input class="form-control" name="id_resep" id="id_resep">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="control-label">Bahan Resep</label>
                                <select class="form-control" name="idbahan_resep" id="idbahan_resep" required>
                                    <option value="">-----Pilih Bahan Resep-----</option>
                                    <?PHP
                  $get_kategoriupacara = mysqli_query($id_mysql,"select * from bahan order by nama_bahan");
                        while($row=i_array($get_kategoriupacara)){
                            echo "<option value=\"$row[id_bahan]\">$row[nama_bahan]</option>\n";
                        }
                  ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="control-label">Banyak Bahan Dibutuhkan (grm)</label>
                                <input class="form-control" name="banyakbahan_resep" id="banyakbahan_resep" required>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="form-group">
                    <input name="simpan_resep" type="submit" value="SIMPAN" class="tambah_data btn btn-primary" />
                    <input name="reset_data" type="reset" value="RESET" class="reset_data btn btn-default" />
                    <input name="ubah_resep" type="submit" value="UBAH" class="ubah_data btn btn-primary" hidden />
                    <input name="batal_data" type="reset" value="BATAL" class="batal_data btn btn-default"
                        onclick="batal();" hidden />
                </div>
            </form>

            <table width="100%" cellpadding="0" cellspacing="0" border="1"
                class="table table-striped table-bordered table-hover" id="table_resep" align="center">
                <thead>
                    <tr>
                        <td width="10%">No</td>
                        <td hidden>ID</td>
                        <td>Nama Bahan</td>
                        <td>Banyaknya (grm)</td>
                        <td width="10%">Pilihan</td>
                    </tr>
                </thead>
                <tbody>
                    <?PHP

$query = "select r.*, b.nama_bahan from resep r, bahan b, menu m where r.idmenu_resep='$idmenu_resep' and r.idbahan_resep=b.id_bahan and m.id_menu='$idmenu_resep'";


$result = mysqli_query($id_mysql,$query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

$no = 1;		
while ($row = i_array($result)){
	$id_resep=$row['id_resep'];
	$idmenu_resep = $row['idmenu_resep'];
	$idbahan_resep = $row['idbahan_resep'];
	$nama_bahan = $row['nama_bahan'];
	$banyakbahan_resep = $row['banyakbahan_resep'];
	$arr = base64_encode(json_encode($id_resep));
	$arg = base64_encode(json_encode($idmenu_resep));
	
print (" <tr align=\"center\">
<td>$no</td>
<td hidden>$id_resep</td>
<td>$nama_bahan</td>
<td>$banyakbahan_resep</td>
<td width=\"10%\"><a href=\"#\"><img src=\"images/edit.png\" style=\"width:20px; height:20px;\" onclick=\"edit_resep('$id_resep', '$idbahan_resep', '$banyakbahan_resep'); ubah();\" \></a> | <a href=\"halaman.php?tag=resep&idr=$arg&idh=$arr\" onClick=\"return konfirmasi('Yakin Ingin Menghapus Bahan Ini Dari Resep?')\"><img src=\"images/gagal.png\" style=\"width:20px; height:20px;\" \></a></td>
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