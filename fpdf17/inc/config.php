<?php
	
	define('db_host','172.13.0.2');
	define('db_user','root');
	define('db_pass','root');
	define('db_name','samer');
	
	mysqli_connect(db_host,db_user,db_pass);
	mysql_select_db(db_name);
	
	
//fungsi format rupiah 
function format_rupiah($rp) {
	$hasil = "Rp." . number_format($rp, 0, "", ".") . "";
	return $hasil;
}

?>