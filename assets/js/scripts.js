/* Template: Tivo - SaaS App HTML Landing Page Template
   Author: Inovatik
   Created: Sep 2019
   Description: Custom JS file
*/


(function ($) {
	"use strict";

	/* Preloader */
	$(window).on('load', function () {
		var preloaderFadeOutTime = 500;

		function hidePreloader() {
			var preloader = $('.spinner-wrapper');
			setTimeout(function () {
				preloader.fadeOut(preloaderFadeOutTime);
			}, 500);
		}
		hidePreloader();
	});


	/* Navbar Scripts */

	// jQuery for page scrolling feature - requires jQuery Easing plugin
	$(function () {
		$(document).on('click', 'a.page-scroll', function (event) {
			var $anchor = $(this);
			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href')).offset().top
			}, 600, 'easeInOutExpo');
			event.preventDefault();
		});
	});

	// closes the responsive menu on menu item click
	$(".navbar-nav li a").on("click", function (event) {
		if (!$(this).parent().hasClass('dropdown'))
			$(".navbar-collapse").collapse('hide');
	});


	/* Image Slider - Swiper */
	var imageSlider = new Swiper('.image-slider', {
		autoplay: {
			delay: 2000,
			disableOnInteraction: false
		},
		loop: true,
		spaceBetween: 30,
		slidesPerView: 5,
		breakpoints: {
			// when window is <= 580px
			580: {
				slidesPerView: 1,
				spaceBetween: 10
			},
			// when window is <= 768px
			768: {
				slidesPerView: 2,
				spaceBetween: 20
			},
			// when window is <= 992px
			992: {
				slidesPerView: 3,
				spaceBetween: 20
			},
			// when window is <= 1200px
			1200: {
				slidesPerView: 4,
				spaceBetween: 20
			},

		}
	});


	/* Text Slider - Swiper */
	var textSlider = new Swiper('.text-slider', {
		autoplay: {
			delay: 6000,
			disableOnInteraction: false
		},
		loop: true,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev'
		}
	});


	/* Video Lightbox - Magnific Popup */
	$('.popup-youtube, .popup-vimeo').magnificPopup({
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,
		fixedContentPos: false,
		iframe: {
			patterns: {
				youtube: {
					index: 'youtube.com/',
					id: function (url) {
						var m = url.match(/[\\?\\&]v=([^\\?\\&]+)/);
						if (!m || !m[1]) return null;
						return m[1];
					},
					src: 'https://www.youtube.com/embed/%id%?autoplay=1'
				},
				vimeo: {
					index: 'vimeo.com/',
					id: function (url) {
						var m = url.match(/(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/);
						if (!m || !m[5]) return null;
						return m[5];
					},
					src: 'https://player.vimeo.com/video/%id%?autoplay=1'
				}
			}
		}
	});


	/* Details Lightbox - Magnific Popup */
	$('.popup-with-move-anim').magnificPopup({
		type: 'inline',
		fixedContentPos: false,
		/* keep it false to avoid html tag shift with margin-right: 17px */
		fixedBgPos: true,
		overflowY: 'auto',
		closeBtnInside: true,
		preloader: false,
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-slide-bottom'
	});


	/* Move Form Fields Label When User Types */
	// for input and textarea fields
	$("input, textarea").keyup(function () {
		if ($(this).val() != '') {
			$(this).addClass('notEmpty');
		} else {
			$(this).removeClass('notEmpty');
		}
	});


	/* Back To Top Button */
	// create the back to top button
	$('body').prepend('<a href="body" class="back-to-top page-scroll">Back to Top</a>');
	var amountScrolled = 700;
	$(window).scroll(function () {
		if ($(window).scrollTop() > amountScrolled) {
			$('a.back-to-top').fadeIn('500');
		} else {
			$('a.back-to-top').fadeOut('500');
		}
	});


	/* Removes Long Focus On Buttons */
	$(".button, a, button").mouseup(function () {
		$(this).blur();
	});


})(jQuery);

function swal_loading(title = 'Loading...', text = 'Mohon tunggu sebentar') {
	Swal.fire({
		title,
		html: text,
		didOpen: () => {
			Swal.showLoading()
		}
	})
}

function swal_close(time = 500) {
	setTimeout(() => Swal.close(), time)
}

function err_validation(error) {
	for (var item in error) {
		const $item = $('#' + item);
		$item.addClass('is-invalid');
		$item.siblings('.invalid-feedback').text(error[item]);
	}
}

function reset_validation() {
	$('.is-invalid').removeClass('is-invalid');
	$('.invalid-feedback').text('');
}

function common_error(e){
	console.log(e);
	reset_validation()
	if (e?.responseJSON?.validation) {
		swal_close(0);
		err_validation(e?.responseJSON?.validation);
		return;
	}

	return Swal.fire('Yahhh', e?.responseJSON?.msg ?? 'Terjadi kesalahan.', 'error')
}
