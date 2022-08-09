const keranjangBox = document.getElementById('isiKeranjang');
const keranjang = [];
const d = new Date();
let waktu = d.getTime();

//deklarasi berdasarkan id
let loading = document.getElementById("loading");
let cafeKita = document.getElementById("cafeKita");
let kerjaanA = document.getElementById("cafeKita");

setInterval(myTimer, 100);

function myTimer() {
	const d = new Date();
  document.getElementById("waktuMs").setAttribute('value', d.getTime());
}

function mencari(){
	  // Declare variables
  let input, filter, div, a, section, i, txtValue;
  input = document.getElementById('inputanKu');
  filter = input.value.toUpperCase();
  div = document.getElementById("itemProduk");
  section = div.getElementsByTagName('section');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < section.length; i++) {
    a = section[i].getElementsByTagName("a")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      section[i].style.display = "";
    } else {
      section[i].style.display = "none";
    }
  }
}

function tambahKeranjang(id, nama, harga, pic, cat, jumlah){
	if (keranjang.some(checkId)){
	let jumlah3 = new Number(jumlah);
	let jumlah2 = new Number(document.getElementById("jumlah"+id).value);
	let jumlah1 = jumlah2 + jumlah3;
	document.getElementById("keranjangA").style.display='block'
	document.getElementById("keranjangA").innerHTML = keranjang.length
	document.getElementById("jumlah"+id).setAttribute('value', jumlah1)
	menghitung(id)
	kembalian()
	}else{
		keranjang.push(id)
		document.getElementById("keranjangA").style.display='block'
		document.getElementById("keranjangA").innerHTML = keranjang.length
		createList(id, nama, harga, pic, cat, jumlah)
		menghitung(id)
		kembalian()
	}
	
	function checkId(x) {
	  return x == id
	}
}

function createList(id, nama, harga, pic, cat, jumlah) {
	let newProduk = `<div class="row row-cols-12" name="hapus"> 
										<a class="col-1 px-1"   onclick="removeItem(this);hapusData(${id})"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
					  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					<div class="col-11"></div>
					<div class="row">
					<img src="./asset/menu/${pic}" class="rounded-3 col-3">
						<div class="row col-9">
						<div class="row">
						 <p class=" small mb-0" >${cat}</p>
						 </div>
						<div class="row">
						 <p class=" small mb-0" >${nama}</p>
						 <input name="idP" class="d-none" value="${id}"></input>
						 </div>
						<div class="row">
						<p class="col-12 small mb-0" >Harga Rp. ${ parseFloat(harga).toLocaleString('en')}</p>
						<input class="col-12 small d-none" id="harga${id}" value="${harga}">
						</div>
						</div>
					</div>
                          <div class="row align-items-center">
                            <div class="col-7 col-sm-9 text-muted">Quantity</div>
                            <div class="col-5 col-sm-3 col-md-12">
                              <div class="d-flex align-items-center">
                                <input class="form-control text-center border-0 border-md input-items" name="jumlah" id="jumlah${id}" type="number" value="${jumlah}" onkeyup="menghitung(${id})" onchange="menghitung(${id})">
                              </div>
                            </div>
							
                          </div>
						  <div class="row">
                            <div class="col-6 text-muted" style="display: none;">Sub Total</div>
                            <input class="col-6 text-end input-items border-0 bg-white mt-1" name="subTotal" id="hasil${id}" onload="menghitung(${id})" style="display: none;" disabled>
               
					</div>
					<div class="row">
                            <div class="col-6 text-muted">Sub Total</div>
                            <input class="col-6 text-end input-items border-0 bg-white mt-1"  id="hasilC${id}" disabled>
               
					</div>`
					
	keranjangBox.insertAdjacentHTML('afterbegin', newProduk);
}

function menghitung(id){
	var input = document.getElementById('jumlah'+id).value;
	var harga = document.getElementById('harga'+id).value;
	var hasil = input * harga;
	let hasilBox = document.getElementById("hasil"+id);
	let hasilBoxC = document.getElementById("hasilC"+id);
	hasilBox.setAttribute('value', hasil);
	hasilBoxC.setAttribute('value', ("Rp. ")+parseFloat(hasil).toLocaleString('en'));
	keranjang.forEach(mencobaHitung);
	kembalian()
}

