<?PHP
	if(isset($_POST['simpan_penjualan'])){
		$id_penjualan = $_POST['id_penjualan'];
		$iddetailpenjualan_penjualan = date("ymdhis");
		$idmenu_detailpenjualan = $_POST['idmenu_detailpenjualan'];
		$qty_detailpenjualan = $_POST['qty_detailpenjualan'];
		$harga_detailpenjualan = $_POST['harga_detailpenjualan'];
		$hitung = count($idmenu_detailpenjualan);
		$totalharga_penjualan = 0;
		$totalqty_penjualan = 0;
		
		for($x=0;$x<$hitung;$x++) {
			$getdata_resep = mysqli_query($id_mysql,"select idbahan_resep, banyakbahan_resep from resep where idmenu_resep='$idmenu_detailpenjualan[$x]'");
			while($row=mysqli_fetch_array($getdata_resep)){
				$getdata_bahan = mysqli_fetch_array(mysqli_query($id_mysql,"select * from bahan where id_bahan='$row[idbahan_resep]'"));
				$stocksisa_bahan = $getdata_bahan['stocksisa_bahan'] -  ($row['banyakbahan_resep'] * $qty_detailpenjualan[$x]);
				$stockjual_bahan = $getdata_bahan['stockjual_bahan'] + ($row['banyakbahan_resep'] * $qty_detailpenjualan[$x]);	
			
			//Update Bahan
			$update_bahan = mysqli_query($id_mysql,"update bahan set stocksisa_bahan='$stocksisa_bahan', stockjual_bahan='$stockjual_bahan' where id_bahan='$row[idbahan_resep]'");
			}
			
			//Masukkan kedalam detailpenjualan
			$harga_detailpenjualan[$x] = round($qty_detailpenjualan[$x]*$harga_detailpenjualan[$x]);
			$insert_detailpenjualan = mysqli_query($id_mysql,"insert into detailpenjualan (id_detailpenjualan, tgl_detailpenjualan, idmenu_detailpenjualan, qty_detailpenjualan, harga_detailpenjualan) VALUES ('$iddetailpenjualan_penjualan', NOW(), '$idmenu_detailpenjualan[$x]', '$qty_detailpenjualan[$x]', '$harga_detailpenjualan[$x]')") or die ('Gagal Ambil Insert Detail Penjualan');
			
			//Total kan jumlah harga dan qty
			$totalqty_penjualan = $totalqty_penjualan + $qty_detailpenjualan[$x];
			$totalharga_penjualan = $totalharga_penjualan + $harga_detailpenjualan[$x];
		}
		
		//Masukkan kedalam penjualan
		$insert_penjualan = mysqli_query($id_mysql,"INSERT INTO penjualan(id_penjualan, iddetailpenjualan_penjualan, tgl_penjualan, totalqty_penjualan, totalharga_penjualan) VALUES ('$id_penjualan','$iddetailpenjualan_penjualan',NOW(),'$totalqty_penjualan','$totalharga_penjualan')")  or die ('Gagal Insert Penjualan');
		if($insert_penjualan){
			$msg = "Data Penjualan Bahan Berhasil Diupdate";
		}else{
			$msg = "Data Penjualan Bahan Gagal Diupdate";
		}
	}

?>

<script type="text/javascript">
$(document).ready(function() {

    oTable = $('#table_menu').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "bLengthChange": false,
        "iDisplayLength": 5,
        "bFilter": true
    });

    hidemsg();
});


function toggleChecked(status) {
    $(".checkbox").each(function() {
        $(this).prop("checked", status);
    });
}


function deleteAll() {
    var sel = false;
    var ch = $(document.getElementById("table_penjualan")).find('tbody input[type=checkbox]');
    var c = confirm('Hapus Menu Ini Dari Tabel Penjualan?');
    if (c) {
        ch.each(function() {
            var $this = $(this);
            if ($this.is(':checked')) {
                sel = true; //set to true if there is/are selected row
                $this.parents('tr').fadeOut(function() {
                    $this.parents('tr').remove(); //remove row when animation is finished
                });
            }
        });
        if (!sel) alert('Tidak Ada Data Menu Yang Terpilih');
    }
    return false;
}
</script>

