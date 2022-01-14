<!-- Header -->
<header id="header" class="ex-2-header" style="padding-top: 0;display: flex; justify-content: center; align-items: center;">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1>Selamat Datang</h1>
				<p>Di aplikasi sigampang </p>

				<!-- Sign Up Form -->
				<div class="form-container">
					<form id="logInForm" data-toggle="validator" data-focus="false">
						<div class="d-flex justify-content-center mb-4 mt-3">
							<img src="<?= base_url('assets/images/logo.png') ?>" alt="" style="height: 100px;width: auto;">
						</div>
						<div class="form-group">
							<input type="text" class="form-control-input" id="i-username" required>
							<label class="label-control" for="i-username">Username</label>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<input type="text" class="form-control-input" id="i-password" required>
							<label class="label-control" for="lpassword">Password</label>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<button type="submit" class="form-control-submit-button">Masuk</button>
						</div>
						<div class="form-message">
							<div id="lmsgSubmit" class="h3 text-center hidden"></div>
						</div>
					</form>
				</div> <!-- end of form container -->
				<!-- end of sign up form -->

			</div> <!-- end of col -->
		</div> <!-- end of row -->
	</div> <!-- end of container -->
</header> <!-- end of ex-header -->
<!-- end of header -->
