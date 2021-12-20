<?PHP
$id_akun = "";

if (isset($_POST['simpan_akun'])) {
	$id_akun = "\\//";
	$username_akun = $_POST['username_akun'];
	$password_akun = $_POST['password_akun'];
	$hakakses_akun = $_POST['hakakses_akun'];
	$query_akun = "INSERT INTO akun(username_akun, password_akun, hakakses_akun) VALUES ('$username_akun','$password_akun', '$hakakses_akun')";
}


if (isset($_POST['ubah_akun'])) {
	$id_akun = $_POST['id_akun'];
	$username_akun = $_POST['username_akun'];
	$password_akun = $_POST['password_akun'];
	$hakakses_akun = $_POST['hakakses_akun'];
	$query_akun = "UPDATE akun SET username_akun='$username_akun', password_akun='$password_akun', hakakses_akun='$hakakses_akun' WHERE id_akun='$id_akun'";
}


if($id_akun!=""){
	if(CheckKey("SELECT id_akun from akun where username_akun='$username_akun' and id_akun!='$id_akun'")==true){
		$msg= "<label style='color:#C00'> Data Pengguna Sudah Terdaftar Dalam Database </label>";
	}else{
		$update_akun=mysqli_query($id_mysql,$query_akun)or die ('Data Administrator Gagal Diperbaharui');
		if($update_akun){
			$msg= "<label> Data Pengguna Berhasil Diupdate </label>";
		}else{
			$msg= "<label style='color:#C00'> Data Pengguna Gagal Diupdate </label>";
		}
	}
}
?>

<script type="text/javascript">
$(document).ready(function() {
		oTable = $('#table_akun').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		
		hidemsg();
});


function edit_pet(id_akun, username_akun, password_akun, hakakses_akun){
	document.getElementById('id_akun').value = id_akun;
	document.getElementById('username_akun').value = username_akun;
	document.getElementById('password_akun').value = password_akun;
	$("#hakakses_akun").find("option").filter(function(){
		  return ( ($(this).val() == hakakses_akun) || ($(this).text() == hakakses_akun) )
	}).prop('selected', true);
};
</script>


<div class="form-section">
<h2>Halaman Data Pengguna</h2>

<div class="main-page">
	<div class="four-grids four-grids-custom">

<div id="pesan" style="height:30px"><center><?php echo $msg; ?></center></div>
        
        <form action="" method="post"  enctype="multipart/form-data">
          <table style="width:100%" cellpadding="3" cellspacing="3">
          <tr><td>
          	<div class="form-group" hidden>
              <label class="control-label">ID</label>
              <input class="form-control" name="id_akun" id="id_akun">
            </div>
          </td></tr>
          <tr><td>
            <div class="form-group">
              <label class="control-label">Nama Akun</label>
              <input class="form-control" name="username_akun" id="username_akun" required>
            </div>
         </td></tr>
         <tr><td>
            <div class="form-group">
              <label class="control-label">Kata Sandi</label>
              <input class="form-control" name="password_akun" id="password_akun" required>
            </div>
         </td></tr>
         <tr><td>
                <div class="form-group">
                  <label class="control-label">Hak Akses</label>
                  <select class="form-control" name="hakakses_akun" id="hakakses_akun" required>
                  <option value="">-----Pilih Hak Akses-----</option>
                  <option value="Super Administrator">Super Administrator</option>
                  <option value="Administrator">Administrator</option>
                  <option value="Manager">Manager</option>
                  </select>
                </div>
             </td></tr></table>
            <div class="form-group">
            <input name="simpan_akun" type="submit" value="SIMPAN" class="tambah_data btn btn-primary" />
            <input name="reset_data" type="reset" value="RESET" class="reset_data btn btn-default" />
            <input name="ubah_akun" type="submit" value="UBAH" class="ubah_data btn btn-primary" hidden/>
            <input name="batal_data" type="reset" value="BATAL" class="batal_data btn btn-default" onclick="batal();" hidden/>
            </div>
        </form>
      
<table width="100%" cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered table-hover" id="table_akun" align="center">
	<thead>
  <tr>
  		<td width="10%">No</td>
        <td hidden>ID</td>
        <td>Username</td>
        <td>Password</td>
        <td width="10%">Pilihan</td> 
  </tr>
	</thead>
	<tbody>
<?PHP

$query = "select * from akun";


$result = mysqli_query($id_mysql,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

$no = 1;		
while ($row = mysqli_fetch_array($result)){
	$id_akun=$row['id_akun'];
	$username_akun = $row['username_akun'];
	$password_akun = $row['password_akun'];
	$hakakses_akun = $row['hakakses_akun'];
	
print (" <tr align=\"center\">
<td>$no</td>
<td hidden>$id_akun</td>
<td>$username_akun</td>
<td>*****</td>
<td width=\"10%\"><a href=\"#\"><img src=\"images/edit.png\" style=\"width:20px; height:20px;\" onclick=\"edit_pet('$id_akun', '$username_akun', '$password_akun', '$hakakses_akun'); ubah();\" \></a></td>
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