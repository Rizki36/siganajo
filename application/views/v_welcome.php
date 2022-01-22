<!-- Header -->
<header id="about" class="header">
	<div class="header-content">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-xl-5">
					<div class="text-container">
						<h1>SIGENAJO</h1>
						<p class="p-large"><?= nl2br($redaksi['utama']) ?></p>
					</div> <!-- end of text-container -->
				</div> <!-- end of col -->
				<div class="col-lg-6 col-xl-7">
					<div class="image-container">
						<div class="img-wrapper">
							<img class="img-fluid" src="<?= base_url('assets/') ?>images/header-software-app.png" alt="alternative">
						</div> <!-- end of img-wrapper -->
					</div> <!-- end of image-container -->
				</div> <!-- end of col -->
			</div> <!-- end of row -->
		</div> <!-- end of container -->
	</div> <!-- end of header-content -->
</header> <!-- end of header -->

<svg class="header-frame" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 310">
	<defs>
		<style>
			.cls-1 {
				fill: #5f4def;
			}
		</style>
	</defs>
	<title>header-frame</title>
	<path class="cls-1" d="M0,283.054c22.75,12.98,53.1,15.2,70.635,14.808,92.115-2.077,238.3-79.9,354.895-79.938,59.97-.019,106.17,18.059,141.58,34,47.778,21.511,47.778,21.511,90,38.938,28.418,11.731,85.344,26.169,152.992,17.971,68.127-8.255,115.933-34.963,166.492-67.393,37.467-24.032,148.6-112.008,171.753-127.963,27.951-19.26,87.771-81.155,180.71-89.341,72.016-6.343,105.479,12.388,157.434,35.467,69.73,30.976,168.93,92.28,256.514,89.405,100.992-3.315,140.276-41.7,177-64.9V0.24H0V283.054Z" />
</svg>
<!-- end of header -->


<!-- Customers -->
<div class="slider-1">
	<div class="container">
		<marquee scrollamount="5"><?= $marquee ?></marquee>
	</div> <!-- end of container -->
</div> <!-- end of slider-1 -->
<!-- end of customers -->


<!-- Details -->
<div id="penyitaan" class="basic-1">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="image-container">
					<img class="img-fluid" src="<?= base_url('assets/') ?>images/description-1.png" alt="alternative">
				</div> <!-- end of image-container -->
			</div> <!-- end of col -->
			<div class="col-lg-6">
				<div class="text-container">
					<h2>Penyitaan</h2>
					<p><?= nl2br($redaksi['penyitaan'], true) ?></p>
					<a class="btn-solid-reg" href="<?= base_url('penyitaan') ?>">Isi Formulir</a>
				</div> <!-- end of text-container -->
			</div> <!-- end of col -->
		</div> <!-- end of row -->
	</div> <!-- end of container -->
</div> <!-- end of basic-1 -->
<!-- end of details -->

<!-- Details -->
<div id="penggeledahan" class="basic-1">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="text-container">
					<h2>Penggeledahan</h2>
					<p><?= nl2br($redaksi['penggeledahan']) ?></p>
					<a class="btn-solid-reg" href="<?= base_url('penggeledahan') ?>">Isi Formulir</a>
				</div> <!-- end of text-container -->
			</div> <!-- end of col -->
			<div class="col-lg-6">
				<div class="image-container">
					<img class="img-fluid" src="<?= base_url('assets/') ?>images/description-3.png" alt="alternative">
				</div> <!-- end of image-container -->
			</div> <!-- end of col -->
		</div> <!-- end of row -->
	</div> <!-- end of container -->
</div> <!-- end of basic-1 -->
<!-- end of details -->


<!-- Details -->
<div id="perpanjangan-penahanan" class="basic-1">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="image-container">
					<img class="img-fluid" src="<?= base_url('assets/') ?>images/description-2.png" alt="alternative">
				</div> <!-- end of image-container -->
			</div> <!-- end of col -->
			<div class="col-lg-6">
				<div class="text-container">
					<h2>Perpanjangan Penahanan</h2>
					<p><?= nl2br($redaksi['perpanjangan_penahanan']) ?></p>
					<a class="btn-solid-reg" href="<?= base_url('perpanjangan-penahanan') ?>">Isi Formulir</a>
				</div> <!-- end of text-container -->
			</div> <!-- end of col -->
		</div> <!-- end of row -->
	</div> <!-- end of container -->
</div> <!-- end of basic-1 -->
<!-- end of details -->


