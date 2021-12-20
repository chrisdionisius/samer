<?PHP
function CheckKey($query) {
	$s="172.13.0.2";
	$u="root";
	$p="root";
	$ids_mysql=mysqli_connect ($s, $u, $p);
	$cekdata=mysqli_query($ids_mysql,$query);
	echo $query;
	if(mysqli_num_rows($cekdata)>0) {
		return true; 
	}
	else {
		return false;
	}
}
?>