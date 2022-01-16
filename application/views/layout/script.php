<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
<script src="<?= base_url('assets/js/popper.min.js') ?>"></script> <!-- Popper tooltip library for Bootstrap -->
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script> <!-- Bootstrap framework -->
<script src="<?= base_url('assets/js/jquery.easing.min.js') ?>"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
<script src="<?= base_url('assets/js/swiper.min.js') ?>"></script> <!-- Swiper for image and text sliders -->
<script src="<?= base_url('assets/js/jquery.magnific-popup.js') ?>"></script> <!-- Magnific Popup for lightboxes -->
<script src="<?= base_url('assets/js/validator.min.js') ?>"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
<script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
<script src="<?= base_url('assets/js/jquery.steps.min.js') ?>"></script>
<script src="<?= base_url('assets/js/scripts.js') ?>"></script> <!-- Custom scripts -->
<script>
	<?php if (!@$header_with_bg) : ?>
		// jQuery to collapse the navbar on scroll
		$(window).on('scroll load', function() {
			if ($(".navbar")?.offset()?.top > 60) {
				$(".fixed-top").addClass("top-nav-collapse");
			} else {
				$(".fixed-top").removeClass("top-nav-collapse");
			}
		});
	<?php endif ?>
</script>