<!-- Video -->
<div id="tutorial" class="basic-2">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<!-- Video Preview -->
				<div class="image-container">
					<div class="video-wrapper">
						<h2>Tutorial</h2>
						<a class="popup-youtube" href="<?= $link_tutorial_yt ?>" data-effect="fadeIn">
							<img class="img-fluid" src="<?= base_url('assets/') ?>images/video-image.png" alt="alternative">
							<span class="video-play-button">
								<span></span>
							</span>
						</a>
					</div> <!-- end of video-wrapper -->
				</div> <!-- end of image-container -->
				<!-- end of video preview -->
				<div class="p-heading"></div>
			</div> <!-- end of col -->
		</div> <!-- end of row -->
	</div> <!-- end of container -->
</div> <!-- end of basic-2 -->
<!-- end of video -->

<!-- Testimonials -->
<div class="slider-2">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">

				<!-- Text Slider -->
				<div class="slider-container">
					<div class="swiper-container text-slider">
						<div class="swiper-wrapper">
							<?php foreach ($images as $img) : ?>
								<!-- Slide -->
								<div class="swiper-slide">
									<img class="img-fluid" style="width: 100%; height:70vh; object-fit: cover;" src="<?= base_url('assets/data/konten/' . $img['file_name']) ?>" alt="alternative">
								</div>
								<!-- end of slide -->
							<?php endforeach ?>

						</div> <!-- end of swiper-wrapper -->

						<!-- Add Arrows -->
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
						<!-- end of add arrows -->

					</div> <!-- end of swiper-container -->
				</div> <!-- end of slider-container -->
				<!-- end of text slider -->

			</div> <!-- end of col -->
		</div> <!-- end of row -->
	</div> <!-- end of container -->
</div> <!-- end of slider-2 -->
<!-- end of testimonials -->


<!-- Newsletter -->
<div id="kontak" class="form">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="text-container">
					<div class="above-heading">----</div>
					<h2><?= $quotes ?></h2>
				</div> <!-- end of text-container -->
			</div> <!-- end of col -->
		</div> <!-- end of row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="icon-container">
					<span class="fa-stack">
						<a href="<?= $sosmed['facebook'] ?>">
							<i class="fas fa-circle fa-stack-2x"></i>
							<i class="fab fa-facebook-f fa-stack-1x"></i>
						</a>
					</span>
					<span class="fa-stack">
						<a href="<?= $sosmed['twitter'] ?>">
							<i class="fas fa-circle fa-stack-2x"></i>
							<i class="fab fa-twitter fa-stack-1x"></i>
						</a>
					</span>
					<span class="fa-stack">
						<a href="<?= $sosmed['whatsapp'] ?>">
							<i class="fas fa-circle fa-stack-2x"></i>
							<i class="fab fa-whatsapp fa-stack-1x"></i>
						</a>
					</span>
					<span class="fa-stack">
						<a href="<?= $sosmed['instagram'] ?>">
							<i class="fas fa-circle fa-stack-2x"></i>
							<i class="fab fa-instagram fa-stack-1x"></i>
						</a>
					</span>
				</div> <!-- end of col -->
			</div> <!-- end of col -->
		</div> <!-- end of row -->
	</div> <!-- end of container -->
</div> <!-- end of form -->
<!-- end of newsletter -->

<!-- Footer -->
<svg class="footer-frame" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 79">
	<defs>
		<style>
			.cls-2 {
				fill: #5f4def;
			}
		</style>
	</defs>
	<title>footer-frame</title>
	<path class="cls-2" d="M0,72.427C143,12.138,255.5,4.577,328.644,7.943c147.721,6.8,183.881,60.242,320.83,53.737,143-6.793,167.826-68.128,293-60.9,109.095,6.3,115.68,54.364,225.251,57.319,113.58,3.064,138.8-47.711,251.189-41.8,104.012,5.474,109.713,50.4,197.369,46.572,89.549-3.91,124.375-52.563,227.622-50.155A338.646,338.646,0,0,1,1920,23.467V79.75H0V72.427Z" transform="translate(0 -0.188)" />
</svg>

<style>
	/* Set the size of the div element that contains the map */
	#map {
		height: 400px;
		/* The height is 400 pixels */
		width: 100%;
		/* The width is the width of the web page */
	}
</style>
<div class="footer">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="footer-col last">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.218457864995!2d112.23412301440057!3d-7.551141494554214!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78401dd2e5bf05%3A0x7b34002ad4c01f28!2sPengadilan%20Negeri%20Jombang!5e0!3m2!1sid!2sid!4v1642152288077!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
				</div>
			</div> <!-- end of col -->
		</div> <!-- end of row -->
	</div> <!-- end of container -->
</div> <!-- end of footer -->
<!-- end of footer -->