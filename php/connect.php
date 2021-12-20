<?php
/*$server="mysql.idhostinger.com";
$username="u758409488_his";
$password="*pas5w0rd?*";
$id_mysql=mysql_connect ($server, $username, $password);
if (! $id_mysql)
die("tak dapat melakukan koneksi ke server MYSQL");
$db_latihan = mysql_select_db ("u758409488_his",$id_mysql);
if (! $db_latihan)
die("tidak dapat mengakses db latihan");

$host='mysql.idhostinger.com'; $user='u758409488_his'; $pass='*pas5w0rd?*'; $DataBase='u758409488_his';
//fungsi untuk mengkonversi size file
*/

$server="172.13.0.2";
$username="root";
$password="root";
$id_mysql=mysqli_connect ($server, $username, $password);
if (! $id_mysql)
die("tak dapat melakukan koneksi ke server MYSQL");
$db_latihan = mysqli_select_db ($id_mysql,"samer");
if (! $db_latihan)
die("tidak dapat mengakses db latihan");

$host='172.13.0.2'; $user='root'; $pass=''; $DataBase='adseruling';
//fungsi untuk mengkonversi size file

?>