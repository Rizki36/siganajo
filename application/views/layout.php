<?php $this->load->view('layout/head') ?>

<body data-spy="scroll" data-target=".fixed-top">

	<!-- Preloader -->
	<div class="spinner-wrapper">
		<div class="spinner">
			<div class="bounce1"></div>
			<div class="bounce2"></div>
			<div class="bounce3"></div>
		</div>
	</div>
	<!-- end of preloader -->

	<?php if (@$use_nav !== false) $this->load->view('layout/navigation') ?>

	<div style="min-height: 90vh;">
		<?= $main ?>
	</div>

	<?php if (@$use_footer !== false) $this->load->view('layout/footer') ?>

	<?php $this->load->view('layout/script') ?>

	<?= @$scripts ?>
</body>

</html>
