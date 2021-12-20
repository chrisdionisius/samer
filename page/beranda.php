<?PHP
$date = date("Y-m");
$row_kategori = mysqli_num_rows(mysqli_query($id_mysql,"select id_kategori from kategori"));
$row_pengguna = mysqli_num_rows(mysqli_query($id_mysql,"select id_akun from akun"));
$row_menu = mysqli_num_rows(mysqli_query($id_mysql,"select id_menu from menu"));
$row_bahan = mysqli_num_rows(mysqli_query($id_mysql,"select id_bahan from bahan"));
$row_pembelian = mysqli_num_rows(mysqli_query($id_mysql,"select id_pembelian from pembelian where tgl_pembelian LIKE '%$date%'"));
$row_penjualan = mysqli_num_rows(mysqli_query($id_mysql,"select id_penjualan from penjualan where tgl_penjualan LIKE '%$date%'"));
$row_analisis = mysqli_num_rows(mysqli_query($id_mysql,"select id_menu from menu"));

function random_color_part() {
	return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}
						
function random_color() {
	return random_color_part() . random_color_part() . random_color_part();
}

if($_SESSION['hakakses_akun']!="Manager"){
	if($_SESSION['hakakses_akun']=="Super Administrator"){
?>

<div class="main-page">
				<div class="four-grids" >
					<div class="col-md-3 four-grid">
						<div class="four-grid1" style="background: #<?PHP echo random_color(); ?> !important">
							<div class="icon">
								<i class="glyphicon glyphicon-th-list" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Data Kategori</h3>
								<h4> <?PHP echo $row_kategori ?> Data  </h4>
							</div>
							<a href="halaman.php?tag=kategori">Go To Page</a>
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-grid2" style="background: #<?PHP echo random_color(); ?> !important">
							<div class="icon">
								<i class="glyphicon glyphicon-user" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Data Pengguna</h3>
								<h4> <?PHP echo $row_pengguna ?> Data  </h4>
							</div>
							<a href="halaman.php?tag=pengguna">Go To Page</a>
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-grid3" style="background: #<?PHP echo random_color(); ?> !important">
							<div class="icon">
								<i class="glyphicon glyphicon-tree-deciduous" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Data Bahan Makanan</h3>
								<h4> <?PHP echo $row_bahan ?> Data  </h4>
							</div>
							<a href="halaman.php?tag=bahan">Go To Page</a>
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-grid4" style="background: #<?PHP echo random_color(); ?> !important">
							<div class="icon">
								<i class="glyphicon glyphicon-cutlery" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Data Menu</h3>
								<h4> <?PHP echo $row_menu ?>  Data  </h4>
							</div>
							<a href="halaman.php?tag=menu">Go To Page</a>
						</div>
                        
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="clearfix"> </div>
			</div>
<?PHP } ?>
            
            <div class="main-page">
				<div class="four-grids">
					<div class="col-md-3 four-grid">
						<div class="four-grid1" style="background: #<?PHP echo random_color(); ?> !important">
							<div class="icon">
								<i class="glyphicon glyphicon-indent-right" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Analisis Menu</h3>
								<h4> <?PHP echo $row_analisis ?> Data  </h4>
							</div>
							<a href="halaman.php?tag=analisis">Go To Page</a>
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-grid2" style="background: #<?PHP echo random_color(); ?> !important">
							<div class="icon">
								<i class="glyphicon glyphicon-usd" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Data Penjualan</h3>
								<h4> <?PHP echo $row_penjualan ?> Data  </h4>
							</div>
							<a href="halaman.php?tag=penjualan">Go To Page</a>
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-grid3" style="background: #<?PHP echo random_color(); ?> !important">
							<div class="icon">
								<i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Data Pembelian</h3>
								<h4> <?PHP echo $row_pembelian ?> Data  </h4>
							</div>
							<a href="halaman.php?tag=pembelian">Go To Page</a>
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-grid4" style="background: #<?PHP echo random_color(); ?> !important">
							<div class="icon">
								<i class="glyphicon glyphicon-remove" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Keluar</h3>
								<h4> X </h4>
							</div>
							<a href="logout.php" onClick="return konfirmasi('Yakin Ingin Keluar Dari Sistem?')">Yakin Ingin Keluar?</a>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="clearfix"> </div>
			</div>
<?PHP } ?>            
            <div class="main-page">
				<div class="four-grids">
					<div class="col-md-3 four-grid">
						<div class="four-grid1" style="background: #<?PHP echo random_color(); ?> !important">
							<div class="icon">
								<i class="glyphicon glyphicon-print" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Laporan Stock Bahan</h3>
								<h4> <?PHP echo $row_bahan ?> Data  </h4>
							</div>
							<a href="halaman.php?tag=laporanbahan">Go To Page</a>
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-grid1" style="background: #<?PHP echo random_color(); ?> !important">
							<div class="icon">
								<i class="glyphicon glyphicon-print" aria-hidden="true" style="background:#90C !important"></i>
							</div>
							<div class="four-text">
								<h3>Laporan Penjualan</h3>
								<h4> <?PHP echo $row_penjualan ?> Data  </h4>
							</div>
							<a href="halaman.php?tag=laporanpenjualan">Go To Page</a>
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-grid3" style="background: #<?PHP echo random_color(); ?> !important">
							<div class="icon">
								<i class="glyphicon glyphicon-print" aria-hidden="true" style="background:#F06 !important"></i>
							</div>
							<div class="four-text">
								<h3>Laporan Pembelian</h3>
								<h4> <?PHP echo $row_pembelian ?> Data  </h4>
							</div>
							<a href="halaman.php?tag=laporanpembelian">Go To Page</a>
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-grid4" style="background: #<?PHP echo random_color(); ?> !important">
							<div class="icon">
								<i class="glyphicon glyphicon-print" aria-hidden="true" style="background:#093 !important"></i>
							</div>
							<div class="four-text">
								<h3>Laporan Profit</h3>
								<h4> <?PHP echo $row_penjualan ?> Data </h4>
							</div>
							<a href="halaman.php?tag=laporanprofit">Go To Page</a>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="clearfix"> </div>
			</div>