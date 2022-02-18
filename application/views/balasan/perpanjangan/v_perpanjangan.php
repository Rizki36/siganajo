<?php $s = $_GET['s'] ?? 'unread' ?>

<div class="container-fluid" style="margin-top: 120px;margin-bottom: 120px;">
	<div class="card">
		<div class="card-body">
			<h3 class="mb-5 text-center">List Form Perpanjangan Penahanan</h3>
			<div class="d-flex mb-2">
				<input id="r-semua" type="radio" class="input-filter input-radio mr-2" name="status" value="" <?= $s === '' ? 'checked' : '' ?>>
				<label for="r-semua" class="mr-3 label-radio">
					Semua
				</label>
				<input id="r-unread" type="radio" class="input-filter input-radio mr-2" name="status" value="unread" <?= $s === 'unread' ? 'checked' : '' ?>>
				<label for="r-unread" class="mr-3 label-radio">
					Belum Dibalas
				</label>
				<input id="r-accepted" type="radio" class="input-filter input-radio mr-2" name="status" value="accepted" <?= $s === 'accepted' ? 'checked' : '' ?>>
				<label for="r-accepted" class="mr-3 label-radio">
					Diterima
				</label>
				<input id="r-rejected" type="radio" class="input-filter input-radio mr-2" name="status" value="rejected" <?= $s === 'rejected' ? 'checked' : '' ?>>
				<label for="r-rejected" class="mr-3 label-radio">
					Ditolak
				</label>

				<input id="u-all" type="radio" class="input-filter input-radio mr-2" name="status_user" value="">
				<label for="u-all" class="mr-3 label-radio ml-5">
					Semua
				</label>
				<input id="u-unread" type="radio" class="input-filter input-radio mr-2" name="status_user" value="unread" checked>
				<label for="u-unread" class="mr-3 label-radio">
					Belum Dibaca
				</label>
				<input id="u-read" type="radio" class="input-filter input-radio mr-2" name="status_user" value="read">
				<label for="u-read" class="mr-3 label-radio">
					Sudah Dibaca
				</label>
			</div>
			<div class="table-responsive">
				<table id="datatable" class="table">
					<thead class="bg-primary">
						<tr>
							<th style="" class="text-white">No</th>
							<th style="" class="text-white">Tanggal</th>
							<th style="min-width: 100px;" class="text-white">Data Penyidik</th>
							<th style="min-width: 100px;" class="text-white">Data Pihak</th>
							<th style="min-width: 100px;" class="text-white">Polres/Polsek Pengaju</th>
							<th style="min-width: 100px;" class="text-white text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>