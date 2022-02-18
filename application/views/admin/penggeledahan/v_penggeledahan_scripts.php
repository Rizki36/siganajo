<script>
	const $datatable = $('#datatable').DataTable({
		"processing": true,
		"serverSide": true,
		"bAutoWidth": false,
		"paging": true,
		"dom": '<"d-flex justify-content-between align-items-center mb-3"lfr>' +
			't' +
			'<"fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix ui-corner-bl ui-corner-br mt-3"ip>',
		"lengthMenu": [
			[5, 10, 25, 50],
			['5 rows', '10 rows', '25 rows', '50 rows']
		],
		"order": [
			[1, 'desc']
		],
		"columnDefs": [],
		"ajax": {
			"url": "<?= base_url('admin/penggeledahan/get_datatable'); ?>",
			"type": "POST",
			"data": function(d) {
				d.status = $("input[name='status']:checked").val();
			}
		},
		columns: [
			// 
			{
				data: 'no',
				orderable: false
			},
			{
				data: 'created_at',
			},
			{
				data: 'penyidik',
				orderable: false
			},
			{
				data: 'pihak',
				orderable: false
			},
			{
				data: 'polres_polsek_pengaju'
			},
			{
				data: 'jenis_permohonan'
			},
			{
				data: 'aksi',
				orderable: false,
				className: 'text-center'
			},
		],
	});

	$(".input-filter").on('change', function(e) {
		$datatable.ajax.reload()
	})

	function mark_read(id, is_read) {
		Swal.fire({
			icon: 'info',
			title: 'Apakah Anda Yakin ?',
			text: '',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak',
			showCancelButton: true
		}).then(function(result) {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: "<?= base_url('admin/penggeledahan/mark_read') ?>",
					data: {
						id,
						is_read
					},
					dataType: "json",

				}).then(res => {
					$datatable.ajax.reload()
				}).fail(e => common_error(e))
			}
		})
	}


	async function tolak(id) {
		const {
			value: formValues
		} = await Swal.fire({
			title: 'Form Penolakan',
			width: 900,
			html: $('#form-ditolak').html(),
			focusConfirm: false,
			customClass: {
				container: 'text-left',
				htmlContainer: 'text-left',
			},
			preConfirm: () => {
				return {
					nomor_surat: document.getElementById('nomor_surat').value,
					alasan_ditolak: document.getElementById('alasan_ditolak').value
				}
			}
		})

		if (formValues) {
			const {
				nomor_surat,
				alasan_ditolak
			} = formValues

			swal_loading()

			$.ajax({
				type: "POST",
				url: "<?= base_url('admin/penggeledahan/tolak') ?>",
				data: {
					id,
					nomor_surat,
					alasan_ditolak
				},
				dataType: "json"
			}).then(res => {
				console.log(res);
				$datatable.ajax.reload()
				swal_close(0);
			}).fail(e => common_error(e))
		}
	}


	function detail_tolak(id) {
		$.ajax({
			type: "POST",
			url: "<?= base_url('admin/penggeledahan/detail_tolak') ?>",
			data: {
				id
			},
			dataType: "json"
		}).then(res => {
			Swal.fire({
				title: 'Detail Penolakan',
				width: 900,
				html: `
				<div class="form-group">
					<label>Nomor Surat</label>
					<input id="nomor_surat" readonly name="nomor_surat" type="text" value="${res?.data?.nomor_surat}" class="form-control">
				</div>
				<div class="form-group">
					<label>Alasan</label>
					<textarea id="alasan_ditolak" readonly name="alasan_ditolak" class="form-control">${res?.data?.alasan_ditolak}</textarea>
				</div>
				`,
				focusConfirm: false,
				customClass: {
					container: 'text-left',
					htmlContainer: 'text-left',
				},
			})
		}).fail(e => common_error(e))
	}

	async function upload(id) {
		const {
			value: formValues
		} = await Swal.fire({
			title: 'Form Upload',
			width: 900,
			html: $('#form-upload').html(),
			focusConfirm: false,
			customClass: {
				container: 'text-left',
				htmlContainer: 'text-left',
			},
			preConfirm: () => {
				return {
					upload: document.getElementById('upload').files,
				}
			}
		})

		if (formValues) {
			const {
				upload
			} = formValues

			const formData = new FormData()
			formData.append('id', id)
			formData.append('upload', upload[0])

			swal_loading()

			$.ajax({
				type: "POST",
				url: "<?= base_url('admin/penggeledahan/upload') ?>",
				data: formData,
				dataType: "json",
				processData: false,
				contentType: false,
				cache: false,
			}).then(res => {
				console.log(res);
				$datatable.ajax.reload()
				swal_close(0);
			}).fail(e => common_error(e))
		}
	}

	function reset(id) {
		Swal.fire({
			icon: 'info',
			title: 'Apakah Anda Yakin ?',
			text: 'Data akan kembali ke belum dibaca',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak',
			showCancelButton: true
		}).then(function(result) {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: "<?= base_url('admin/penggeledahan/reset') ?>",
					data: {
						id,
					},
					dataType: "json",

				}).then(res => {
					$datatable.ajax.reload()
				}).fail(e => common_error(e))
			}
		})
	}
</script>