<?PHP
$id_menu = "";

if(isset($_POST['simpan_menu'])){
	$id_menu = "\\//";
	$idkategori_menu = $_POST['idkategori_menu'];
	$nama_menu = $_POST['nama_menu'];
	$rc_menu = str_replace(",", "",$_POST['rc_menu']);
	$gc_menu = str_replace(",", "",$_POST['gc_menu']);
	$sc_menu = str_replace(",", "",$_POST['sc_menu']);
	$query_menu = "INSERT INTO menu(idkategori_menu, nama_menu, rc_menu, gc_menu, sc_menu) VALUES ('$idkategori_menu', '$nama_menu', '$rc_menu', '$gc_menu', '$sc_menu')";
}

if(isset($_POST['ubah_menu'])){
	$id_menu = $_POST['id_menu'];
	$idkategori_menu = $_POST['idkategori_menu'];
	$nama_menu = $_POST['nama_menu'];
	$rc_menu = str_replace(",", "",$_POST['rc_menu']);
	$gc_menu = str_replace(",", "",$_POST['gc_menu']);
	$sc_menu = str_replace(",", "",$_POST['sc_menu']);
	$query_menu = "UPDATE menu SET idkategori_menu='$idkategori_menu', nama_menu='$nama_menu', rc_menu='$rc_menu', gc_menu='$gc_menu', sc_menu='$sc_menu' WHERE id_menu='$id_menu'";
}

if($id_menu!=""){
	if(CheckKey("SELECT id_menu from menu where nama_menu='$nama_menu' and idkategori_menu='$idkategori_menu' and id_menu!='$id_menu'")==true){
		$msg= "<label style='color:#C00'> Data Menu Sudah Terdaftar Dalam Database </label>";
	}else{
		$input_menu = mysqli_query($id_mysql,$query_menu);
		if($input_menu){
			$msg= "<label> Data Menu Berhasil Diupdate </label>";
		}else{
			$msg= "<label style='color:#C00'>  Data Menu Gagal Diupdate </label>";
		}	
	}
}
?>

<script type="text/javascript">
$(document).ready(function() {
		oTable = $('#table_menu').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		hidemsg();
});


function edit_menu(id_menu, idkategori_menu, nama_menu, rc_menu, gc_menu, sc_menu){
	document.getElementById('id_menu').value = id_menu;
	document.getElementById('nama_menu').value = nama_menu;
	document.getElementById('rc_menu').value = formatAngka2(rc_menu);
	document.getElementById('gc_menu').value = formatAngka2(gc_menu);
	document.getElementById('sc_menu').value = formatAngka2(sc_menu);
	$("#idkategori_menu").find("option").filter(function(){
		  return ( ($(this).val() == idkategori_menu) || ($(this).text() == idkategori_menu) )
	}).prop('selected', true);
};

</script>


<div class="form-section">
<h2>Halaman Data Menu</h2>

<div class="main-page">
	<div class="four-grids four-grids-custom">

<div id="pesan" style="height:30px"><center><?php echo $msg; ?></center></div>

