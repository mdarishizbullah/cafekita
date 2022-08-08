<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Muhammad Daris Hizbullah, Haizpro">
    <meta name="description" content="Sistem Informasi Cafe">
    <meta name="theme-color">
    <link rel="apple-touch-icon" href="./asset/default.png">
	<link href="./asset/default.png" rel="icon">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Cafe Kita
    </title>
  </head>
  <?php
	include "php/conn.php";
	include "php/helper.php";

	$sql = "SELECT * FROM produk ORDER BY id_paccess ASC";
	$dataProduct = $conn->query($sql);

	?>
  <body class="container-fluid">
	<div id="cafeKita" style="display: block;">
    <div id="home" style="display: block;">
      <div class="fixed-top">
        <div class="row mb-3 bg-transparent">
          <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
              <a class="nav-link">
                <input type="search" class="form-control" id="inputanKu" onkeyup="mencari()" placeholder="Cari makanan & minuman..."/>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <br>
      <br>
      <div class="container-fluid mt-2 px-0">
        <div class="row row-cols-2" id="itemProduk">
         <!-- for looping-->
		  <?php 
			if ($dataProduct->num_rows > 0) {
			while($row = mysqli_fetch_object($dataProduct)) {?>
            <section class="col bg-light rounded card mt-1 px-0">
              <img src="./asset/menu/<?= $row->prd_image ?>" class="card-img-top rounded">
              <div class="py-0">
                <p class="mb-0 text-center" id="new_text" style="display: none;"><b><?= ucwords(strtolower($row->id_pkategori)) ?></b>
                </p>
				<p class="mb-0 text-center" id="new_texta"><a><?= ucwords(strtolower($row->prd_nama)) ?></a>
                </p>
                <div class="container-fluid justify-content-center">
                  <div class="row">
                    <p class="small col-8 px-4 mt-2"><?= rupiah($row->prd_harga) ?>
                    </p>
					<input id="namaProduk" class="d-none" value="<?= $row->prd_nama?>"></input>
					<input id="hargaProduk" class="d-none" value="<?= $row->prd_harga?>"></input>
					<input id="picProduk" class="d-none" value="<?= $row->prd_image?>"></input>
					<input id="idProduk" class="d-none" value="<?= $row->id_product?>"></input>
                    <button type="button" class="btn btn-outline-none col-3 mt-0" onClick="tambahKeranjang(<?= $row->id_product?>, '<?= ucwords(strtolower($row->prd_nama))?>', '<?= $row->prd_harga?>', '<?= $row->prd_image?>','<?= ucwords(strtolower($row->id_pkategori))?>', 1)">
                      <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                      </svg>
                    </button>   
                    <div class="col-1">
                    </div>
                  </div>
                </div>
              </div>
            </section>
		  <?php }
			}
			?>
        </div>
      </div>
    </div>
    
  <div class="container" id="menuKeranjang" style="display: none;">
    <!-- Shopping Cart Section-->
	<div id="isiKeranjang">
				<!-- untuk inject-->
				
	
	<div class="row">


                            <div class="col-6 text-muted mt-2">Total</div>
                            <input class="col-6 col-md-12 text-end text-md-center border-0 bg-white" id="total" style="display: none;" disabled>
							<input class="col-6 col-md-12 text-end text-md-center border-0 bg-white" id="totalC" disabled>
								<select class="form-select mt-2" id="notMakan">
  <option value="makan ditempat">Makan ditempat</option>
  <option value="dibawa pulang">Dibawa pulang</option>
</select>
						<select class="form-select mt-2" id="mejaB">
  <?php
for ($x = 1; $x <= 30; $x++) {?>
  <option value="<?= $x ?>" ><?= $x?></option>
  <?php }
?>
</select>
	<div id="responB"></div>
	<select class="form-select mt-2" id="mPBayar" onchange="bCash()">
  <option value="cash">Cash</option>
  <option value="cashless">Cashless</option>
</select>
<div class="row" id="cBCash" style="display: block;">
<div class="form-floating mt-2 col-12">
  <input type="number" class="form-control" id="uSiap" onkeyup="kembalian()">
  <label for="floatingInput">Masukan Jumlah Uang Cash</label>
</div>
<p id="notif0" class="text-danger"></p>
<label for="floatingInput">Kembaliannya </label>
<input class="col-12 col-md-12 text-end text-md-center border-0 bg-white" id="sisaKembalian" style="display: none;" disabled>
<input class="col-12 col-md-12 text-end text-md-center border-0 bg-white" id="sisaKembalianC" disabled>

