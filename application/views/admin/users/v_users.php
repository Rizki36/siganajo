<div class="container" style="margin-top: 120px;margin-bottom: 120px;">
	<div class="card">
		<div class="card-body">
			<h3 class="mb-5 text-center">List User</h3>
			<div class="d-flex mb-2">
				<input id="r-semua" type="radio" class="input-filter input-radio mr-2" name="status" value="" <?= $s === 'unverified' ? 'checked' : '' ?>>
				<label for="r-semua" class="mr-3 label-radio">
					Semua
				</label>
				<input id="r-unverified" type="radio" class="input-filter input-radio mr-2" name="status" value="unverified" <?= $s === 'unverified' ? 'checked' : '' ?>>
				<label for="r-unverified" class="mr-3 label-radio">
					Belum diverifikasi
				</label>
				<input id="r-unread" type="radio" class="input-filter input-radio mr-2" name="status" value="verified" <?= $s === 'verified' ? 'checked' : '' ?>>
				<label for="r-unread" class="mr-3 label-radio">
					Sudah diverifikasi
				</label>
			</div>
			<div class="table-responsive">
				<table id="datatable" class="table">
					<thead class="bg-primary">
						<tr>
							<th style="" class="text-white">Data</th>
							<th style="min-width: 100px;" class="text-white">File</th>
							<th style="min-width: 100px;" class="text-white">Verifikasi</th>
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
