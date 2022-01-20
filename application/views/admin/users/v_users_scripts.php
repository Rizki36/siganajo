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
			[2, 'asc']
		],
		"columnDefs": [],
		"ajax": {
			"url": "<?= base_url('admin/users/get_datatable'); ?>",
			"type": "POST",
			"data": function(d) {}
		},
		columns: [
			// 
			{
				data: 'data',
				orderable: false
			},
			{
				data: 'file_link',
				orderable: false,
				className: 'text-center'
			},
			{
				data: 'is_verified',
				orderable: false,
				className: 'text-center'
			},
			{
				data: 'aksi',
				orderable: false,
				className: 'text-center'
			},
		],
	});

	function hapus(id) {
		Swal.fire({
			icon: 'warning',
			title: 'Apakah Anda Yakin ?',
			text: 'Akan menghapus user !',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak',
			showCancelButton: true
		}).then(function(result) {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: "<?= base_url('admin/users/delete') ?>",
					data: {
						id
					},
					dataType: "json",

				}).then(res => {
					$datatable.ajax.reload()
				}).fail(e => common_error(e))
			}
		})
	}

	function ubah_password(id) {
		Swal.fire({
			title: 'Ubah password',
			input: 'text',
			inputAttributes: {
				autocapitalize: 'off'
			},
			showCancelButton: true,
			confirmButtonText: 'Update',
			showLoaderOnConfirm: true,
			preConfirm: (pass) => {
				return $.ajax({
					type: "POST",
					url: "<?= base_url('admin/users/update_pass') ?>",
					data: {
						id,
						pass
					},
					dataType: "json",
				}).then(res => {
					Swal.fire('Berhasil', '', 'success')
					$datatable.ajax.reload()
				}).fail(e => common_error(e))
			},
			allowOutsideClick: () => !Swal.isLoading()
		})
	}

	function verifikasi(id, new_status) {
		$.ajax({
			type: "POST",
			url: "<?= base_url('admin/users/verifikasi') ?>",
			data: {
				id,
				new_status
			},
			dataType: "json",

		}).then(res => {
			$datatable.ajax.reload()
		}).fail(e => common_error(e))
	}
</script>
