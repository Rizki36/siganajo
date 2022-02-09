    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top top-nav-collapse">
    	<div class="container">

    		<!-- Text Logo - Use this if you don't have a graphic logo -->
    		<a class="navbar-brand logo-text page-scroll" href="<?= base_url('') ?>">Sigenajo</a>

    		<!-- Image Logo -->
    		<!-- <a class="navbar-brand logo-image" href="index.html"><img src="images/logo.svg" alt="alternative"></a> -->

    		<!-- Mobile Menu Toggle Button -->
    		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    			<span class="navbar-toggler-awesome fas fa-bars"></span>
    			<span class="navbar-toggler-awesome fas fa-times"></span>
    		</button>
    		<!-- end of mobile menu toggle button -->

    		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
    			<ul class="navbar-nav ml-auto">
    				<?php if ($_SESSION['role'] === User_Role::user) : ?>
    					<li class="nav-item">
    						<a class="nav-link page-scroll" href="#about">Tentang <span class="sr-only">(current)</span></a>
    					</li>

    					<!-- Dropdown Menu -->
    					<li class="nav-item dropdown">
    						<a class="nav-link dropdown-toggle page-scroll" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">Layanan
    						</a>
    						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
    							<a class="dropdown-item page-scroll" href="#penyitaan">
    								<span class="item-text">
    									Penyitaan
    								</span>
    							</a>
    							<div class="dropdown-items-divide-hr"></div>
    							<a class="dropdown-item page-scroll" href="#penggeledahan">
    								<span class="item-text">
    									Penggeledahan
    								</span>
    							</a>
    							<div class="dropdown-items-divide-hr"></div>
    							<a class="dropdown-item page-scroll" href="#perpanjangan-penahanan">
    								<span class="item-text">
    									Perpanjangan Penahanan
    								</span>
    							</a>
    						</div>
    					</li>
    					<!-- end of dropdown menu -->

    					<li class="nav-item">
    						<a class="nav-link page-scroll" href="#balasan">Balasan</a>
    					</li>

    					<li class="nav-item">
    						<a class="nav-link page-scroll" href="#tutorial">Tutorial</a>
    					</li>

    					<li class="nav-item">
    						<a class="nav-link page-scroll" href="#kontak">Hubungi Kami</a>
    					</li>
    				<?php endif ?>

    				<?php if ($_SESSION['role'] === User_Role::admin) : ?>
    					<li class="nav-item">
    						<a class="nav-link page-scroll" href="<?= base_url('admin/welcome') ?>">Beranda <span class="sr-only">(current)</span></a>
    					</li>
    					<li class="nav-item">
    						<a class="nav-link page-scroll" href="<?= base_url('admin/users') ?>">User</a>
    					</li>
    					<li class="nav-item">
    						<a class="nav-link page-scroll" href="<?= base_url('admin/konten') ?>">Konten </a>
    					</li>

    					<!-- Dropdown Menu -->
    					<li class="nav-item dropdown">
    						<a class="nav-link dropdown-toggle page-scroll" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">Layanan
    						</a>
    						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
    							<a class="dropdown-item page-scroll" href="<?= base_url('admin/penyitaan') ?>">
    								<span class="item-text">
    									Penyitaan
    								</span>
    							</a>
    							<div class="dropdown-items-divide-hr"></div>
    							<a class="dropdown-item page-scroll" href="<?= base_url('admin/penggeledahan') ?>">
    								<span class="item-text">
    									Penggeledahan
    								</span>
    							</a>
    							<div class="dropdown-items-divide-hr"></div>
    							<a class="dropdown-item page-scroll" href="<?= base_url('admin/perpanjangan-penahanan') ?>">
    								<span class="item-text">
    									Perpanjangan Penahanan
    								</span>
    							</a>
    						</div>
    					</li>
    					<!-- end of dropdown menu -->
    				<?php endif ?>
    			</ul>

    			<span class="nav-item">
    				<a class="btn-outline-sm" href="<?= base_url('logout') ?>">Logout</a>
    			</span>
    		</div>
    	</div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->
