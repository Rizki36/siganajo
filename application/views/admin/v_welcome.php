<div style="margin-top: 80px;">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<div class="card" style="min-height: 100%;">
					<div class="card-body">
						<h3>Total User</h3>
						<h3 class="mt-3 text-right"><?= $unverified ?></h3>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card" style="min-height: 100%;">
					<div class="card-body">
						<h3>User Belum Terverifikasi</h3>
						<h3 class="mt-3 text-right"><?= $unverified ?></h3>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card" style="min-height: 100%;">
					<div class="card-body">
						<h3>User Terverifikasi</h3>
						<h3 class="mt-3 text-right"><?= $verified ?></h3>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-lg-4">
				<a style="text-decoration: none;" href="<?= base_url('admin/penyitaan') ?>">
					<div class="card" style="min-height: 100%;">
						<div class="card-body">
							<h3>Penyitaan Belum dibaca</h3>
							<h3 class="mt-3 text-right"><?= $unread_penyitaan ?></h3>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