function mencobaHitung(index, item){
	let bokKeranjang = document.getElementsByName('subTotal');
	let haBK = new Number
	let totalSemua =0;
	for (index = 0; index < keranjang.length; index++) {
	let haBK = new Number(bokKeranjang[index].value);
	let a = totalSemua += haBK;
	document.getElementById("total").setAttribute('value', totalSemua);
	document.getElementById("totalC").setAttribute('value', ("Rp. ")+parseFloat(totalSemua).toLocaleString('en'));
	}
}


function removeItem(el) {
	el.parentElement.remove();
}

function hapusData(id) {
	let index = keranjang.indexOf(id)
	keranjang.shift(index)
	mencobaHitung()
	kembalian()
	document.getElementById("keranjangA").innerHTML = keranjang.length
	if (keranjang.length == 0){
		document.getElementById("keranjangA").style.display='none'
		document.getElementById("total").setAttribute('value', 0)
		kembalian()
	}
}


function bCash(){
	if(document.getElementById("mPBayar").value == "cash"){
		document.getElementById("cBCash").style.display='block';
	}else{
		document.getElementById("cBCash").style.display='none';
	}
}

function kembalian(){
	let c = document.getElementById("total").value;
	let b = document.getElementById("uSiap").value;
	let a = b - c;
	document.getElementById("sisaKembalian").setAttribute('value', a);
	document.getElementById("sisaKembalianC").setAttribute('value', ("Rp. ")+parseFloat(a).toLocaleString('en'));
}

function pindahCart(){
	let b = document.getElementById("iHome");
	b.classList.remove("active");
	let a = document.getElementById("iCart");
	a.classList.add("active");
	let c = document.getElementById("iJob");
	c.classList.remove("active");
	let d = document.getElementById("iPen");
	d.classList.remove("active");
	document.getElementById("menuKeranjang").style.display='block';
	document.getElementById("home").style.display='none';
	document.getElementById("job").style.display='none';
	document.getElementById("pen").style.display='none';
}

function pindahHome(){
	let b = document.getElementById("iHome");
	b.classList.add("active");
	let a = document.getElementById("iCart");
	a.classList.remove("active");
	let c = document.getElementById("iJob");
	c.classList.remove("active");
	let d = document.getElementById("iPen");
	d.classList.remove("active");
	document.getElementById("menuKeranjang").style.display='none';
	document.getElementById("home").style.display='block';
	document.getElementById("job").style.display='none';
	document.getElementById("pen").style.display='none';
}

function pindahJob(){
	let b = document.getElementById("iHome");
	b.classList.remove("active");
	let a = document.getElementById("iCart");
	a.classList.remove("active");
	let c = document.getElementById("iJob");
	c.classList.add("active");
	let d = document.getElementById("iPen");
	d.classList.remove("active");
	document.getElementById("menuKeranjang").style.display='none';
	document.getElementById("home").style.display='none';
	document.getElementById("job").style.display='block';
	document.getElementById("pen").style.display='none';
	document.getElementById("myAudio").pause(); 
}

function pindahPen(){
	let b = document.getElementById("iHome");
	b.classList.remove("active");
	let a = document.getElementById("iCart");
	a.classList.remove("active");
	let c = document.getElementById("iJob");
	c.classList.remove("active");
	let d = document.getElementById("iPen");
	d.classList.add("active");
	document.getElementById("menuKeranjang").style.display='none';
	document.getElementById("home").style.display='none';
	document.getElementById("job").style.display='none';
	document.getElementById("pen").style.display='block';
}

function hapusDataSemua() {
	let kDLebih = keranjang.length;
	let ele = document.getElementsByName("hapus");
	let len = ele.length;
	parentNode = ele[0].parentNode;
	for(b = 0; b<len;b++){
		parentNode.removeChild(ele[0]);
	}
	keranjang.splice(0, kDLebih);
	mencobaHitung();
	kembalian();
	document.getElementById("keranjangA").innerHTML = keranjang.length;
	if (keranjang.length == 0){
		document.getElementById("keranjangA").style.display='none';
		document.getElementById("total").setAttribute('value', 0);
		kembalian();
	}
}


