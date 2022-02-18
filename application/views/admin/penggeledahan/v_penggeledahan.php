<div class="container-fluid" style="margin-top: 120px;margin-bottom: 120px;">
	<div class="card">
		<div class="card-body">
			<h3 class="mb-5 text-center">List Form Penggeledahan</h3>
			<div class="d-flex mb-2">
				<input id="r-semua" type="radio" class="input-filter input-radio mr-2" name="status" value="">
				<label for="r-semua" class="mr-3 label-radio">
					Semua
				</label>
				<input id="r-unread" type="radio" class="input-filter input-radio mr-2" name="status" value="unread" checked>
				<label for="r-unread" class="mr-3 label-radio">
					Belum Dibaca
				</label>
				<input id="r-uploaded" type="radio" class="input-filter input-radio mr-2" name="status" value="uploaded">
				<label for="r-uploaded" class="mr-3 label-radio">
					Diupload
				</label>
				<input id="r-rejected" type="radio" class="input-filter input-radio mr-2" name="status" value="rejected">
				<label for="r-rejected" class="mr-3 label-radio">
					Ditolak
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
							<th style="min-width: 100px;" class="text-white">Jenis Permohonan</th>
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

<template id="form-ditolak">
	<div class="form-group">
		<label>Nomor Surat Penolakan</label>
		<input id="nomor_surat_penolakan" name="nomor_surat_penolakan" type="text" class="form-control">
	</div>
	<div class="form-group">
		<label>Alasan</label>
		<textarea id="alasan_ditolak" name="alasan_ditolak" class="form-control"></textarea>
	</div>
</template>

<template id="form-upload">
	<div class="form-group">
		<label>Upload File</label>
		<input type="file" name="upload" id="upload" class="form-control" style="height: 45px;" accept=".pdf">
	</div>
</template>