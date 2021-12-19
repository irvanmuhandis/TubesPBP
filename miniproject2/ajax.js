//initialize
var judul = document.getElementById('search_title');
var hasil = document.getElementById('result');
var title = document.getElementById('cari_judul');
var result = document.getElementById('hasil');

function forIndex(){
  //add event when title is typed
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
      hasil.innerHTML = xmlhttp.responseText;
    }
  }
  xmlhttp.open('GET', 'cari_buku.php?judul=' + judul.value, true);
  xmlhttp.send();
}

function forIndex2(){
  //add event when title is typed in index2
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
      result.innerHTML = xmlhttp.responseText;
    }
  }
  xmlhttp.open('GET', 'cari_buku2.php?judul=' + title.value, true);
  xmlhttp.send();
}

function pilihBuku(idt){
  var xhr = new XMLHttpRequest();

  xhr.open('GET', 'buku.php?id=' + idt)

  xhr.onload = function() {
      buku.innerHTML = xhr.responseText
  }

  xhr.send()
}

function cekNim(nim){
  var xhr = new XMLHttpRequest();

  xhr.open('GET', 'verifikasi_anggota.php?nim=' + nim)

  xhr.onload = function() {
      error_anggota.innerHTML = xhr.responseText
  }

  xhr.send()
}

function callAjax(url,inner){
	var xmlhttp = getXMLHTTPRequest();
	xmlhttp.open('GET', url, true);
	if(inner!=""){
			xmlhttp.onreadystatechange = function() {
				if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
					 document.getElementById(inner).innerHTML = xmlhttp.responseText;
					 
				}
				return false;
			}
}
    xmlhttp.send();
}

function cari(str){
	var url = "cari.php?judul="+str;
	var inner = "cari";
	if(str.length==0){
		var inner = "";
	}
	document.getElementById("cari").style.border ="thin solid black"
	callAjax(url,inner);
	
}