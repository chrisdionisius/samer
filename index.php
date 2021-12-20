<?PHP
session_start();
include "php/connect.php";
$msg = "";
	if(isset($_POST['btn_login'])){
			$username_akun=$_POST['username_akun'];
			$password_akun=$_POST['password_akun'];

				$sql=mysqli_query($id_mysql,"SELECT * FROM akun WHERE username_akun='$username_akun' and password_akun='$password_akun' ");
				while($r=mysqli_fetch_array($sql)){
					$hakakses_akun= $r['hakakses_akun'];
					$username_akun= $r['username_akun'];
					$id_akun=  $r['id_akun'];
				}	
				$cout=mysqli_num_rows($sql);
					if($cout>0){
						$row=mysqli_fetch_array($sql);
							if($row['type']=='viewonly')
								$msg="Login berhasil!.....";	
							else
								$_SESSION['id_akun']=$id_akun;
								$_SESSION['username_akun']=$username_akun;
								$_SESSION['hakakses_akun']=$hakakses_akun;
							?><script>window.location="halaman.php";</script><?PHP
							}
					
					else
							$msg="Incorrect Username Or Password";
			
	}

?>


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
<link rel="icon" href="favicon.ico" type="image/x-icon" >
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
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

</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
    
				<div class="login-form" style="margin-bottom:3em !important;">
					<h4> Sistem Analisis Menu Restaurant</h4>
					<center><img src="images/logo.png" style="margin-top: 1em; margin-bottom: 1em"></center>
					<form method="post" action="">
						<input type="text" id="username_akun" name="username_akun" placeholder="Nama Akun" required autocomplete="off">
						<input type="password" class="pass" name="password_akun" id="password_akun" placeholder="Kata Sandi" required autocomplete="off">
						<div class="clearfix"></div>
						<button class="btn btn-info btn-block" type="submit" name="btn_login" id="btn_login">Sign in</button>
					</form>
				</div>
                <center><?PHP echo $msg; ?></center>
	</div>
</body>
</html>