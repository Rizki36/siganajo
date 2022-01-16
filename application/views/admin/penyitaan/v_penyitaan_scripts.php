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
			"url": "<?= base_url('admin/penyitaan/get_datatable'); ?>",
			"type": "POST",
			"data": function(d) {}
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
</script>
