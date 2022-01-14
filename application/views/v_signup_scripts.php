<script>
	$('#signup').on('submit', function(e) {
		e.preventDefault();

		swal_loading()
		const formData = new FormData($(this)[0])

		$.ajax({
			type: "POST",
			url: "<?= base_url('signup') ?>",
			data: formData,
			dataType: "json",
			processData: false,
			contentType: false,
			cache: false,
		}).then(res => {
			Swal.fire('Yayyy', res.msg ?? 'Akun berhasil dibuat.', 'success').then(res => {
				window.location.replace('<?= base_url('login') ?>')
			})
		}).fail(e => common_error(e))
	})
</script>
