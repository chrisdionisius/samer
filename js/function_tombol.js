function ubah(){
	$('.ubah_data').show();
	$('.batal_data').show();
	$('.tambah_data').hide();
	$('.tambah_data').attr('disabled', true);
	$('.reset_data').hide();
	$('.reset_data').attr('disabled', true);
}

function batal(){
	$('.tambah_data').show();
	$('.tambah_data').attr('disabled', false);
	$('.reset_data').show();
	$('.reset_data').attr('disabled', false);
	$('.ubah_data').hide();
	$('.batal_data').hide();
	
}

function ubah_akun(){
	$('.ubah_akun').show();
	$('.batal_akun').show();
	$('.tambah_akun').hide();
	$('.tambah_akun').attr('disabled', true);
	$('.reset_akun').hide();
	$('.reset_akun').attr('disabled', true);
}

function batal_akun(){
	$('.tambah_akun').show();
	$('.tambah_akun').attr('disabled', false);
	$('.reset_akun').show();
	$('.reset_akun').attr('disabled', false);
	$('.ubah_akun').hide();
	$('.batal_akun').hide();
	
}

function ubah_bank(){
	$('.ubah_bank').show();
	$('.batal_bank').show();
	$('.tambah_bank').hide();
	$('.tambah_bank').attr('disabled', true);
	$('.reset_bank').hide();
	$('.reset_bank').attr('disabled', true);
}

function batalbank(){
	$('.tambah_bank').show();
	$('.tambah_bank').attr('disabled', false);
	$('.reset_bank').show();
	$('.reset_bank').attr('disabled', false);
	$('.ubah_bank').hide();
	$('.batal_bank').hide();
	
}

//cek jika mau dihapus, ya atau tidak
function konfirmasi(msg){
	if (confirm(msg)) {
		return true;
	}else {
		return false;
	}
};

//menghapus pesan datda dikelola
function hidemsg(){
	setTimeout(
		function() {
		document.getElementById("pesan").innerHTML = "";
		}, 3000);
}
 

//bagian kode untuk auto titik angka
function formatAngka2(angka) {
 if (typeof(angka) != 'string') angka = angka.toString();
 var reg = new RegExp('([0-9]+)([0-9]{3})');
 while(reg.test(angka)) angka = angka.replace(reg, '$1,$2');
 return angka;
}


function close_modal(){
	document.getElementById("close_modal").click();
}


function formatAngka(objek, separator) {
	  a = objek.value;
	  b = a.replace(/[^\d]/g,"");
	  c = "";
	  panjang = b.length;
	  j = 0;
	  for (i = panjang; i > 0; i--) {
	    j = j + 1;
	    if (((j % 3) == 1) && (j != 1)) {
	      c = b.substr(i-1,1) + separator + c;
	    } else {
	      c = b.substr(i-1,1) + c;
	    }
	  }
	  objek.value = c;
}


