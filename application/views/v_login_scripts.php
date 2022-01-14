<script>
	$('#login').on('submit', function(e) {
		e.preventDefault();

		swal_loading()
		const formData = new FormData($(this)[0])

		$.ajax({
			type: "POST",
			url: "<?= base_url('login') ?>",
			data: formData,
			dataType: "json",
			processData: false,
			contentType: false,
			cache: false,
		}).then(res => {
			window.location.replace('<?= base_url() ?>')
		}).fail(e => common_error(e))
	})
</script>
