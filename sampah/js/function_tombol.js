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

function getFile(angka){
	clear_image();
	document.getElementById("gambar").click();
	document.getElementById("gambar").addEventListener('change', handleFileSelect, false);
	var fileInput = document.getElementById("gambar");
	
	function handleFileSelect(evt) {
			var reader = new FileReader();
			var imageType = /^(?:image\/jpg|image\/jpeg)$/i;
			
			var files = evt.target.files;
			var file = fileInput.files[0];
			var f = files[0];
			var size = document.getElementById("gambar").files[0].size;
			
			if (file.type.match(imageType)) {
				if(size<1048576){	
					reader.onload = (function(theFile) {
						
						return function(e) {
						document.getElementById("btnupload").innerHTML = ['<img src="', e.target.result,'" title="', theFile.name, '" width="100" />'].join('');
						};
					
					})(f);
					 	reader.readAsDataURL(f);
				}else{
					alert('Picture Size Max 1MB');
					fileInput.value="";
				}
			}else{
				alert('Only JPG/JPEG Format Allowed');
				fileInput.value="";
			};
	}
 }
 
function clear_image(){
	$('#btnupload img').attr('src','images/camera.png'); 
}


//bagian kode untuk auto titik angka
function formatAngka2(angka) {
 if (typeof(angka) != 'string') angka = angka.toString();
 var reg = new RegExp('([0-9]+)([0-9]{3})');
 while(reg.test(angka)) angka = angka.replace(reg, '$1,$2');
 return angka;
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



function getFile2(){
	document.getElementById("bukti_invoice").click();
	document.getElementById("bukti_invoice").addEventListener('change', handleFileSelect, false);
	var fileInput = document.getElementById("bukti_invoice");
	
	function handleFileSelect(evt) {
			var reader = new FileReader();
			var imageType = /^(?:image\/jpg|image\/jpeg)$/i;
			
			var files = evt.target.files;
			var file = fileInput.files[0];
			var f = files[0];
			var size = document.getElementById("bukti_invoice").files[0].size;
			
			if (file.type.match(imageType)) {
				if(size<1048576){	
					reader.onload = (function(theFile) {
						
						return function(e) {
						};
					
					})(f);
					 	reader.readAsDataURL(f);
				}else{
					alert('Besar Ukuran Gambar Harus Dibawah 1MB');
					fileInput.value="";
				}
			}else{
				alert('Format Gambar Harus JPG/JPEG');
				fileInput.value="";
			};
	}
 }
