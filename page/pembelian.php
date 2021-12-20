<?PHP
	if(isset($_POST['simpan_pembelian'])){
		$id_pembelian = $_POST['id_pembelian'];
		$iddetailpembelian_pembelian = date("ymdhis");
		$idbahan_detailpembelian = $_POST['idbahan_detailpembelian'];
		$qty_detailpembelian = $_POST['qty_detailpembelian'];
		$harga_detailpembelian = $_POST['harga_detailpembelian'];
		$hitung = count($idbahan_detailpembelian);
		$totalharga_pembelian = 0;
		$totalqty_pembelian = 0;
		
		for($x=0;$x<$hitung;$x++) {
			$getdata_bahan = mysqli_fetch_array(mysqli_query($id_mysql,"select stockawal_bahan, stocksisa_bahan from bahan where id_bahan='$idbahan_detailpembelian[$x]'")) or die ('Gagal Ambil Data Bahan');
			$stockawal_bahan = $getdata_bahan['stockawal_bahan'] + $qty_detailpembelian[$x];
			$stocksisa_bahan = $getdata_bahan['stocksisa_bahan'] + $qty_detailpembelian[$x];
			
			//Masukkan kedalam detailpembelian
			$harga_detailpembelian[$x] = round($qty_detailpembelian[$x]*($harga_detailpembelian[$x] / 1000));
			$insert_detailpembelian = mysqli_query($id_mysql,"insert into detailpembelian (id_detailpembelian, tgl_detailpembelian, idbahan_detailpembelian, qty_detailpembelian, harga_detailpembelian) VALUES ('$iddetailpembelian_pembelian', NOW(), '$idbahan_detailpembelian[$x]', '$qty_detailpembelian[$x]', '$harga_detailpembelian[$x]')") or die ('Gagal Ambil Insert Detail Pembelian');
			
			//Update Stock Awal dan Sisa Bahan
			$update_bahan = mysqli_query($id_mysql,"update bahan set stockawal_bahan='$stockawal_bahan', stocksisa_bahan='$stocksisa_bahan' where id_bahan='$idbahan_detailpembelian[$x]'")  or die ('Gagal Update Data Bahan');
			
			//Total kan jumlah harga dan qty
			$totalqty_pembelian = $totalqty_pembelian + $qty_detailpembelian[$x];
			$totalharga_pembelian = $totalharga_pembelian + $harga_detailpembelian[$x];
		}
		
		//Masukkan kedalam pembelian
		$insert_pembelian = mysqli_query($id_mysql,"INSERT INTO pembelian(id_pembelian, iddetailpembelian_pembelian, tgl_pembelian, totalqty_pembelian, totalharga_pembelian) VALUES ('$id_pembelian','$iddetailpembelian_pembelian',NOW(),'$totalqty_pembelian','$totalharga_pembelian')")  or die ('Gagal Insert Pembelian');
		if($insert_pembelian){
			$msg = "Data Pembelian Bahan Berhasil Diupdate";
		}else{
			$msg = "Data Pembelian Bahan Gagal Diupdate";
		}
	}
?>

<script type="text/javascript">
$(document).ready(function() {

    oTable = $('#table_bahan').dataTable({
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
    var ch = $(document.getElementById("table_pembelian")).find('tbody input[type=checkbox]');
    var c = confirm('Hapus Bahan Ini Dari Tabel Pembelian?');
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
        if (!sel) alert('Tidak Ada Data Bahan Yang Terpilih');
    }
    return false;
}
</script>

<div class="form-section">
    <h2>Halaman Data Pembelian</h2>

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
                                <label class="control-label">No Transaksi Pembelian</label>
                                <input class="form-control" name="id_pembelian" id="id_pembelian" maxlength="30"
                                    required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="control-label">Bahan Yang Dibeli</label>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="form-group">
                    <a href="#" data-toggle="modal" data-target="#myModal1" style="text-decoration:none;"><input
                            name="tambah_data" type="button" value="TAMBAH" class="tambah_data btn btn-default" /></a>
                </div>

                <table width="100%" cellpadding="0" cellspacing="0" border="1"
                    class="table table-striped table-bordered table-hover" id="table_pembelian" align="center">
                    <thead>
                        <tr style="background:#000">
                            <td width="10%">No</td>
                            <td width="10%" hidden>ID</td>
                            <td>Nama Bahan</td>
                            <td>Harga/1000gr</td>
                            <td width="10%">Qty (grm)</td>
                            <td width="10%"><input class="checkall" onClick="toggleChecked(this.checked)"
                                    type="checkbox"></td>
                        </tr>
                    </thead>
                    <tbody>

                        <tr id="tabelbaru"></tr>

                    </tbody>
                </table>


                <div class="form-group">
                    <input name="simpan_pembelian" type="submit" value="SIMPAN" class="tambah_data btn btn-primary" />
                    <input name="hapus_data" type="button" value="HAPUS" class="hapus_data btn btn-default"
                        onclick="deleteAll();" />
                    <input name="batal_data" type="button" value="BATAL" class="tambah_data btn btn-default"
                        onclick="window.location='halaman.php'" />
                    <a href="halaman.php?tag=laporanpembelian"><label style="float:right; cursor:pointer;">History
                            Pembelian</label></a>
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
                        class="table table-striped table-bordered table-hover" id="table_bahan" align="center">
                        <thead>
                            <tr>
                                <td width="10%">No</td>
                                <td hidden>ID</td>
                                <td>Nama Bahan</td>
                                <td>Harga/1000gr</td>
                                <td width="10%">Pilihan</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?PHP

$query = "select * from bahan";


$result = mysqli_query($id_mysql,$query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

$no = 1;		
while ($row = mysqli_fetch_array($result)){
	$id_bahan=$row['id_bahan'];
	$nama_bahan = $row['nama_bahan'];
	$harga_bahan = $row['harga_bahan'];
	$harga_bahan2 = number_format($harga_bahan);
	
print (" <tr align=\"center\">
<td>$no</td>
<td hidden>$id_bahan</td>
<td>$nama_bahan</td>
<td>$harga_bahan2</td>
<td width=\"10%\"><a href=\"#\"><img src=\"images/details_open.png\" style=\"width:20px; height:20px;\" onclick=\"Tambah_Bahan('$id_bahan', '$nama_bahan', '$harga_bahan');\" \></a></td>
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