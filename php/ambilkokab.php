<?php
include ("connect.php");

if (isset($_GET['provinsi'])){    
   	$provinsi = $_GET['provinsi'];
	$kokab = mysqli_query($id_mysql,"SELECT kota_id, kota_nama FROM ongkoskirim_jne_kota WHERE kota_prov_id='$provinsi'");
	echo "<option value=\"\" selected></option>";
	while($k = mysqli_fetch_array($kokab)){
		echo "<option value=\"".$k['kota_id']."\">".$k['kota_nama']."</option>\n";
	}  
} 

?>