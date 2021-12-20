<?PHP
if(isset($_POST['chk'])){
	
	$awalperiode_analisis = $_POST['awalperiode_analisis'];
	$akhirperiode_analisis = $_POST['akhirperiode_analisis'];
	$hitung_id_menu = count ($_POST['chk']);
	$totalmm = 0;
	$totalcm = 0;
	$nama_menu = array();
	$mmratemasing = array();
	$hargajual_menumasing = array();
	$hargapokok_menumasing = array();
	$totalhargajualmasing = array();
	$totalhargapokokmasing = array();
	$totalcmmasing = array();
	$cm_menumasing = array();
	$mm_menumasing = array();
	$klasifikasi_mm = array();
	$klasifikasi_cm = array();
	
		//Menghitung Periode Di Antara Tanggal
		$d1 = strtotime($awalperiode_analisis);
		$d2 = strtotime($akhirperiode_analisis);
		if($d1 > $d2){
			?>
<script>
alert('Tanggal Periode Awal Harus Lebih Lama Dari Periode Akhir');
window.location = 'halaman.php?tag=analisis'
</script>
<?PHP
		}
		$min_date = min($d1, $d2);
		$max_date = max($d1, $d2);
		$i = 0;
		while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
			$i++;
		}
?>


<script type="text/javascript">
$(document).ready(function() {
    oTable = $('table.table').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "bAutoWidth": false
    });
});
</script>

<div class="form-section">
    <h2>Hasil Analisis Menu</h2>

    <div class="main-page">
        <div class="four-grids four-grids-custom">

            <div class="form-grid1">

                Periode : <strong>
                    <?PHP echo $i ?> Bulan
                </strong>, dari
                <?PHP echo $awalperiode_analisis." s/d ".$akhirperiode_analisis ?><br><br>

                <h4><span>Menu Mix (MM), Proporsi dan Klasifikasinya</span></h4>
                <?PHP		
		
		for($x=0; $x<$hitung_id_menu; $x++){
			$id_menu[$x] = $_POST['chk'][$x];
			//Hitung MM
			$query_detailpembelian = mysqli_query($id_mysql,"select qty_detailpenjualan from detailpenjualan where idmenu_detailpenjualan='$id_menu[$x]' and tgl_detailpenjualan BETWEEN '$awalperiode_analisis' and '$akhirperiode_analisis'");
			$mm = 0;
			while($z = mysqli_fetch_array($query_detailpembelian)){
				$mm = $mm + $z['qty_detailpenjualan'];
			}
			$totalmm = $totalmm + $mm;
			
			//Menghitung Achievement Rate MM
			$achievmentrate_mm = round((((1/$hitung_id_menu) * 0.7) * $totalmm),2);
			
			//Hitung Cm
			$get_datamenu = mysqli_fetch_array(mysqli_query($id_mysql,"select * from menu where id_menu='$id_menu[$x]'"));
			$hargajual_menu = round(((($get_datamenu['rc_menu'] + $get_datamenu['sc_menu'] + $get_datamenu['gc_menu']) * 30)/100) + ($get_datamenu['rc_menu'] + $get_datamenu['sc_menu'] + $get_datamenu['gc_menu']));
			$hargapokok_menu = round($get_datamenu['rc_menu'] + $get_datamenu['sc_menu'] + $get_datamenu['gc_menu']);
			$cm = $hargajual_menu - $hargapokok_menu;

			//Menghitung Keseluruhan Total CM
			$totalcm = $totalcm + ($cm*$mm);
			//Menentukan CM Achievment Rate
			if(($totalcm!=0) || ($totalmm!=0)){
				$achievementrate_cm = $totalcm / $totalmm;
			}else{
				$achievementrate_cm = 0;
			}
		}
	?>


                <table width="100%" cellpadding="0" cellspacing="0" border="1"
                    class="table table-striped table-bordered table-hover" id="table_mm" align="center">
                    <thead>
                        <tr>
                            <td>Nama Menu</td>
                            <td>Harga Jual</td>
                            <td>MM</td>
                            <td>MM %</td>
                            <td>Klasifikasi MM</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?PHP	
		for($x=0; $x<$hitung_id_menu; $x++){
			$id_menu[$x] = $_POST['chk'][$x];
			//Ambil Nama Dan Harga Menu
			$get_datamenu = mysqli_fetch_array(mysqli_query($id_mysql,"select * from menu where id_menu='$id_menu[$x]'"));
			$harga_menu = number_format(round(((($get_datamenu['rc_menu'] + $get_datamenu['sc_menu'] + $get_datamenu['gc_menu']) * 30)/100) + ($get_datamenu['rc_menu'] + $get_datamenu['sc_menu'] + $get_datamenu['gc_menu'])));
			
			//Tampilkan Nama Dan Harga 
			echo "<tr><td>".$get_datamenu['nama_menu']."</td><td>".$harga_menu."</td><td>";
			array_push($nama_menu, $get_datamenu['nama_menu']);
			
			//Hitung MM
			$query_detailpembelian = mysqli_query($id_mysql,"select qty_detailpenjualan from detailpenjualan where idmenu_detailpenjualan='$id_menu[$x]' and tgl_detailpenjualan BETWEEN '$awalperiode_analisis' and '$akhirperiode_analisis'");
			$mm = 0;
			while($z = mysqli_fetch_array($query_detailpembelian)){
				$mm = $mm + $z['qty_detailpenjualan'];
			}
			//Cetak MM
			echo $mm."</td><td>";
			
			if(($mm==0) || ($totalmm==0)){
				$porsi_mm = 0;
			}else{
				//Hitung Porsi MM
				$porsi_mm = round((($mm/$totalmm)*100),2);
			}
			//Cetak Porsi MM
			echo $porsi_mm."</td><td>";
			array_push($mmratemasing, $porsi_mm);
			
			//Menentukan Klasifikasi MM
			if($porsi_mm >= $achievmentrate_mm){
				$ac = "H";
			}else{
				$ac = "L";
			}
			echo $ac."</td></tr>";
			array_push($klasifikasi_mm, $ac);
		}
