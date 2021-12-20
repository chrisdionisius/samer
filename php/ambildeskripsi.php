<?php
include ("connect.php");
	
if (isset($_GET['ids'])){    
   	$id = $_GET['ids'];
	$get_deskripsi = mysqli_query($id_mysql,"SELECT deksripsi_barang FROM barang WHERE id_barang='$id'");
	while($k = mysqli_fetch_array($get_deskripsi)){
	echo $k["deksripsi_barang"];
	}
}
?>