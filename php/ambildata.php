<?php
include ("connect.php");

if (isset($_GET['id_invoice'])){
	$id_invoice = $_GET['id_invoice'];
	$json = '{"messages": {';
	$get_review = mysqli_query($id_mysql,"SELECT tt.*, ti.id_invoice, tb.nama_barang FROM tabel_barang tb, tabel_transaksi tt, tabel_invoice ti WHERE tt.id_transaksi=ti.idtransaksi_invoice and tt.idbarang_transaksi=tb.id_barang and ti.id_invoice='$id_invoice'");
	$json .= '"pesan":[ ';
		
		while($x =mysqli_fetch_array($get_review)){
		$json .= '{';
		$json .= '"id_invoice": "' . $x['id_invoice'] . '",
			"nama_barang": "' . $x['nama_barang'] . '",
			"jml_barang": "' . $x['jmlbarang_transaksi'] . '",
			"harga_barang": "' . $x['hrgbarang_transaksi'] . '",
		},';
		}

	$json = substr($json,0,strlen($json)-1);
	$json .= ']';
	$json .= '}}';
	echo $json;
}


if (isset($_GET['id_invoice_total'])){
	$id_invoice = $_GET['id_invoice_total'];
	$json = '{"messages": {';
	$get_review = mysqli_query($id_mysql,"SELECT tt.*, ti.id_invoice, tb.nama_barang FROM tabel_barang tb, tabel_transaksi tt, tabel_invoice ti WHERE tt.id_transaksi=ti.idtransaksi_invoice and tt.idbarang_transaksi=tb.id_barang and ti.id_invoice='$id_invoice'");
	$json .= '"pesan":[ ';
		
		while($x =mysqli_fetch_array($get_review)){
		$json .= '{';
		$json .= '"id_invoice": "' . $x['id_invoice'] . '",
			"nama_barang": "' . $x['nama_barang'] . '",
			"jml_barang": "' . $x['jmlbarang_transaksi'] . '",
			"harga_barang": "' . $x['hrgbarang_transaksi'] . '",

		},';
		}
	$json = substr($json,0,strlen($json)-1);
	$json .= ']';
	$json .= '}}';
	echo $json;
}

if (isset($_GET['id_cust_total'])){
	$id_invoice = $_GET['id_cust_total'];
	$json = '{"messages": {';
	$get_review = mysqli_query($id_mysql,"SELECT tp.nama, tp.alamat, tp.kota, tp.kode_post, tp.telepon, tp.bank, tp.no_rekening FROM  tabel_invoice ti, tabel_pengunjung tp WHERE ti.id_invoice='$id_invoice' and ti.idpengunjung_invoice=tp.Id_pengunjung");
	$json .= '"pesan":[ ';
		
		while($x =mysqli_fetch_array($get_review)){
		$json .= '{';
		$json .= '"nama_pengunjung": "' . $x['nama'] . '",
			"alamat_pengunjung": "' . $x['alamat'] . '",
			"kota_pengunjung": "' . $x['kota'] . '",
			"kodepos_pengunjung": "' . $x['kode_post'] . '",
			"notlp_pengunjung": "' . $x['telepon'] . '",
			"bank_pengunjung": "' . $x['bank'] . '",
			"norekening_pengunjung": "' . $x['no_rekening'] . '",

		},';
		}
	$json = substr($json,0,strlen($json)-1);
	$json .= ']';
	$json .= '}}';
	echo $json;
}

//$get_review = mysqli_query($id_mysql,"SELECT tp.nama, tp.alamat, tp.kota, tp.kode_post, tp.telepon, tp.bank, tp.no_rekening FROM  tabel_invoice ti, tabel_pengunjung tp WHERE ti.id_invoice='$id_invoice' and ti.idpengunjung_invoice=tp.Id_pengunjung")or die('Gagal');


if(isset($_GET['id_alamat'])){
	$getdata_alamat = mysqli_fetch_array(mysqli_query($id_mysql,"select jt.reg from ongkoskirim_jne_tarif jt, alamat a where jt.prov_tuju_id=a.provinsi_alamat and jt.kota_tuju_id=a.kokab_alamat and a.id_alamat='$_GET[id_alamat]'"));
	echo $getdata_alamat['reg'];
}
?>