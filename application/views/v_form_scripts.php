<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
	$(window).scrollTop()

	function init() {
		return {
			curStep: 0,
			totalStep: <?= json_decode(count($steps)) ?>,
			async next() {
				reset_validation()
				<?php $index = 0 ?>
				<?php foreach ($steps as $keyStep => $step) : ?>
					if (this.curStep === <?= json_decode($index) ?>) {
						const $form = $('#<?= $keyStep ?>')
						let formData = new FormData($form[0])
						if ($form.length) {
							if (this.curStep + 1 === this.totalStep) {
								<?php for ($i = 0; $i < json_decode(count($steps)) - 1; $i++) : ?>
									$.each($('.my-form')[<?= json_decode($i) ?>], function(index, el) {
										const $el = $(el)
										formData.append($el.attr('name'), $el.val())
									})
								<?php endfor ?>
								$.each($('.my-form')[this.totalStep - 1], function(index, el) {
									const $el = $(el)
									if ($el.attr('type') === 'file' && $el.prop('required') && $el.get(0).files.length === 0) {
										swal.fire('Data Belum lengkap', 'File ' + $el.attr('title') + ' belum diisi !', 'info')
										throw 'Data Belum lengkap';
									}
								})
							}
						}

						if (this.curStep === this.totalStep - 1) swal_loading()

						const res = $.ajax({
							type: "POST",
							url: "<?= $step['validation_link'] ?>",
							data: formData,
							dataType: "json",
							processData: false,
							contentType: false,
							cache: false,
						}).then(res => {
							if (this.curStep === this.totalStep - 1) {
								swal.fire('Berhasil !', 'Data berhasil dikirim.', 'success')
									.then(e => window.location.replace('<?= base_url('/') ?>'))
							} else {
								this.curStep = this.curStep + 1
							}
						}).fail(e => common_error(e))
					}

					<?php $index++ ?>
				<?php endforeach  ?>
			},
			async back() {
				this.curStep = this.curStep - 1
			},
			<?php foreach ($data_alpine as $key => $value) : ?>
				<?= $key ?>: '<?= $value ?>',
			<?php endforeach ?>
		}
	}
</script>