<div class="form-section">
    <h2>Halaman Data Penjualan</h2>

    <div class="main-page">
        <div class="four-grids four-grids-custom">

            <div id="pesan" style="height:30px">
                <center><?php echo $msg; ?></center>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <table style="width:100%" cellpadding="3" cellspacing="3">
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="control-label">No Transaksi Penjualan</label>
                                <input class="form-control" name="id_penjualan" id="id_penjualan" maxlength="30"
                                    required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="control-label">Menu Yang Dibeli</label>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="form-group">
                    <a href="#" data-toggle="modal" data-target="#myModal1" style="text-decoration:none;"><input
                            name="tambah_data" type="button" value="TAMBAH" class="tambah_data btn btn-default" /></a>
                </div>

                <table width="100%" cellpadding="0" cellspacing="0" border="1"
                    class="table table-striped table-bordered table-hover" id="table_penjualan" align="center">
                    <thead>
                        <tr style="background:#000">
                            <td width="10%">No</td>
                            <td width="10%" hidden>ID</td>
                            <td>Nama Menu</td>
                            <td>Harga</td>
                            <td width="10%">Qty</td>
                            <td width="10%"><input class="checkall" onClick="toggleChecked(this.checked)"
                                    type="checkbox"></td>
                        </tr>
                    </thead>
                    <tbody>

                        <tr id="tabelbaru"></tr>

                    </tbody>
                </table>


                <div class="form-group">
                    <input name="simpan_penjualan" type="submit" value="SIMPAN" class="tambah_data btn btn-primary" />
                    <input name="hapus_data" type="button" value="HAPUS" class="hapus_data btn btn-default"
                        onclick="deleteAll();" />
                    <input name="batal_data" type="button" value="BATAL" class="tambah_data btn btn-default"
                        onclick="window.location='halaman.php'" />
                    <a href="halaman.php?tag=laporanpenjualan"><label style="float:right; cursor:pointer;">History
                            Penjualan</label></a>
                </div>
            </form>

            <div class="clearfix"></div>
        </div>

        <div class="clearfix"> </div>
    </div>

</div>


<!--//scrolling js-->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-info">
            <div class="modal-header"><label style="float:left; color:#0e62c7">Data Bahan</label><button type="button"
                    class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button></div>
            <div class="modal-body">
                <div class="more-grids">

                    <table width="100%" cellpadding="0" cellspacing="0" border="1"
                        class="table table-striped table-bordered table-hover" id="table_menu" align="center">
                        <thead>
                            <tr>
                                <td width="10%">No</td>
                                <td hidden>ID</td>
                                <td>Nama Menu</td>
                                <td>Harga</td>
                                <td width="10%">Pilihan</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?PHP

$query = "select * from menu";


$result = mysqli_query($id_mysql,$query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

$no = 1;		
while ($row = mysqli_fetch_array($result)){
	$id_menu=$row['id_menu'];
	$nama_menu = $row['nama_menu'];
	$harga_menu = round(((($row['rc_menu'] + $row['sc_menu'] + $row['gc_menu']) * 30)/100) + ($row['rc_menu'] + $row['sc_menu'] + $row['gc_menu']));
	$harga_menu2 = number_format($harga_menu);
	
print (" <tr align=\"center\">
<td>$no</td>
<td hidden>$id_menu</td>
<td>$nama_menu</td>
<td>$harga_menu2</td>
<td width=\"10%\"><a href=\"#\"><img src=\"images/details_open.png\" style=\"width:20px; height:20px;\" onclick=\"Tambah_Menu('$id_menu', '$nama_menu', '$harga_menu');\" \></a></td>
</tr>

");
?>
                            <?php
$no++;
}
?>

                        </tbody>
                    </table>


                    <button type="button" class="btn btn-default" data-dismiss="modal" id="close_modal"
                        name="close_modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- //Register -->