?>
                    </tbody>
                </table>

                <a href="#"><label style="float:right; cursor:pointer;">TOTAL Seluruh MM :
                        <?PHP echo $totalmm ?>
                    </label></a>
                <br>
                <label style="float:right; cursor:pointer;">MM Achievement Rate :
                    <?PHP echo round($achievmentrate_mm, 2)."%" ?>
                </label><br><br>

            </div>


            <div class="form-grid1">

                <h4><span>Contribution Margin (CM) dan Klasifikasinya</span></h4>

                <table width="100%" cellpadding="0" cellspacing="0" border="1"
                    class="table table-striped table-bordered table-hover" id="table_cm" align="center">
                    <thead>
                        <tr>
                            <td>Nama Menu</td>
                            <td>Harga Jual</td>
                            <td>Harga Pokok</td>
                            <td>CM</td>
                            <td>MM</td>
                            <td>Total Harga Jual</td>
                            <td>Total Harga Pokok</td>
                            <td>Total CM</td>
                            <td>Klasifikasi CM</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?PHP	
		for($x=0; $x<$hitung_id_menu; $x++){
			$id_menu[$x] = $_POST['chk'][$x];
			//Ambil Nama Dan Harga Menu
			$get_datamenu = mysqli_fetch_array(mysqli_query($id_mysql,"select * from menu where id_menu='$id_menu[$x]'"));
			$hargajual_menu = number_format(round(((($get_datamenu['rc_menu'] + $get_datamenu['sc_menu'] + $get_datamenu['gc_menu']) * 30)/100) + ($get_datamenu['rc_menu'] + $get_datamenu['sc_menu'] + $get_datamenu['gc_menu'])));
			$hargapokok_menu = number_format(round($get_datamenu['rc_menu'] + $get_datamenu['sc_menu'] + $get_datamenu['gc_menu']));
			$cm = number_format(str_replace(",", "",$hargajual_menu) - str_replace(",", "",$hargapokok_menu));
			
			//Tampilkan Nama Dan Harga 
			echo "<tr><td>".$get_datamenu['nama_menu']."</td><td>".$hargajual_menu."</td><td>".$hargapokok_menu."</td><td>".$cm."</td><td>";
			array_push($hargajual_menumasing, $hargajual_menu);
			array_push($hargapokok_menumasing, $hargapokok_menu);
			array_push($cm_menumasing, $cm);
			
			
			//Hitung MM
			$query_detailpembelian = mysqli_query($id_mysql,"select qty_detailpenjualan from detailpenjualan where idmenu_detailpenjualan='$id_menu[$x]' and tgl_detailpenjualan BETWEEN '$awalperiode_analisis' and '$akhirperiode_analisis'");
			$mm = 0;
			while($z = mysqli_fetch_array($query_detailpembelian)){
				$mm = $mm + $z['qty_detailpenjualan'];
			}
			//Cetak MM
			echo $mm."</td><td>";
			echo number_format(str_replace(",", "",$hargajual_menu)*$mm)."</td><td>";
			echo number_format(str_replace(",", "",$hargapokok_menu)*$mm)."</td><td>";
			
			array_push($mm_menumasing, $mm);
			array_push($totalhargajualmasing, (number_format(str_replace(",", "",$hargajual_menu)*$mm)));
			array_push($totalhargapokokmasing, (number_format(str_replace(",", "",$hargapokok_menu)*$mm)));
			
			//Hitung Total CM
			$porsi_cm = str_replace(",", "",$cm);
			//Total Cm
			echo number_format($porsi_cm*$mm)."</td><td>";			
			array_push($totalcmmasing, (number_format($porsi_cm*$mm)));
			
			//Menentukan Klasifikasi CM
			if($porsi_cm >= $achievementrate_cm){
				$am = "H";
			}else{
				$am = "L";
			}
			echo $am."</td></tr>";
			array_push($klasifikasi_cm, $am);
		}
