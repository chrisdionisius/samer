<?PHP

//Setting berapa jam akan dihapus. Ini 12 Jam.
$hardcodedHours = 2;
//Dapatkan idinvoice dan idtransaksi yang sudah melewaati batas 12 jam dan statusnya Menunggu
$expired_tran = mysqli_fetch_array(mysqli_query($id_mysql,"SELECT id_invoice, idtransaksi_invoice FROM invoice WHERE status_invoice='Waiting Payment' and tglupdate_invoice <= '" . date('Y-m-d H:i:s', strtotime("-$hardcodedHours hours")) . "'"));

//Proses hapus
$idexpired_inv = $expired_tran['id_invoice'];
$idexpired_tran = $expired_tran['idtransaksi_invoice'];
$del_invoice = mysqli_query($id_mysql,"delete from invoice where id_invoice='$idexpired_inv'");
$del_invoice = mysqli_query($id_mysql,"delete from transaksi where id_transaksi='$idexpired_tran'");


?>