</div>
	<input type="number" class="form-control" id="waktuMs"  style="display: none;" disabled>
  <input type="text" class="form-control" id="hasilSemua"  style="display: none;" disabled>
  <input type="text" class="form-control" id="idPelanggan"  style="display: none;" disabled>
							<div class="col-12 text-end">
	<button class="btn btn-primary mt-2" onClick="mDataTrans()">Pesan sekarang</button>
	<button class="btn btn-primary mt-2" onClick=" mKerjaanA()" style="display: none;">test</button>
  </div>
                          </div>
						  
	</div>
	</div>
	<div id="job" class="container" style="display: none;">
	<audio id="myAudio">
	  <source src="asset/DEPAPEPE-Hi-D.mp3" type="audio/mpeg">
	</audio>
	 <input type="text" class="form-control" onchange="perubahanData()" id="perubahanDataS"  style="display: none;" disabled>
      <div class="fixed-bottom px-4 py-3 d-none">
        <button type="button" class="btn btn-ligth" id="tombolP" onclick="printAja()" >Print</button>
      </div>
	<input type="text" class="form-control" id="updateJob"  style="display: none;" disabled>
		<?php
	$dataPesananBersyarat = "SELECT * FROM nota WHERE not_ver='1' ";
	$dataPesanan = $conn->query($dataPesananBersyarat);
	if ($dataPesanan->num_rows > 0) {
		while($row = mysqli_fetch_object($dataPesanan)) {
	?>
	<div class="row">
		<p class="small col-2 mb-0 mt-2" style="display: none;"><?= $row->id_nota ?></p>
		<p class="small col-5 mb-0 mt-2"><?= $row->not_waktu ?></p>
		<p class="small col-3 mb-0 mt-2">Meja :<?= $row->not_meja ?></p>
		<p class="small col-2 mb-0 mt-2"style="display: none;"><?= $row->not_tmakan ?></p>
		<p class="small col-1 mb-0 mt-2" style="display: none;"><?= $row->not_jPembayaran ?></p>
		<p class="small col-3 mb-0 mt-2" style="display: none;">Kembalian : Rp. <?= rupiah(($row->not_uCash)-($row->not_total))
		?></p>
		<div class="container col-1" onclick="lunas(<?= $row->id_nota ?>);removeItem(this); removeItem(document.getElementById('untukDPrint<?= $row->id_nota ?>'));">
		<button class="btn btn-success btn-sm mb-1 mt-1">lunas</button>
		</div>
		<div class="container col-1" onclick="detailPesanan()" style="display: block;">
		<button class="btn btn-primary btn-sm mb-1 mt-1" style="display: none;">detail</button>
		</div>
		<hr class="mt-0 mb-0">
	</div>
	<div style="display: block;">
      <div class="row" id="untukDPrint<?= $row->id_nota ?>">
        <p class="text-center mt-0 mb-0" onclick="printAja()" style="display: none;">JS-89.Corp</p>
      </div>
      <div class="row">
        <p class="text-center mt-0 mb-0" onclick="printAja()" style="display: none;">Jalan Siliwangi No 109</p>
      </div>
      <div class="row">
        <p class="text-center mt-0 mb-1" onclick="printAja()" style="display: none;">081385571413</p>
      </div>
      <div class="row">
        <hr class="border border-dark opacity-50 mb-1" style="display: none;">
      </div>
      <div class="row">
        <p class="mt-0 mb-0" id="notaPr">Nomor Nota: <?= $row->id_nota ?></p>
      </div>
      <div class="row">
        <p class="mt-0 mb-0" id="tmakan"><?= $row->not_tmakan ?></p>
      </div>
      <div class="row">
        <p class="mt-0 mb-0" id="nmrMja" style="display: none;">Nomor Meja: <?= $row->not_meja ?></p>
      </div>
      <div class="row">
        <p class="mt-0 mb-0" style="display: none;">Kasir     : Admin</p>
      </div>
      <div class="row">
        <p class="mt-0" id="notWkt" style="display: none;"><?= $row->not_waktu ?></p>
      </div>
	  <?php
	  $idPush = $row->id_nota;
	$isiDariNota = "SELECT * FROM transaksi t JOIN produk p ON t.id_produk = p.id_product WHERE id_nota='$idPush ' ";
	$dataNota = $conn->query($isiDariNota);
	if ($dataNota->num_rows > 0) {
		while($rows = mysqli_fetch_object($dataNota)) {
	?>
      <div class="row">
        <p class="mt-0 mb-0"><?= $rows-> prd_nama?></p>
      </div>
      <div class="row">
        <p class="mt-0 mb-0 col-8"><?= $rows-> trs_quantity?> x <?= rupiah($rows-> prd_harga)?></p>
        <p class="text-end mt-0 mb-0 col-4"><?php $rph=($rows-> trs_quantity)*($rows-> prd_harga); echo rupiah($rph); ?></p>
      </div>
      <?php 
	  
	  }
			}
			?>
      <div class="row">
        <p class="text-end mt-3 mb-0">Total : <?= rupiah($row-> not_total)?></p>
      </div>
      <div class="row">
        <p class="text-end mt-0 mb-0">Bayar Tunai : <?= rupiah($row-> not_uCash)?></p>
      </div>
      <div class="row">
        <p class="text-end mt-0 mb-2">Kembali : <?= rupiah(($row->not_uCash)-($row-> not_total)) ?></p>
      </div>
      <br>
    </div>
	<?php }
			}
			?>
	</div>
	
	<div id="pen" class="container" style="display: none;">
	<br>
	  <br>
	  <br>
	   <br>
	  <br>
		<?php
	$dataPesananBersyarat2 = "SELECT * FROM nota WHERE not_ver='2' ";
	$dataPesanan2 = $conn->query($dataPesananBersyarat2);
	if ($dataPesanan2->num_rows > 0) {
		while($row = mysqli_fetch_object($dataPesanan2)) {
	?>
	<div class="row">
		<p class="small col-2 mb-0 mt-2"><?= $row->id_nota ?></p>
		<p class="small col-2 mb-0 mt-2" ><?= $row->not_waktu ?></p>
		<p class="small col-1 mb-0 mt-2">Meja :<?= $row->not_meja ?></p>
		<p class="small col-2 mb-0 mt-2"><?= $row->not_tmakan ?></p>
		<p class="small col-1 mb-0 mt-2"><?= $row->not_jPembayaran ?></p>
		<p class="small col-3 mb-0 mt-2">Kembalian : Rp. <?= rupiah(($row->not_uCash)-($row->not_total))
		?></p>
		<div class="container col-1" onclick="lunas(<?= $row->id_nota ?>);removeItem(this);window.print()">
		<button class="btn btn-success btn-sm mb-1 mt-1">lunas</button>
		</div>
		<div class="container col-1" style="display: none;">
		<button class="btn btn-primary btn-sm mb-1 mt-1">detail</button>
		</div>
		<hr class="mt-0 mb-0">
	</div>
	<?php }
			}
			?>
			<div class="fixed-top">
			<div class="row mb-0 bg-light">
          <ul class="nav nav-pills nav-fill col-4">
            <li class="nav-item">
              <a class="nav-link">
                <label>Cash</label>
              </a>
            </li>
          </ul>
		  <ul class="nav nav-pills nav-fill col-4">
            <li class="nav-item">
              <a class="nav-link">
                <label>Cashless</label>
              </a>
            </li>
          </ul>
		  <ul class="nav nav-pills nav-fill col-4">
            <li class="nav-item">
              <a class="nav-link">
                <label>Total Pendapatan</label>
              </a>
            </li>
          </ul>
        </div>
        <div class="row mb-0 mt-0 py-0 bg-light">
          <ul class="nav nav-pills nav-fill col-4">
            <li class="nav-item">
              <a class="nav-link">
                <input type="number" class="form-control" id="totalCash" disabled>
				<input type="text" class="form-control text-center" id="tanggal" style="display: none;" disabled>
              </a>
            </li>
          </ul>
		  <ul class="nav nav-pills nav-fill col-4">
            <li class="nav-item">
              <a class="nav-link">
                <input type="number" class="form-control" id="totalCashless"  disabled>
              </a>
            </li>
          </ul>
		  <ul class="nav nav-pills nav-fill col-4">
            <li class="nav-item">
              <a class="nav-link">
                <input type="number" class="form-control" id="totalHarian"  disabled>
              </a>
            </li>
          </ul>
        </div>
      </div>
	  
	</div>
  <!--bottom menu-->
  <br>
  <br>
  <div class="fixed-bottom">
    <div class="container card">
      <ul class="nav nav-pills nav-fill">
        <li class="nav-item">
          <button class="nav-link active rounded-pill" id="iHome" onClick="pindahHome()">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
              <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
            </svg>
          </button>
        </li>
        <li class="nav-item" style="display: none;">
          <a class="nav-link" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-egg-fried" viewBox="0 0 16 16">
              <path d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
              <path d="M13.997 5.17a5 5 0 0 0-8.101-4.09A5 5 0 0 0 1.28 9.342a5 5 0 0 0 8.336 5.109 3.5 3.5 0 0 0 5.201-4.065 3.001 3.001 0 0 0-.822-5.216zm-1-.034a1 1 0 0 0 .668.977 2.001 2.001 0 0 1 .547 3.478 1 1 0 0 0-.341 1.113 2.5 2.5 0 0 1-3.715 2.905 1 1 0 0 0-1.262.152 4 4 0 0 1-6.67-4.087 1 1 0 0 0-.2-1 4 4 0 0 1 3.693-6.61 1 1 0 0 0 .8-.2 4 4 0 0 1 6.48 3.273z"/>
            </svg>
          </a>
        </li>
        <li class="nav-item" style="display: none;">
          <a class="nav-link" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-cup-straw" viewBox="0 0 16 16">
              <path d="M13.902.334a.5.5 0 0 1-.28.65l-2.254.902-.4 1.927c.376.095.715.215.972.367.228.135.56.396.56.82 0 .046-.004.09-.011.132l-.962 9.068a1.28 1.28 0 0 1-.524.93c-.488.34-1.494.87-3.01.87-1.516 0-2.522-.53-3.01-.87a1.28 1.28 0 0 1-.524-.93L3.51 5.132A.78.78 0 0 1 3.5 5c0-.424.332-.685.56-.82.262-.154.607-.276.99-.372C5.824 3.614 6.867 3.5 8 3.5c.712 0 1.389.045 1.985.127l.464-2.215a.5.5 0 0 1 .303-.356l2.5-1a.5.5 0 0 1 .65.278zM9.768 4.607A13.991 13.991 0 0 0 8 4.5c-1.076 0-2.033.11-2.707.278A3.284 3.284 0 0 0 4.645 5c.146.073.362.15.648.222C5.967 5.39 6.924 5.5 8 5.5c.571 0 1.109-.03 1.588-.085l.18-.808zm.292 1.756C9.445 6.45 8.742 6.5 8 6.5c-1.133 0-2.176-.114-2.95-.308a5.514 5.514 0 0 1-.435-.127l.838 8.03c.013.121.06.186.102.215.357.249 1.168.69 2.438.69 1.27 0 2.081-.441 2.438-.69.042-.029.09-.094.102-.215l.852-8.03a5.517 5.517 0 0 1-.435.127 8.88 8.88 0 0 1-.89.17zM4.467 4.884s.003.002.005.006l-.005-.006zm7.066 0-.005.006c.002-.004.005-.006.005-.006zM11.354 5a3.174 3.174 0 0 0-.604-.21l-.099.445.055-.013c.286-.072.502-.149.648-.222z"/>
            </svg>
          </a>
        </li>
        <li class="nav-item">
          <button type="button" onclick="pindahCart()" id="iCart" class="nav-link position-relative">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
              <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
            </svg>
            <span id="keranjangA" class="position-absolute top-0 start-50 badge rounded-pill bg-danger" style="display: none;">
              
            </span>
          </button> 
        </li>
        <li class="nav-item" style="display: none;">
          <button class="nav-link" data-bs-toggle="modal" data-bs-target="#myModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
              <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
            </svg>
          </button>
        </li>
		<li class="nav-item" style="display: block;">
          <button type="button" onclick="pindahJob()" id="iJob" class="nav-link position-relative">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
			  <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z"/>
			</svg>
			
            <span id="kerjaanA" class="position-absolute top-0 start-50 badge rounded-pill bg-danger" style="display: block;">
              
            </span>
          </button> 
        </li>
		<li class="nav-item" style="display: block;">
          <button type="button" onclick="pindahPen()" id="iPen" class="nav-link position-relative">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
  <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
  <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
  <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
</svg>
            <span id="pendapatanA" class="position-absolute top-0 start-50 badge rounded-pill bg-danger" style="display: block;">
              
            </span>
          </button> 
        </li>
      </ul>
    </div>
  </div>
</div>

<script src="js/bootstrap.bundle.min.js" charset="utf-8">
</script>
<script src="js/main.js">
</script>
</body>
</html>