function Tambah_Bahan(id_bahan, nama_bahan, harga_bahan){
	var hitung = document.getElementById("table_pembelian").rows.length-1;
	var has=false;
	if (hitung==0){
		has = true;
		
		var row = $(document.createElement('tr')).attr("id", 'DivTambah' + hitung);
		row = '<tr class="border_bottom">'+
		'<td>'+hitung+'</td>'+
		'<td hidden>'+id_bahan+'<input type="text" name="idbahan_detailpembelian[]" id="idbahan_detailpembelian[]" value="'+id_bahan+'" rel="Aid_bahan" readonly /></td>'+
		'<td>'+nama_bahan+'</td>'+
		'<td>'+formatAngka2(harga_bahan)+'<input type="text" name="harga_detailpembelian[]" id="harga_detailpembelian[]" value="'+harga_bahan+'" readonly hidden/></td>'+
		'<td><input type="text" name="qty_detailpembelian[]" id="qty_detailpembelian[]" value="" required/></td>'+
		'<td><center><input name="chk[]" type="checkbox" id="chk[]" class ="checkbox" /></center></td>'+
		'</tr>';
		$(row).insertBefore("#tabelbaru");
		close_modal();
		
	}else{
		var inpZ = $(document.getElementById("table_pembelian")).find('tbody input[rel = Aid_bahan]');
			$(inpZ).each(function() {
				if(this.value==id_bahan){
					has=true;
					alert ("BAHAN INI SUDAH TERDAPAT DALAM TABEL PEMBELIAN");
				}
			});
		if (!has){
			var row = $(document.createElement('tr')).attr("id", 'DivTambah' + hitung);
			row = '<tr class="border_bottom">'+
			'<td>'+hitung+'</td>'+
			'<td hidden>'+id_bahan+'<input type="text" name="idbahan_detailpembelian[]" id="idbahan_detailpembelian[]" value="'+id_bahan+'" rel="Aid_bahan" readonly /></td>'+
			'<td>'+nama_bahan+'</td>'+
			'<td>'+formatAngka2(harga_bahan)+'<input type="text" name="harga_detailpembelian[]" id="harga_detailpembelian[]" value="'+harga_bahan+'" readonly hidden/></td>'+
			'<td><input type="text" name="qty_detailpembelian[]" id="qty_detailpembelian[]" onKeyPress="return goodchars(event,\'1234567890\',this)" required/></td>'+
			'<td><center><input name="chk[]" type="checkbox" id="chk[]" class ="checkbox" /></center></td>'+
			'</tr>';
			$(row).insertBefore("#tabelbaru");
			close_modal();
				
		}
	}	
};

function Tambah_Menu(id_menu, nama_menu, harga_menu){
	var hitung = document.getElementById("table_penjualan").rows.length-1;
	var has=false;
	if (hitung==0){
		has = true;
		
		var row = $(document.createElement('tr')).attr("id", 'DivTambah' + hitung);
		row = '<tr class="border_bottom">'+
		'<td>'+hitung+'</td>'+
		'<td hidden>'+id_menu+'<input type="text" name="idmenu_detailpenjualan[]" id="idmenu_detailpenjualan[]" value="'+id_menu+'" rel="Aid_menu" readonly /></td>'+
		'<td>'+nama_menu+'</td>'+
		'<td>'+formatAngka2(harga_menu)+'<input type="text" name="harga_detailpenjualan[]" id="harga_detailpenjualan[]" value="'+harga_menu+'" readonly hidden/></td>'+
		'<td><input type="text" name="qty_detailpenjualan[]" id="qty_detailpenjualan[]" value="" required/></td>'+
		'<td><center><input name="chk[]" type="checkbox" id="chk[]" class ="checkbox" /></center></td>'+
		'</tr>';
		$(row).insertBefore("#tabelbaru");
		close_modal();
		
	}else{
		var inpZ = $(document.getElementById("table_penjualan")).find('tbody input[rel = Aid_menu]');
			$(inpZ).each(function() {
				if(this.value==id_menu){
					has=true;
					alert ("MENU INI SUDAH TERDAPAT DALAM TABEL PENJUALAN");
				}
			});
		if (!has){
			var row = $(document.createElement('tr')).attr("id", 'DivTambah' + hitung);
			row = '<tr class="border_bottom">'+
			'<td>'+hitung+'</td>'+
			'<td hidden>'+id_menu+'<input type="text" name="idmenu_detailpenjualan[]" id="idmenu_detailpenjualan[]" value="'+id_menu+'" rel="Aid_menu" readonly /></td>'+
			'<td>'+nama_menu+'</td>'+
			'<td>'+formatAngka2(harga_menu)+'<input type="text" name="harga_detailpenjualan[]" id="harga_detailpenjualan[]" value="'+harga_menu+'" readonly hidden/></td>'+
			'<td><input type="text" name="qty_detailpenjualan[]" id="qty_detailpenjualan[]" onKeyPress="return goodchars(event,\'1234567890\',this)" required/></td>'+
			'<td><center><input name="chk[]" type="checkbox" id="chk[]" class ="checkbox" /></center></td>'+
			'</tr>';
			$(row).insertBefore("#tabelbaru");
			close_modal();
				
		}
	}	
};