function mDataTrans(){
	let boxJumlah = document.getElementsByName('jumlah');
	let idP = document.getElementsByName('idP');
	let text = "";
	for(i = 0; i<keranjang.length;i++){
	let hD = text += "&idProduk"+i+"="+(idP[i].value)+"&jumlahProduk"+i+"="+(boxJumlah[i].value);
	 let hasilSemua = document.getElementById("hasilSemua");
		hasilSemua.setAttribute('value', hD);
	}
	let meja = document.getElementById("mejaB").value;
	let uCash = document.getElementById("uSiap").value;
	let jPembayaran = document.getElementById("mPBayar").value;
	let notWaktu = d.toDateString()+" "+d.toLocaleTimeString();
	let idPelanggan = document.getElementById("idPelanggan").value;
	let notMakan = document.getElementById("notMakan").value;
	let totalNota = document.getElementById("total").value;
	let hasilData = document.getElementById("hasilSemua").value;
	let idSesuai = document.getElementById("waktuMs").value;
	let lengKer = keranjang.length;
	let xhr = new XMLHttpRequest();
	xhr.open('POST','php/ajax3.php',true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onload = function(){
		console.log(this.responseText);
		}
	xhr.send("id="+idSesuai+"&meja="+meja+hasilData+"&lengKer="+lengKer+"&totalNota="+totalNota+"&notMakan="+notMakan+"&idPelanggan="+idPelanggan+"&notWaktu="+notWaktu+"&uCash="+uCash+"&jPembayaran="+jPembayaran);
	hapusDataSemua();
	pindahHome();
	alert("Terimaksih sudah memesan di Cafe Kita. no pemesanan : "+idSesuai+", Harap untuk tidak berpindah meja petugas kami akan mendatangi meja :"+meja);
	document.getElementById("total").setAttribute('value', 0);
	document.getElementById("totalC").setAttribute('value', ("Rp. ")+parseFloat(0).toLocaleString('en'));
}

function lunas(idL){
	let idLunas = idL;
	let xhr = new XMLHttpRequest();
	xhr.open('POST','php/ajax4.php',true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onload = function(){
		//console.log(this.responseText);
		}
	xhr.send("idLunas="+idLunas);
	alert(idLunas+" telah lunas");
}

function checkCash(){
	let jenisPembayaran = document.getElementById("mPBayar");
	let uangCashYangDisiapkan = document.getElementById("uSiap");
	if(jenisPembayaran.value = "cash"){
		if (uangCashYangDisiapkan.value == 0){
			document.getElementById("notif0").style.display='block';
			document.getElementById("notif0").innerHTML = "Tidak bisa mengisi dengan angka 0";
		}else if(uangCashYangDisiapkan.value === ""){
			document.getElementById("notif0").style.display='block';
			document.getElementById("notif0").innerHTML = "Isi terlebih dahulu jumlah uang cash yang disiapkan";
		}else{
			document.getElementById("notif0").style.display='none';
		}
	}
}

function countJob(){
	getText("php/jumlahpesanan.php");
	
	async function getText(file) {
  let myObject = await fetch(file);
  let myText = await myObject.text();
  if (myText == "0"){
	  document.getElementById("kerjaanA").style.display='none';
  }else{
	  document.getElementById("kerjaanA").style.display='block';
  document.getElementById("kerjaanA").innerHTML = myText;
  document.getElementById("updateJob").setAttribute('value', myText);
  document.getElementById("perubahanDataS").setAttribute('value', myText);
  }
}
	//async function getText(file).then(response => response.json()).then(response=>
	//	document.getElementById("kerjaanA").innerHTML = response;
	//);
}

setInterval(countJob, 1000);
setInterval(pendapatan, 1000);
setInterval(checkUpdated, 900);
setInterval(checkJenisPembayaran, 1000);

//setInterval(dataPesanan, 1000);

function pendapatan() {
  let xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
	  let pendapatanHarian = this.responseText;
    document.getElementById("pendapatanA").innerHTML = pendapatanHarian;
    }
  xhttp.open("GET", "php/pendapatan.php", true);
  xhttp.send();
}

function checkUpdated() {
  let xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
	  let jumlahDataBaru = this.responseText;
		let dataYangAda =  document.getElementById("updateJob").value;
		if (dataYangAda == jumlahDataBaru){
			//document.getElementById("myAudio").play(); 
			//document.getElementById("myAudio").pause(); 
			//console.log("data sama");
			//console.log("ini data yang ada"+dataYangAda);
			//console.log("ini data yang baru"+jumlahDataBaru);
		}else{
			document.getElementById("myAudio").play(); 
			//console.log("data baru");
			//console.log("ini data yang ada"+dataYangAda);
			//console.log("ini data yang baru"+jumlahDataBaru);
		}
    }
  xhttp.open("GET", "php/jumlahpesanan.php", true);
  xhttp.send();
}

