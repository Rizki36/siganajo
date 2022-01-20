<!-- Header -->
<header id="header" class="ex-2-header" style="padding-top: 0;display: flex; justify-content: center; align-items: center;">
	<div class="container my-5">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<h1>Buat Akun</h1>
				<p>- Siganajo -</p>
				<!-- Sign Up Form -->
				<div class="card">
					<div class="card-body">
						<form id="signup">
							<div class="d-flex justify-content-center mb-4 mt-3">
								<img src="<?= base_url('assets/images/logo.png') ?>" alt="" style="height: 100px;width: auto;">
							</div>
							<div class="row text-left">
								<div class="form-group col-6">
									<label class="d-block text-left" for="username">Nama</label>
									<input name="name" type="text" class="form-control" id="name" required>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-6">
									<label class="d-block text-left" for="username">Username</label>
									<input name="username" type="text" class="form-control" id="username" required>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-6">
									<label class="d-block text-left" for="password">Password</label>
									<input name="password" type="password" class="form-control" id="password" required>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-6">
									<label class="d-block text-left" for="passconf">Konfirmasi Password</label>
									<input name="passconf" type="passconf" class="form-control" id="passconf" required>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-12">
									<label class="d-block text-left" for="origin_unit">Unit Asal</label>
									<input name="origin_unit" type="text" class="form-control" id="origin_unit" required>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-12">
									<label class="d-block text-left" for="file">File</label>
									<input name="file" type="file" style="min-height: 45px !important;" accept=".pdf" class="form-control" id="file" required>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-12">
									<button type="submit" class="form-control-submit-button">Masuk</button>
								</div>
							</div>
						</form>
					</div>
				</div>

			</div> <!-- end of col -->
		</div> <!-- end of row -->
	</div> <!-- end of container -->
</header> <!-- end of ex-header -->
<!-- end of header -->