<form action="" method="post"  enctype="multipart/form-data">
              <table style="width:100%" cellpadding="3" cellspacing="3">
              <tr><td>
                <div class="form-group" hidden>
                  <label class="control-label">ID</label>
                  <input class="form-control" name="id_menu" id="id_menu">
                </div>
              </td></tr>
              <tr><td>
                <div class="form-group">
                  <label class="control-label">Kategori Menu</label>
                  <select class="form-control" name="idkategori_menu" id="idkategori_menu" required>
                  <option value="">-----Pilih Kategori Menu-----</option>
                  <?PHP
                  $get_kategoriupacara = mysqli_query($id_mysql,"select * from kategori order by nama_kategori");
                        while($row=mysqli_fetch_array($get_kategoriupacara)){
                            echo "<option value=\"$row[id_kategori]\">$row[nama_kategori]</option>\n";
                        }
                  ?>
                  </select>
                </div>
             </td></tr>
            <tr><td>
                <div class="form-group">
                  <label class="control-label">Nama Menu</label>
                  <input class="form-control" name="nama_menu" id="nama_menu" required>
                </div>
             </td></tr>
             <tr><td>
                <div class="form-group">
                  <label class="control-label"><i>Receipe Cost</i></label>
                  <input class="form-control" name="rc_menu" id="rc_menu" onkeypress="return goodchars(event,'0123456789',this);" onKeyUp="formatAngka(this, ',')" required>
                </div>
             </td></tr>
             <tr><td>
                <div class="form-group">
                  <label class="control-label"><i>Garnish Cost</i></label>
                  <input class="form-control" name="gc_menu" id="gc_menu" onkeypress="return goodchars(event,'0123456789',this);" onKeyUp="formatAngka(this, ',')" required>
                </div>
             </td></tr>
             <tr><td>
                <div class="form-group">
                  <label class="control-label"><i>Supplementary Cost</i></label>
                  <input class="form-control" name="sc_menu" id="sc_menu" onkeypress="return goodchars(event,'0123456789',this);" onKeyUp="formatAngka(this, ',')"  required>
                </div>
             </td></tr></table>
	<div class="form-group">
    	<input name="simpan_menu" type="submit" value="SIMPAN" class="tambah_data btn btn-primary" />
        <input name="reset_data" type="reset" value="RESET" class="reset_data btn btn-default" />
        <input name="ubah_menu" type="submit" value="UBAH" class="ubah_data btn btn-primary" hidden/>
        <input name="batal_data" type="reset" value="BATAL" class="batal_data btn btn-default" onclick="batal();" hidden/>
    </div>
</form>      

<table width="100%" cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered table-hover" id="table_menu" align="center">
	<thead>
  <tr>
  		<td width="10%">No</td>
        <td hidden>ID</td>
        <td>Kategori</td>
        <td>Nama Menu</td>
        <td>Receipe Cost</td>
        <td>Garnish Cost</td>
        <td>Supplementary Cost</td>
        <td>Harga Jual</td>
        <td width="10%">Pilihan</td> 
  </tr>
	</thead>
	<tbody>
<?PHP

$query = "select m.*, k.* from menu m, kategori k where m.idkategori_menu=k.id_kategori";


$result = mysqli_query($id_mysql,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

$no = 1;		
while ($row = mysqli_fetch_array($result)){
	$id_menu=$row['id_menu'];
	$id_kategori = $row['id_kategori'];
	$nama_kategori = $row['nama_kategori'];
	$nama_menu = $row['nama_menu'];
	$rc_menu = $row['rc_menu'];
	$rc2 = number_format($rc_menu);
	$gc_menu = $row['gc_menu'];
	$gc2 = number_format($gc_menu);
	$sc_menu = $row['sc_menu'];
	$sc2 = number_format($sc_menu);
	$harga = number_format(round(((($row['rc_menu'] + $row['sc_menu'] + $row['gc_menu']) * 30)/100) + ($row['rc_menu'] + $row['sc_menu'] + $row['gc_menu'])));
	$arg = base64_encode(json_encode($id_menu));
	
print (" <tr align=\"center\">
<td>$no</td>
<td hidden>$id_menu</td>
<td>$nama_kategori</td>
<td>$nama_menu</td>
<td>$rc2</td>
<td>$gc2</td>
<td>$sc2</td>
<td>$harga</td>
<td width=\"10%\"><a href=\"#\"><img src=\"images/edit.png\" style=\"width:20px; height:20px;\" onclick=\"edit_menu('$id_menu', '$id_kategori', '$nama_menu', '$rc_menu', '$gc_menu', '$sc_menu'); ubah();\" \></a> | <a href=\"halaman.php?tag=resep&idr=$arg\"><img src=\"images/resep.png\" style=\"width:20px; height:20px;\" \></a></td>
</tr>

");
?>
<?php
$no++;
}
?>

	</tbody>
</table>

<p>* Harga Modal = Receipe Cost + Garnish Cost + Supplementary Cost.<br />
* Target Keuntungan = Harga Modal x 30%.<br />
* Harga Jual = Harga Modal + Target Keuntungan.</p>

            <div class="clearfix"></div>
        </div>

	<div class="clearfix"> </div>
</div>

</div>