?>
                    </tbody>
                </table>

                <a href="#"><label style="float:right; cursor:pointer;">TOTAL Seluruh CM :
                        <?PHP echo number_format($totalcm) ?>
                    </label></a><br>
                <label style="float:right; cursor:pointer;">CM Achievement Rate :
                    <?PHP echo number_format($achievementrate_cm) ?>
                </label><br><br>

            </div>


            <div class="form-grid1">

                <h4><span>Kategori Menu Berdasarkan Hasil Klasifikasi MM dan CM</span></h4>

                <table width="100%" cellpadding="0" cellspacing="0" border="1"
                    class="table table-striped table-bordered table-hover" id="table_cm" align="center">
                    <thead>
                        <tr>
                            <td>Nama Menu</td>
                            <td>Klasifikasi MM</td>
                            <td>Klasifikasi CM</td>
                            <td>Kategori</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?PHP	
	$arrlength = count($nama_menu);
	for($x = 0; $x < $arrlength; $x++) {
		echo "<tr><td>".$nama_menu[$x]."</td><td>".$klasifikasi_mm[$x]."</td><td>".$klasifikasi_cm[$x]."</td><td>";
		if($klasifikasi_mm[$x]=="H" and $klasifikasi_cm[$x]=="H"){
			$kategori_menu = "Star/Bintang";
		}
		if($klasifikasi_mm[$x]=="H" and $klasifikasi_cm[$x]=="L"){
			$kategori_menu = "Plow Horse/Kuda Bajak";
		}
		if($klasifikasi_mm[$x]=="L" and $klasifikasi_cm[$x]=="H"){
			$kategori_menu = "Puzzle/Teka Teki";
		}
		if($klasifikasi_mm[$x]=="L" and $klasifikasi_cm[$x]=="L"){
			$kategori_menu = "Dog/Anjing";
		}
		echo $kategori_menu."</td></tr>";
	}
?>
                    </tbody>
                </table>
            </div>

            <?PHP
			$_SESSION['awalperiode_analisis'] = $awalperiode_analisis;
			$_SESSION['akhirperiode_analisis'] = $akhirperiode_analisis;
			$_SESSION['nama_menu'] = $nama_menu;
			$_SESSION['klasifikasi_mm'] = $klasifikasi_mm;
			$_SESSION['klasifikasi_cm'] = $klasifikasi_cm;
			
			
			$_SESSION['mmratemasing'] = $mmratemasing;
			$_SESSION['hargajual_menumasing'] = $hargajual_menumasing;
			$_SESSION['hargapokok_menumasing'] = $hargapokok_menumasing;
			$_SESSION['cm_menumasing'] = $cm_menumasing;
			
			
			$_SESSION['mm_menumasing'] = $mm_menumasing;
			$_SESSION['totalhargajualmasing'] = $totalhargajualmasing;
			$_SESSION['totalhargapokokmasing'] = $totalhargapokokmasing;
			$_SESSION['totalcmmasing'] = $totalcmmasing;
			?>
            <div class="form-group">
                <a href="laporan/laporananalisis_pdf.php" target="_blank"><input name="print_analisis"
                        id="print_analisis" type="button" value="PRINT PDF" class="tambah_data btn btn-print-pdf" /></a>
            </div>


            <div class="clearfix"></div>
        </div>

        <div class="clearfix"> </div>
    </div>

</div>

<?PHP } ?>