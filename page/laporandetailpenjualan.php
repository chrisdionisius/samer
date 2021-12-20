<?PHP

	if(isset($_POST['cari_bahan'])){
		$id_penjualancr = $_POST['id_penjualan'];
		$nama_menucr = $_POST['nama_menu'];
		$tgl_detailpenjualanawalcr = $_POST['tgl_detailpenjualanawalcr'];
		if($tgl_detailpenjualanawalcr==""){
			$tgl_detailpenjualanawalcr = date("2010-01-01");
		}
		$tgl_detailpenjualanakhircr = $_POST['tgl_detailpenjualanakhircr'];
		if($tgl_detailpenjualanakhircr ==""){
			$tgl_detailpenjualanakhircr  = date("Y-m-d");
		}
	}else{
		$id_penjualancr = "";
		$nama_menucr = "";
		$tgl_detailpenjualanawalcr = date("2010-01-01");
		$tgl_detailpenjualanakhircr = date("Y-m-d");
	}
	
	$_SESSION['id_penjualan'] = $id_penjualancr;
	$_SESSION['nama_menu'] = $nama_menucr;
	$_SESSION['tgl_detailpenjualanawalcr'] = $tgl_detailpenjualanawalcr;
	$_SESSION['tgl_detailpenjualanakhircr'] = $tgl_detailpenjualanakhircr;
?>

<script src="php/datepicker/lib/zebra_datepicker.js"></script>
<link rel="stylesheet" href="php/datepicker/lib/css/default.css" />

<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#table_penjualan').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });

    hidemsg();

    $('#tgl_detailpenjualanawalcr').Zebra_DatePicker({
        //			direction:-1,
        format: 'Y-m-d',
        months: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
        days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'],
        days_abbr: ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'],
        show_icon: false
    });


    $('#tgl_detailpenjualanakhircr').Zebra_DatePicker({
        //			direction:-1,
        format: 'Y-m-d',
        months: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
        days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'],
        days_abbr: ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'],
        show_icon: false
    });

    $(".readonly").keydown(function(e) {
        e.preventDefault();
    });

    $(".readonly").attr('required', false);
});
</script>

<div class="form-section">
    <h2>Halaman Laporan Data Penjualan</h2>

    <div class="main-page">
        <div class="four-grids four-grids-custom">


            <form action="" method="post" enctype="multipart/form-data">
                <table style="width:100%" cellpadding="3" cellspacing="3">
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="control-label">No Invoice</label>
                                <input class="form-control" name="id_penjualan" id="id_penjualan">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="control-label">Nama Menu</label>
                                <input class="form-control" name="nama_menu" id="nama_menu">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="control-label">Tanggal Awal Penjualan</label>
                                <input class="form-control readonly" name="tgl_detailpenjualanawalcr"
                                    id="tgl_detailpenjualanawalcr">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="control-label">Tanggal Akhir Penjualan</label>
                                <input class="form-control readonly" name="tgl_detailpenjualanakhircr"
                                    id="tgl_detailpenjualanakhircr">
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="form-group">
                    <input name="cari_bahan" type="submit" value="CARI" class="tambah_data btn btn-primary" />
                    <a href="laporan/laporandetailpenjualan_pdf.php" target="_blank"><input name="print_bahan"
                            type="button" value="PRINT" class="tambah_data btn btn-print-pdf" /></a>
                    <input name="batal_data" type="reset" value="BATAL" class="batal_data btn btn-default" />
                </div>
            </form>

            <table width="100%" cellpadding="0" cellspacing="0" border="1"
                class="table table-striped table-bordered table-hover" id="table_penjualan" align="center">
                <thead>
                    <tr>
                        <td width="10%">No</td>
                        <td>INVOICE</td>
                        <td>ID Detail Penjualan</td>
                        <td>Nama Menu</td>
                        <td>Tanggal</td>
                        <td>Qty</td>
                        <td>Harga</td>
                    </tr>
                </thead>
                <tbody>
                    <?PHP

$query = "select pb.*, dp.*, m.nama_menu from penjualan pb, detailpenjualan dp, menu m where dp.idmenu_detailpenjualan=m.id_menu and dp.id_detailpenjualan=pb.iddetailpenjualan_penjualan and pb.id_penjualan LIKE '%$id_penjualancr%' and m.nama_menu LIKE '%$nama_menucr%' and dp.tgl_detailpenjualan BETWEEN '$tgl_detailpenjualanawalcr%' and '$tgl_detailpenjualanakhircr%'";
		
$result = mysqli_query($id_mysql,$query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

$no = 1;		
while ($row = mysqli_fetch_array($result)){
	
	$id_penjualan = $row['id_penjualan'];	
	$id_detailpenjualan = $row['id_detailpenjualan'];
	$tgl_detailpenjualan = $row['tgl_detailpenjualan'];
	$qty_detailpenjualan = $row['qty_detailpenjualan'];
	$harga_detailpenjualan = number_format($row['harga_detailpenjualan']);
	$nama_menu = $row['nama_menu'];
	
print (" <tr align=\"center\">
<td>$no</td>
<td>$id_penjualan</td>
<td>$id_detailpenjualan</td>
<td>$nama_menu</td>
<td>$tgl_detailpenjualan</td>
<td>$qty_detailpenjualan</td>
<td>$harga_detailpenjualan</td>
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
                <a href="halaman.php?tag=laporanpenjualan"><label style="float:right; cursor:pointer;">Laporan
                        Penjualan</label></a>
            </div>

            <div class="clearfix"></div>
        </div>

        <div class="clearfix"> </div>
    </div>

</div>