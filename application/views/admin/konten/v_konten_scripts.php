<script>
	$('#myForm').on('submit', function(e) {
		e.preventDefault()
		swal_loading()
		const formData = new FormData($(this)[0])

		$.ajax({
			type: "POST",
			url: "<?= base_url('admin/konten') ?>",
			data: formData,
			dataType: "json",
			processData: false,
			contentType: false,
			cache: false,
		}).then(res => {
			swal.fire('Berhasil', 'Berhasil mengupdate data', 'success')
		}).fail(e => common_error(e))
	})

	$('#formImage').on('submit', function(e) {
		e.preventDefault()
		swal_loading()
		const formData = new FormData($(this)[0])
		formData.append('type', 'add')

		$.ajax({
			type: "POST",
			url: "<?= base_url('admin/konten/update_image') ?>",
			data: formData,
			dataType: "json",
			processData: false,
			contentType: false,
			cache: false,
		}).then(res => {
			swal.fire('Berhasil', 'Berhasil mengupdate data', 'success').then(e => {
				window.location.reload()
			})
		}).fail(e => common_error(e))
	})

	$('.btn-hapus').on('click', function(e) {
		e.preventDefault()
		const enc = $(this).attr('data-enc')
		$.ajax({
			type: "POST",
			url: "<?= base_url('admin/konten/update_image') ?>",
			data: {
				type: 'delete',
				enc
			},
			dataType: "json"
		}).then(res => {
			$(this).closest('.gambar').remove()
		}).fail(e => common_error(e))
	})
</script>
