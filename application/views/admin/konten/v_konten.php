<div class="container" style="margin-top: 80px; margin-bottom: 80px;">
	<h3 class="text-center mb-3">
		Konten Web
	</h3>
	<form id="myForm">
		<div class="form-group">
			<label class="d-block text-left" for="redaksi_utama">Redaksi Utama</label>
			<textarea class="form-control" name="redaksi_utama" id="redaksi_utama" cols="30" rows="5"><?= $setting['redaksi_utama'] ?></textarea>
			<div class="invalid-feedback"></div>
		</div>
		<div class="form-group">
			<label class="d-block text-left" for="marquee">Text Berjalan</label>
			<textarea class="form-control" name="marquee" id="marquee" cols="30" rows="5"><?= $setting['marquee'] ?></textarea>
			<div class="invalid-feedback"></div>
		</div>
		<div class="form-group">
			<label class="d-block text-left" for="redaksi_penggeledahan">Redaksi Penggeledahan</label>
			<textarea class="form-control" name="redaksi_penggeledahan" id="redaksi_penggeledahan" cols="30" rows="5"><?= $setting['redaksi_penggeledahan'] ?></textarea>
			<div class="invalid-feedback"></div>
		</div>
		<div class="form-group">
			<label class="d-block text-left" for="redaksi_penyitaan">Redaksi Penyitaan</label>
			<textarea class="form-control" name="redaksi_penyitaan" id="redaksi_penyitaan" cols="30" rows="5"><?= $setting['redaksi_penyitaan'] ?></textarea>
			<div class="invalid-feedback"></div>
		</div>
		<div class="form-group">
			<label class="d-block text-left" for="redaksi_perpanjangan_penahanan">Redaksi Perpanjangan Penahanan</label>
			<textarea class="form-control" name="redaksi_perpanjangan_penahanan" id="redaksi_perpanjangan_penahanan" cols="30" rows="5"><?= $setting['redaksi_perpanjangan_penahanan'] ?></textarea>
			<div class="invalid-feedback"></div>
		</div>
		<div class="form-group">
			<label class="d-block text-left" for="quotes">quotes</label>
			<textarea class="form-control" name="quotes" id="quotes" cols="30" rows="5"><?= $setting['quotes'] ?></textarea>
			<div class="invalid-feedback"></div>
		</div>
		<div class="form-group">
			<label class="d-block text-left" for="sosmed_facebook">Link Sosmed Facebook</label>
			<input name="sosmed_facebook" value="<?= $setting['sosmed_facebook'] ?>" type="text" class="form-control" id="sosmed_facebook">
			<div class="invalid-feedback"></div>
		</div>
		<div class="form-group">
			<label class="d-block text-left" for="sosmed_instagram">Link Sosmed Instagram</label>
			<input name="sosmed_instagram" value="<?= $setting['sosmed_instagram'] ?>" type="text" class="form-control" id="sosmed_instagram">
			<div class="invalid-feedback"></div>
		</div>
		<div class="form-group">
			<label class="d-block text-left" for="sosmed_twitter">Link Sosmed Twitter</label>
			<input name="sosmed_twitter" value="<?= $setting['sosmed_twitter'] ?>" type="text" class="form-control" id="sosmed_twitter">
			<div class="invalid-feedback"></div>
		</div>
		<div class="form-group">
			<label class="d-block text-left" for="sosmed_whatsapp">Link Sosmed Whatsapp</label>
			<input name="sosmed_whatsapp" value="<?= $setting['sosmed_whatsapp'] ?>" type="text" class="form-control" id="sosmed_whatsapp">
			<div class="invalid-feedback"></div>
		</div>
		<button class="btn btn-primary">Simpan</button>
	</form>

	<div class="row mt-5">
		<div class="col-12 mb-3">
			<h3 class="text-center mb-3">Galeri</h3>
			<form id="formImage">
				<div class="card">
					<div class="card-body">
						<label for="">Tambah Galeri</label>
						<input name="file" type="file" accept=".jpg,.jpeg,.png">
						<button class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</form>
		</div>
		<?php foreach ($images as $img) : ?>
			<div class="gambar col-md-3 mb-2">
				<div class="card">
					<div class="card-body">
						<img class="img-fluid" src="<?= base_url('assets/data/konten/' . $img['file_name']) ?>" alt="">
						<button class="btn btn-primary btn-sm btn-hapus mt-1" data-enc="<?= base64_encode(json_encode($img)) ?>">Hapus</button>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>
