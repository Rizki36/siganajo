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
			"url": "<?= base_url('balasan/penyitaan/get_datatable'); ?>",
			"type": "POST",
			"data": function(d) {
				d.status = $("input[name='status']:checked").val();
				d.status_user = $("input[name='status_user']:checked").val();
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
				sortable: false,
				classname: "text-center"
			},
		],
	});

	$(".input-filter").on('change', function(e) {
		$datatable.ajax.reload()
	})

	function detail_tolak(id) {
		$.ajax({
			type: "POST",
			url: "<?= base_url('balasan/penyitaan/detail_tolak') ?>",
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
					url: "<?= base_url('balasan/penyitaan/mark_read') ?>",
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
</script>