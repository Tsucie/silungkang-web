<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home - Silungkang Venue</title>
	<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="route" content="{{ url('/') }}">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('assets') }}/css/owl.carousel.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css" />
	<link rel="stylesheet" href="{{ asset('assets') }}/css/owl.theme.default.min.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="{{ asset('assets') }}/css/plugins.min.css" />
	<link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css" />
	<link rel="stylesheet" href="{{ asset('assets') }}/css/exclude.css" />
	<link rel="stylesheet" href="{{ asset('assets') }}/css/style.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/css/responsive.css" />
  <link type="text/css" href="{{ asset('assets') }}/vendor/notifIt/css/notifIt.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Stardos+Stencil&display=swap" rel="stylesheet">
</head>
<body>
	<main>
		{{-- Include customer page main header --}}
		@include('layouts.headers.csmainheader')
		<!-- Slider Start -->
		<div class="home-slider owl-carousel js-fullheight">
			<div class="slider-item js-fullheight" style="background-image: url({{ asset('assets') }}/images/aula.JPG)">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
						<div class="col-md-12 ftco-animate">
							<div class="text w-100 text-center">
								<h2>Best Place for Event</h2>
								<h1 class="mb-3">Aula Venue</h1>
								<h2>By Silungkang Venue</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="slider-item js-fullheight" style="background-image: url({{ asset('assets') }}/images/workspace.jpg)">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
						<div class="col-md-12 ftco-animate">
							<div class="text w-100 text-center">
								<h2>Best Place for Work</h2>
								<h1 class="mb-3">Workspace</h1>
								<h2>By Silungkang Venue</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="slider-item js-fullheight" style="background-image: url({{ asset('assets') }}/images/meeting-room.jpg)">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
						<div class="col-md-12 ftco-animate">
							<div class="text w-100 text-center">
								<h2>Best Place for Meeting</h2>
								<h1 class="mb-3">meeting room</h1>
								<h2>By Silungkang Venue</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- About Section -->
		<section>
			<div class="gap" id="about-section">
				<div class="container">
					<div class="bst-ida-wrp">
						<div class="row">
							<div class="col-md-7">
								<div class="bst-ida-inf">
									<span>About Us</span>
									<h2 class="font-weight-bold">
										Yayasan Persatuan Keluarga Silungkang
									</h2>
									<p itemprop="description">
										Persatuan Keluarga Silungkang (PKS) adalah organisasi
										perantau Minang asal daerah Silungkang, Yayasan Persatuan
										Keluarga Silungkang adalah organisasi daerah dari Sumatera
										Barat yang memiliki kantor di Jakarta dengan fungsi untuk
										membantu dan menjadi tempat berkumpulnya para perantauan
										yang berada di Jabodetabek. Selain sebagai tempat
										berkumpulnya para perantau, Yayasan ini juga memiliki sebuah usaha, yaitu penyewaan gedung serbaguna dan penjualan
										barang-barang
										khas daerah.

									</p>
									<h4 itemprop="headline">Bisnis yang dikelola</h4>
									<ul>
										<li>Penyewaan Gedung</li>
										<li>Penyewaan Ruangan</li>
										<li>Penjualan Barang Khas Daerah</li>
										<li>Penyewaan Prasarana Event</li>
									</ul>
								</div>
							</div>
							<div class="col-md-5">
								<div id="carousel-about" class="carousel carousel-dark slide" data-bs-ride="carousel">
									<div class="carousel-inner">
										<div class="carousel-item active">
											<img src="{{ asset('assets') }}/images/wedding2.jpg" class="d-block w-100" alt="wedding_img" />
										</div>
										<div class="carousel-item">
											<img src="{{ asset('assets') }}/images/wedding.jpeg" class="d-block w-100" alt="wedding-img" />
										</div>
										<div class="carousel-item">
											<img src="{{ asset('assets') }}/images/meeting-room.jpg" class="d-block w-100" alt="workspace-img" />
										</div>
									</div>
									<button class="carousel-control-prev" type="button" data-bs-target="#carousel-about" data-bs-slide="prev">
										<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										<span class="visually-hidden">Previous</span>
									</button>
									<button class="carousel-control-next" type="button" data-bs-target="#carousel-about" data-bs-slide="next">
										<span class="carousel-control-next-icon" aria-hidden="true"></span>
										<span class="visually-hidden">Next</span>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Promo Section -->
		<section>
			<div class="gap" id="promo-section">
				<div class="tem-wrp2 black-layer2 opc95">
					<div class="fixed-bg" style="background-image: url({{ asset('assets') }}/images/promo.jpg)"></div>
					<div class="container">
						<div class="sec-title text-center">
							<h3 itemprop="headline">Promo</h3>
							<span>Penawaran Terbaru untuk anda</span>
						</div>
						<div class="srv-wrp2 remove-ext3">
							<div class="row" id="promo-list"></div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Venue Section -->
		<section>
			<div class="gap" id="venue-section">
				<div class="container">
					<div class="sec-title text-center">
						<h3 itemprop="headline">Our Venue</h3>
						<span>Pilihan Venue untuk anda</span>
					</div>
					<div class="remove-ext3" id="venue-list">
					</div>
				</div>
			</div>
		</section>
		<!-- Produk Section -->
		<section>
			<div class="gap gray-bg2" id="produk-section">
				<div class="text-center" style="display: flex; justify-content: center;">
					<h4 style="font-family: 'Italianno', cursive; font-style: oblique;">La </h4>
					<h1 itemprop="headline" style="font-family: 'Stardos Stencil', cursive;">&nbsp;T A C O N A</h1>
				</div>
				<div class="sec-title text-center">
                  <h4 style="font-family: 'Italianno', cursive;">&nbsp;&nbsp;&nbsp;&nbsp; Kuliner &amp; Oleh-oleh Silungkang</h4>
                </div>
				<div class="prtfl-fltrs-wrp text-center">
					<ul class="fltr-btns">
						<li class="active"><a data-filter="*" data-title="pc-link" href="#" id="produk-all" itemprop="url">Semua<i></i></a></li>
						<li><a data-filter=".fltr-itm1" data-title="pc-link" href="#" id="produk-songket" itemprop="url">Songket<i></i></a></li>
						<li><a data-filter=".fltr-itm2" data-title="pc-link" href="#" id="produk-hiasan" itemprop="url">Hiasan<i></i></a></li>
						<li><a data-filter=".fltr-itm3" data-title="pc-link" href="#" id="produk-food" itemprop="url">Makanan Khas<i></i></a></li>
						<li><a data-filter=".fltr-itm4" data-title="pc-link" href="#" id="produk-lainnya" itemprop="url">Lainnya<i></i></a></li>
					</ul>
					<div class="fltr-dta style3 remove-ext3">
						<div class="row masonry mrg20" id="pdct-list"></div>
					</div>
				</div>
			</div>
		</section>
		<!-- Contact Section -->
		<section>
			<div class="gap" id="kontak-section">
				<div class="container">
					<div class="cnt-mp-inf-wrp">
						<div class="row">
							<div class="col-md-7 col-sm-12 col-lg-7">
								<div class="loc-mp" id="loc-mp">
									<iframe
										src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2565314587473!2d106.73426219999999!3d-6.2298725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f0aff244d85f%3A0xb6a62c0ea0e12686!2sGedung%20Pertemuan%20Silungkang!5e0!3m2!1sid!2sid!4v1627375618438!5m2!1sid!2sid"
										width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
								</div>
							</div>
							<div class="col-md-5 col-sm-12 col-lg-5">
								<div class="cnt-inf-wrp">
									<div class="sec-title">
										<span>Wujudkan Eventmu bersama </span>
										<h3 itemprop="headline">Silungkang Venue</h3>
									</div>
									<ul class="cnt-inf-lst">
										<li><span>Business Address</span>Jl. Gotong Royong Jl. Ciledug Raya No.Kav. 13, RT.004/RW.009, Larangan Indah, Kec.
											Larangan, Kota Tangerang, Banten 15154</li>
										<li><span>Business Email</span><a href="#" title="Email" itemprop="url">silungkangvenue@gmail.com</a></li>
									</ul>
									<div class="cnt-inf-btns">
										<a href="https://www.facebook.com/profile.php?id=100073047533769" title="Facebook" itemprop="url" target="_blank"><i class="fa fa-facebook"></i></a>
										<a href="#" title="Twitter" itemprop="url" target="_blank"><i class="fa fa-twitter"></i></a>
										<a href="https://www.instagram.com/gedungsilungkang/" title="Instagram" itemprop="url" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
										<a href="#" title="WhatsApp" itemprop="url" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		{{-- Include customer page footer --}}
		@include('layouts.footers.csmainfooter')
	</main>
  <div class="sticky-chat-button">
  <!-- telegram chat button  start -->
  <a class="telegram-chat-button" href="https://t.me/admsilungkang_bot" title="Ingin bertanya sesuatu?" target="_blank">
    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32">
      <path fill="#fff" d="M29.919 6.163l-4.225 19.925c-0.319 1.406-1.15 1.756-2.331 1.094l-6.438-4.744-3.106 2.988c-0.344 0.344-0.631 0.631-1.294 0.631l0.463-6.556 11.931-10.781c0.519-0.462-0.113-0.719-0.806-0.256l-14.75 9.288-6.35-1.988c-1.381-0.431-1.406-1.381 0.288-2.044l24.837-9.569c1.15-0.431 2.156 0.256 1.781 2.013z"/>
    </svg>
  </a>
  <!-- telegram chat button end -->
  </div>
	<script>
		function fungsiHiasan() {
			document.getElementById("#produk-hiasan").click();
		}
	</script>
</body>
{{-- Include customer page javascripts --}}
@include('csjavascript')
</html>