<!-- Header -->
<header id="header" class="ex-2-header" style="padding-top: 0;display: flex; justify-content: center; align-items: center;">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1>Selamat Datang</h1>
				<p>Di aplikasi sigenajo </p>

				<!-- Sign Up Form -->
				<div class="form-container">
					<form id="login">
						<div class="d-flex justify-content-center mb-4 mt-3">
							<img src="<?= base_url('assets/images/logo.png') ?>" alt="" style="height: 100px;width: auto;">
						</div>
						<div class="form-group">
							<label class="d-block text-left" for="username">Username</label>
							<input name="username" type="text" class="form-control" id="username" required>
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label class="d-block text-left" for="password">Password</label>
							<input name="password" type="password" class="form-control" id="password" required>
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<button type="submit" class="form-control-submit-button">Masuk</button>
							<?php if (@$is_admin !== true) : ?>
								<a class="d-block mt-2" href="<?= base_url('signup') ?>" style="text-decoration: none;">Daftar</a>
							<?php endif ?>
						</div>
					</form>
				</div> <!-- end of form container -->
				<!-- end of sign up form -->

			</div> <!-- end of col -->
		</div> <!-- end of row -->
	</div> <!-- end of container -->
</header> <!-- end of ex-header -->
<!-- end of header -->