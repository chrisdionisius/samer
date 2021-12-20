<?PHP
if(isset($_POST['cari_menu'])){
	$idkategori_menu = $_POST['idkategori_menu'];
}else{
	$idkategori_menu = "";
}

?>


<script src="php/datepicker/lib/zebra_datepicker.js"></script>
<link rel="stylesheet" href="php/datepicker/lib/css/default.css" />

<script type="text/javascript">

$(document).ready(function() {
		oTable = $('#table_menu').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",
			"bPaginate": false,
			"bLengthChange": false,
			"bFilter": true,
			"bInfo": false,
			"bAutoWidth": false
		});
		
		hidemsg();
		
		$('#awalperiode_analisis').Zebra_DatePicker({
//			direction:-1,
			format : 'Y-m-d',
            months : ['01','02','03','04','05','06','07','08','09','10','11','12'],
            days : ['Sun','Mon','Tue','Wed','Thur','Fri','Sat'],
            days_abbr : ['Sun','Mon','Tue','Wed','Thur','Fri','Sat'],
            show_icon : false
        });
		
		$('#akhirperiode_analisis').Zebra_DatePicker({
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
		
});

function toggleChecked(status){
	$(".checkbox").each( function(){
		$(this).prop("checked",status);
	});
}

function analisis(){
	var n = 0;
	$(".checkbox").each( function(){
		if ($(this).prop('checked')==true){ 
        n=n+1;
    	}
	})
	if(n>0){
		var awalperiode_analisis = document.getElementById("awalperiode_analisis").value;
		var akhirperiode_analisis = document.getElementById("akhirperiode_analisis").value;
		if(awalperiode_analisis!="" && akhirperiode_analisis!=""){
			$('#form2').attr('action', 'halaman.php?tag=hasilanalisis');
			$('#form2').submit();
		}else{
			alert('Tanggal Periode Masih Kosong');
		}
	}else{
		alert('Belum Ada Data Menu Terpilih');
	}
}

</script>


<div class="form-section">
<h2>Halaman Data Menu</h2>

<div class="main-page">
	<div class="four-grids four-grids-custom">

<div id="pesan" style="height:30px"><center><?php echo $msg; ?></center></div>

<form action="" method="post"  enctype="multipart/form-data">
              <table style="width:100%" cellpadding="3" cellspacing="3">
              <tr><td>
                <div class="form-group">
                  <label class="control-label">Kategori Menu</label>
                  <select class="form-control" name="idkategori_menu" id="idkategori_menu">
                  <option value="">-----Pilih Kategori Menu-----</option>
                  <?PHP
                  $get_kategoriupacara = mysqli_query($id_mysql,"select * from kategori order by nama_kategori");
                        while($row=mysqli_fetch_array($get_kategoriupacara)){
                            echo "<option value=\"$row[id_kategori]\">$row[nama_kategori]</option>\n";
                        }
                  ?>
                  </select>
                </div>
             </td></tr></table>
	<div class="form-group">
    	<input name="cari_menu" type="submit" value="CARI" class="tambah_data btn btn-primary" />
        <input name="reset_data" type="reset" value="BATAL" class="reset_data btn btn-default" />
    </div>
</form>      

<form method="post" action="" id="form2" name="form2">
<table width="100%" cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered table-hover" id="table_menu" align="center">
	<thead>
  <tr>
  		<td width="10%">No</td>
        <td hidden>ID</td>
        <td>Kategori</td>
        <td>Nama Menu</td>
        <td>Harga Jual</td>
        <td width="10%"><input class="checkall" onClick="toggleChecked(this.checked)" type="checkbox"></td> 
  </tr>
	</thead>
	<tbody>
<?PHP

$query = "select m.*, k.* from menu m, kategori k where m.idkategori_menu=k.id_kategori and m.idkategori_menu LIKE '%$idkategori_menu%'";


$result = mysqli_query($id_mysql,$query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
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
<td>$harga</td>
<td width=\"10%\"><input name=\"chk[]\" type=\"checkbox\" id=\"chk[]\" value=\"$id_menu\" class=\"checkbox\" /></td>
</tr>

");
?>
<?php
$no++;
}
?>

	</tbody>
</table>


			<table style="width:100%" style="border-top:2px solid #999">
              <tr><td style="padding-left:1em;" width="60%">
                <div class="form-group">
                  <label class="control-label">Awal Periode</label>
                  <input class="form-control readonly" name="awalperiode_analisis" id="awalperiode_analisis" required autocomplete="off">
                </div>
             </td>
             <td rowspan="2" width="40%">             
            <div class="form-group">
                <input name="btn_analisis" type="button" value="Analisa Menu" class="tambah_data btn btn-primary" style="width:100% !important; padding:3em !important; margin:2.5em 1em 1em 1em;" onclick="analisis();" />
            </div>
            </td></tr>
             <tr><td style="padding-left:1em;">
                <div class="form-group">
                  <label class="control-label">Akhir Periode</label>
                  <input class="form-control readonly" name="akhirperiode_analisis" id="akhirperiode_analisis" required autocomplete="off">
                </div>
             </td></tr></table>

</form>

            <div class="clearfix"></div>
        </div>

	<div class="clearfix"> </div>
</div>

</div>