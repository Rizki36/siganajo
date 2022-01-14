<script>
	$('#login').on('submit', function(e) {
		e.preventDefault();
		const formData = new FormData($(this)[0])

		swal_loading()

		$.ajax({
			type: "POST",
			url: "<?= base_url('login') ?>",
			data: formData,
			dataType: "json",
			processData: false,
			contentType: false,
			cache: false,
		}).then(res => {

		}).fail(e => {
			if (e?.responseJSON?.validation) {
				swal_close(0);
				for (var item in e.responseJSON?.validation) {
					const $item = $('#' + item);
					$item.addClass('is-invalid');
					$item.siblings('.invalid-feedback').text(e.responseJSON?.validation[item]);
				}
				return;
			}

			if (e?.responseJSON?.msg) return Swal.fire('Yahhh', 'User tidak ada.', 'error')

			swal_close();
		})
	})
</script>
