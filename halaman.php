<?PHP
session_start();
include "php/connect.php";
include "php/cekdata.php";
$msg = "";

if(empty($_SESSION['id_akun'])){
	header('location:index.php');
}

// menentukan halaman menu yang ada //
	if (isset($_GET['tag'])){
		$tag=$_GET['tag'];
	}else{
		$tag="beranda";
	}
?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Sistem Analisis Menu Restaurant</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Sistem Analisi Menu Restaurant" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!--skycons-icons-->
<script src="js/skycons.js"></script>
<!--//skycons-icons-->

 <!-- js-->
  <script src="js/bootstrap.js"></script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Comfortaa:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Muli:400,300,300italic,400italic' rel='stylesheet' type='text/css'>
<!--//webfonts-->  
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
<link href="css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="js/jquery.sparkline.min.js"></script>
<style type="text/css" title="currentStyle">		
		@import "css/demo_table_jui.css";
		@import "css/jquery-ui-1.8.4.custom.css";
</style>	
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
<script src="js/function_tombol.js"></script>
<script src="js/formatkey.js"></script>
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--left-fixed -navigation-->
		<div class="sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right dev-page-sidebar mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar" id="cbp-spmenu-s1">
					<div class="scrollbar scrollbar1">
						<ul class="nav" id="side-menu">
							<li>
								<a href="halaman.php" style="color:#FFF !important"><i class="fa fa-home nav_icon"></i>Dashboard</a>
							</li>
                             <?PHP if(($_SESSION['hakakses_akun']=="Super Administrator") || ($_SESSION['hakakses_akun']=="Administrator")){ ?>
                            <li>
								<a href="#"><i class="fa fa-check-square-o nav_icon"></i>Main Menu<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level collapse">
                                <?PHP if($_SESSION['hakakses_akun']=="Super Administrator"){ ?>
									<li>
										<a href="halaman.php?tag=kategori">Data Kategori</a>
									</li>
									<li>
										<a href="halaman.php?tag=pengguna">Data Pengguna</a>
									</li>
									<li>
										<a href="halaman.php?tag=bahan">Data Bahan Makanan</a>
									</li>
									<li>
										<a href="halaman.php?tag=menu">Data Menu</a>
									</li>
                                <?PHP } ?>
									<li>
										<a href="halaman.php?tag=penjualan">Data Penjualan</a>
									</li>
									<li>
										<a href="halaman.php?tag=pembelian">Data Pembelian</a>
									</li>
									<li>
										<a href="halaman.php?tag=analisis">Analisis Menu</a>
									</li>
								</ul>
								<!-- //nav-second-level -->
							</li>
                            <?PHP } ?>
                                <li>
                                    <a href="halaman.php?tag=laporanbahan"><i class="fa fa-file nav_icon"></i>Laporan Stock Bahan Makanan</a>
                                </li>
                                <li>
                                    <a href="halaman.php?tag=laporanpembelian"><i class="fa fa-file nav_icon"></i>Laporan Pembelian</a>
                                </li>
                                <li>
                                    <a href="halaman.php?tag=laporanpenjualan"><i class="fa fa-file nav_icon"></i>Laporan Penjualan</a>
                                </li>
                                <li>
                                    <a href="halaman.php?tag=laporanprofit"><i class="fa fa-file nav_icon"></i>Laporan Profit</a>
                                </li>
                                 <li>
                                    <a href="logout.php" onClick="return konfirmasi('Yakin Ingin Keluar Dari Sistem?')"><i class="fa fa-sign-out nav_icon"></i>Keluar</a>
                                </li>
						</ul>
					</div>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		<div class="sticky-header header-section " style="background:url(images/logo.png) #FFF; background-position:center; background-size:contain; background-repeat:no-repeat;">
			<div class="header-left">
				<!--logo -->
				<div class="logo" hidden>
					<a href="halaman.php"><h1>MEKUAH RESTO</h1></a>
				</div>
				<!--//logo-->
                <div class="clearfix"> </div>
			</div>
			<div class="header-right">
					<!--toggle button start-->
					<div class="search-box"></div>
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<div class="clearfix"> </div>
				<!--toggle button end-->
			</div>
			<div class="clearfix"> </div>	
		</div>
		<!-- //header-ends -->
		<div id="page-wrapper">
		
        <?PHP include "page/".$tag.".php" ?>	
            
		</div>
			<div class="copy-section"><p>&copy; 2016 Ultra Modern. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p></div>
	</div>
			<!-- Classie -->
				<script src="js/classie.js"></script>
				<script>
					var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
						showLeftPush = document.getElementById( 'showLeftPush' ),
						body = document.body;
						
					showLeftPush.onclick = function() {
						classie.toggle( this, 'active' );
						classie.toggle( body, 'cbp-spmenu-push-toright' );
						classie.toggle( menuLeft, 'cbp-spmenu-open' );
						disableOther( 'showLeftPush' );
					};
					

					function disableOther( button ) {
						if( button !== 'showLeftPush' ) {
							classie.toggle( showLeftPush, 'disabled' );
						}
					}
				</script>
			<!-- Bootstrap Core JavaScript --> 
				
				<script type="text/javascript" src="js/bootstrap.min.js"></script>
				<!--scrolling js-->
				<script src="js/jquery.nicescroll.js"></script>
				<script src="js/scripts.js"></script>
				<link href="css/bootstrap.min.css" rel="stylesheet">
</body>
</html>