/*function detailPesanan(id) {
	let id_nota = id;
  let xhttp = new XMLHttpRequest();
  xhttp.open('POST','php/datapesanan.php',true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.onload = function() {
	  let dataPesananTerkini = JSON.parse(this.responseText);
	  console.log(dataPesananTerkini.not_tmakan);
	  //console.log(dataPesananTerkini);
    }
  xhttp.send("id_nota="+id_nota);
}*/

function detailPesanan(id){
	document.getElementById("untukDPrint").style.display='block';
	/*let id_nota = id;
	let xhr = new XMLHttpRequest();
	xhr.open('POST','php/datapesanan.php',true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onload = function(){
		let notaP = JSON.parse(this.responseText);
		
		document.getElementById("notaPr").innerHTML = "Nomor Nota: "+notaP[0].id_nota;
		document.getElementById("tmakan").innerHTML = notaP.not_tmakan;
		document.getElementById("nmrMja").innerHTML = "Nomor Meja: " +notaP.not_meja;
		document.getElementById("notWkt").innerHTML = "Tanggal: " +notaP.not_waktu;
		
		console.log(notaP);
		
		}
	xhr.send("id_nota="+id_nota);*/
}

function checkJenisPembayaran(){
	let tipePembayaran = document.getElementById("mPBayar").value;
	if (tipePembayaran == "cashless"){
	document.getElementById("uSiap").setAttribute('value', document.getElementById("total").value);
	//console.log("ini bayar cashless"+document.getElementById("total").value);
	}
	/*let id_nota = id;
	let xhr = new XMLHttpRequest();
	xhr.open('POST','php/datapesanan.php',true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onload = function(){
		let notaP = JSON.parse(this.responseText);
		
		document.getElementById("notaPr").innerHTML = "Nomor Nota: "+notaP[0].id_nota;
		document.getElementById("tmakan").innerHTML = notaP.not_tmakan;
		document.getElementById("nmrMja").innerHTML = "Nomor Meja: " +notaP.not_meja;
		document.getElementById("notWkt").innerHTML = "Tanggal: " +notaP.not_waktu;
		
		console.log(notaP);
		
		}
	xhr.send("id_nota="+id_nota);*/
}

function perubahanData(){
	//document.getElementById("myAudio").play();
	//console.log("ada perubahan"+document.getElementById("perubahanDataS").value);
}

document.addEventListener('DOMContentLoaded', function() {
	
  // code
})

// check notification permission
const notificationPermission = new Promise((response) => {
    if ("Notification" in window) {
        if (Notification.permission === "granted") {
            response({
                status: "success",
                text: "user accepted the notifications",
            })
        } else {
            Notification.requestPermission()
                .then(permission => {
                    if (permission === "granted") {
                        response({
                            status: "success",
                            text: "user accepted the notifications",
                        })
                    } else {
                        response({
                            status: "error",
                            text: "User did not accept notifications",
                        })
                    }
                })
        }
    } else {
        response({
            status: "error",
            text: "This Browser does not support desktop notification !",
        })
    }
})

let userPermission;
async function checkNotificationPermission() {
    const permission = await notificationPermission;
    if (permission.status === "success") {
        userPermission = true;
    } else {
        console.warn("User did not accept notifications !");
        userPermission = false;
    }
}
checkNotificationPermission();

let jam = 1000 * 60 * 60;
setInterval(tanggal, 1000);

function tanggal(){
	let tanggalSekarang = d.toDateString();
	document.getElementById("tanggal").setAttribute('value', tanggalSekarang);
}

/*setInterval(pendapatanHarianCash, 1000);

function pendapatanHarianCash(){
	let tanggalDiambil = document.getElementById("tanggal").value;
	let xhr = new XMLHttpRequest();
	xhr.open('POST','php/pendpatanhariancash.php',true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onload = function(){
		//console.log(this.responseText);
		//let jumlahUangCash =JSON.parse(this.responseText).then(response => );
		console.log(jumlahUangCash);
		}
	xhr.send("tanggalDiambil="+tanggalDiambil);
}*/