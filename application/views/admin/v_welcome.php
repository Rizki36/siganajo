<div style="margin-top: 120px;">
	<div class="container">
		<div class="row">
			<?php $list_user = [
				[
					'title' => 'Total User',
					'jml' => $unverified + $verified,
					'link' => base_url('admin/users')
				],
				[
					'title' => 'User Belum Terverifikasi',
					'jml' => $unverified,
					'link' => base_url('admin/users?s=unverified')
				],
				[
					'title' => 'User Terverifikasi',
					'jml' => $verified,
					'link' => base_url('admin/users?s=verified')
				],
			] ?>
			<?php foreach ($list_user as $item) : ?>
				<div class="col-lg-4">
					<a style="text-decoration: none;" href="<?= $item['link'] ?>">
						<div class="card" style="min-height: 100%;">
							<div class="card-body d-flex flex-column justify-content-between">
								<h3><?= $item['title'] ?></h3>
								<div class="mt-4 d-flex align-items-center justify-content-between">
									<i class="fa fa-user fa-2x"></i>
									<h3 class="mt-3">
										<?= $item['jml'] ?>
									</h3>
								</div>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach ?>
		</div>
		<div class="row mt-3">
			<?php $list_unread = [
				[
					'title' => 'Penyitaan Belum dibaca',
					'jml' => $unread_penyitaan,
					'link' => base_url('admin/penyitaan')
				],
				[
					'title' => 'Penggeledahan Belum dibaca',
					'jml' => $unread_penggeledahan,
					'link' => base_url('admin/penggeledahan')
				],
				[
					'title' => 'Perpanjangan Belum dibaca',
					'jml' => $unread_perpanjangan,
					'link' => base_url('admin/perpanjangan-penahanan')
				],
			] ?>
			<?php foreach ($list_unread as $item) : ?>
				<div class="col-lg-4">
					<a style="text-decoration: none;" href="<?= $item['link'] ?>">
						<div class="card" style="min-height: 100%;">
							<div class="card-body">
								<h3><?= $item['title'] ?></h3>
								<div class="mt-4 d-flex align-items-center justify-content-between">
									<i class="fa fa-bell fa-2x"></i>
									<h3 class="mt-3 text-right"><?= $item['jml'] ?></h3>
								</div>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach ?>

		</div>
	</div>
</div>