<?php 
// memeriksa sudah login atau belum
session_start();

$level=$_SESSION['level'];

if(!isset($_SESSION["level"])){
header("location:../logout.php");
exit;
}

if($_SESSION["level"]!='admin'){
	header("location:../index.php");
exit;
}

// koneksi database
require '../functions.php';


// pagination
// konfigurasi







$produk = query("SELECT * FROM produk ORDER BY produk.id DESC");
  



if(isset($_GET['cari'])){

$produk=cari($_GET["cari"]);

}


$jenisProduk=query("SELECT * FROM jenis_produk");


 ?>

<!doctype html>
<html lang="en">

<head>


	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<!-- Font-Awessome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

	<!-- AOS -->
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


	<!-- icon -->
	<link rel="icon" href="../icon/icon.png">
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Libre+Bodoni:wght@500&family=Montserrat:wght@300;400;500;600&family=Open+Sans:wght@600&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Mono&display=swap"
		rel="stylesheet">
	<title>AllAboutMusic</title>

	<!-- link my css -->
	<!-- <link rel="stylesheet" href="css/main.css"> -->
	<link rel="stylesheet" href="../css/main.css">

</head>

<body class="d-flex flex-column min-vh-100">
	<!-- awal navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">AllAboutMusic</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
				aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarScroll">
				<ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="#">Home</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
							data-bs-toggle="dropdown" aria-expanded="false">
							Shop
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">

							<?php foreach($jenisProduk as $jenis): ?>
							<li><a name="cari" class="dropdown-item"
									href="?cari=<?= $jenis['jenis_produk']; ?>#container"><?= $jenis['jenis_produk']; ?></a></li>
							<?php endforeach; ?>

							<li><a class="dropdown-item" href="index.php#container">All Items</a></li>

						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="dashboard.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link d-lg-none " href="../logout.php" id="logout">Logout</a>
					</li>
				</ul>
				<form class="d-flex" action="" method="post">
					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" autofocus
						autocomplete="off" name="keyword" id="keyword">
					<a class="btn btn-outline-dark" href="index.php#container">Search</a>
				</form>


				<a class="nav-link ms-5 d-lg-block d-none" href="../logout.php" id="logout">Logout</a>

			</div>
		</div>
	</nav>
	<!-- akhir navbar -->




	<!-- awal slide gambar -->
	<div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="../img/slide1.png" class="d-block w-100" alt="slide1">
			</div>
			<div class="carousel-item">
				<img src="../img/slide2.png" class="d-block w-100" alt="slide2">
			</div>
			<div class="carousel-item">
				<img src="../img/slide3.png" class="d-block w-100" alt="slide3">
			</div>
		</div>
	</div>
	<!-- akhir slide gambar -->

	<div id="container" data-aos="fade-up">
		<!-- awal new arrivals -->
		<div class="arrival text-center my-5">
			<span style="border-bottom: 1px solid #555;padding: 3px 0px;letter-spacing: 5px;font-size: 18px;color: #555;">ALL
				ITEMS</span>
		</div>
		<!-- akhir new arrivals -->


		<?php if(empty($produk)): ?>


		<div class="col text-center" style="padding:50px 0 200px 0;">
			<h1 style="color:#a9a9a9;font-family: 'Open Sans', sans-serif;margin-top:120px;text-align:center;">
				Tidak
				Ada Produk</h1>

		</div>


		<?php endif; ?>


		<!-- awal isi produk -->
		<div class="container-fluid">
			<div class="row g-2 ">
				<?php foreach($produk as $row) :?>



				<a href="beli.php?id=<?= $row["id"]?>" id="card" class="mb-5 news-item"
					style="text-decoration:none;color:black;">
					<div id="inner">
						<img id="myImg" src=" ../img/<?= $row["gambar"] ?>" class="card-img-top" alt="<?= $row["kode_produk"] ?>"
							style="height:300px;object-fit:cover;">
					</div>
					<p class="card-title mt-2"><?= $row["nama_produk"] ?></p>
					<p class="card-text">IDR. <?= $row["harga"] ?></p>

				</a>
				<?php endforeach; ?>


			</div>
		</div>
	</div>

	<!-- akhir isi produuk -->





	<!-- awal footer -->
	<div class="border mb-2 mt-auto" style="border-top:black 1px solid;width:90%;margin:auto;"></div>

	<div class="footer container-fluid" id="footer">
		<p><i class="far fa-copyright"></i> 2022 <a href="https://www.instagram.com/rancaagp/" target="_blank"
				style="text-decoration:none;color:black;"> Ranca Gigih Pramudhita</a>.
		</p>
	</div>
	<!-- akhir footer -->




	<!-- AOS -->
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script>
	AOS.init();
	</script>


	<script>
	configObj = {
		"buttonD": "M8 18.568L10.8 21.333 16 16.198 21.2 21.333 24 18.568 16 10.667z",
		"buttonT": "translate(-1148 -172) translate(832 140) translate(32 32) translate(284)",
		"shadowSize": "0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)",
		"roundnessSize": "12px",
		"buttonDToBottom": "24px",
		"buttonDToRight": "24px",
		"selectedBackgroundColor": "#f7f7f7",
		"selectedIconColor": "#091b2a",
		"buttonWidth": "40px",
		"buttonHeight": "40px",
		"svgWidth": "32px",
		"svgHeight": "32px"
	};

	function createButton(obj, pageSimulator) {
		const body = document.querySelector("body");
		backToTopButton = document.createElement("span");
		backToTopButton.classList.add("softr-back-to-top-button");
		backToTopButton.id = "softr-back-to-top-button";
		pageSimulator ? pageSimulator.appendChild(backToTopButton) : body.appendChild(backToTopButton);
		backToTopButton.style.width = obj.buttonWidth;
		backToTopButton.style.height = obj.buttonHeight;
		backToTopButton.style.marginRight = obj.buttonDToRight;
		backToTopButton.style.marginBottom = obj.buttonDToBottom;
		backToTopButton.style.borderRadius = obj.roundnessSize;
		backToTopButton.style.boxShadow = obj.shadowSize;
		backToTopButton.style.color = obj.selectedBackgroundColor;
		backToTopButton.style.backgroundColor = obj.selectedBackgroundColor;
		pageSimulator ? backToTopButton.style.position = "absolute" : backToTopButton.style.position = "fixed";
		backToTopButton.style.outline = "none";
		backToTopButton.style.bottom = "0px";
		backToTopButton.style.right = "0px";
		backToTopButton.style.cursor = "pointer";
		backToTopButton.style.textAlign = "center";
		backToTopButton.style.border = "solid 2px currentColor";
		backToTopButton.innerHTML =
			'<svg class="back-to-top-button-svg" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" > <g fill="none" fill-rule="evenodd"> <path d="M0 0H32V32H0z" transform="translate(-1028 -172) translate(832 140) translate(32 32) translate(164) matrix(1 0 0 -1 0 32)" /> <path class="back-to-top-button-img" fill-rule="nonzero" d="M11.384 13.333h9.232c.638 0 .958.68.505 1.079l-4.613 4.07c-.28.246-.736.246-1.016 0l-4.613-4.07c-.453-.399-.133-1.079.505-1.079z" transform="translate(-1028 -172) translate(832 140) translate(32 32) translate(164) matrix(1 0 0 -1 0 32)" /> </g> </svg>';
		backToTopButtonSvg = document.querySelector(".back-to-top-button-svg");
		backToTopButtonSvg.style.verticalAlign = "middle";
		backToTopButtonSvg.style.margin = "auto";
		backToTopButtonSvg.style.justifyContent = "center";
		backToTopButtonSvg.style.width = obj.svgWidth;
		backToTopButtonSvg.style.height = obj.svgHeight;
		backToTopButton.appendChild(backToTopButtonSvg);
		backToTopButtonImg = document.querySelector(".back-to-top-button-img");
		backToTopButtonImg.style.fill = obj.selectedIconColor;
		backToTopButtonSvg.appendChild(backToTopButtonImg);
		backToTopButtonImg.setAttribute("d", obj.buttonD);
		backToTopButtonImg.setAttribute("transform", obj.buttonT);
		if (!pageSimulator) {
			backToTopButton.style.display = "none";
			window.onscroll = function() {
				if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
					backToTopButton.style.display = "block";
				} else {
					backToTopButton.style.display = "none";
				}
			};
			backToTopButton.onclick = function() {
				document.body.scrollTop = 0;
				document.documentElement.scrollTop = 0;
			};
		}
	};
	document.addEventListener("DOMContentLoaded", function() {
		createButton(configObj, null);
	});
	</script>



	<script src="../js/main.js">
	// ambil elemen2 yang dibutuhkan
	var keyword = document.getElementById('keyword');
	var container = document.getElementById('container');


	// tambahkan event ketika keyboard ditulis
	keyword.addEventListener('keyup', function() {
		// buat object ajax
		var xhr = new XMLHttpRequest();

		// cek kesiapan ajax
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				container.innerHTML = xhr.responseText;
			}
		}

		// eksekusi ajax
		xhr.open('GET', 'ajax/produk-index.php?keyword=' + keyword.value, true);
		xhr.send();



	});
	</script>



	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
	</script>

	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>