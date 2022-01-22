<style>

</style>
<div class="container-fluid" style="margin-top: 120px;margin-bottom: 120px;">
	<div class="card">
		<div class="card-body">
			<h3 class="mb-5 text-center">List Form Perpanjangan Penahanan</h3>
			<div class="d-flex mb-2">
				<input id="r-semua" type="radio" class="input-filter input-radio mr-2" name="status" value="">
				<label for="r-semua" class="mr-3 label-radio">
					Semua
				</label>
				<input id="r-read" type="radio" class="input-filter input-radio mr-2" name="status" value="read">
				<label for="r-read" class="mr-3 label-radio">
					Sudah Dibaca
				</label>
				<input id="r-unread" type="radio" class="input-filter input-radio mr-2" name="status" value="unread" checked>
				<label for="r-unread" class="mr-3 label-radio">
					Belum Dibaca
				</label>
			</div>
			<div class="table-responsive">
				<table id="datatable" class="table">
					<thead class="bg-primary">
						<tr>
							<th style="" class="text-white">No</th>
							<th style="" class="text-white">Tanggal</th>
							<th style="min-width: 100px;" class="text-white">Data</th>
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