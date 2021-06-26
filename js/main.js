$(document).ready(function(){
	$('.our-works-slider').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		dots: false,
		responsive: [
		{
			breakpoint: 981,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 1,
				infinite: true,
				dots: false
			}
		},
		{
			breakpoint: 481,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: true,
				dots: false
			}
		}
		]
	});

	// $(".our-works .slick-slide a").fancybox();
	$('[data-fancybox="gallery"]').fancybox({
		buttons : [
		'zoom',
		'thumbs',
		'close'
		]
	});


	var timerId = 0;
	$(".main-btn").fancybox({
		buttons : [
		'close'
		],
		iframe : {
			css : {
				width : '100%',
				maxWidth: '1170px'
			}
		},
		afterLoad: function () {
			$('iframe').on('load', function(event) {
				event.preventDefault();
				frameHeight();
			});

			setTimeout(function() {
				frameHeightRec();
			}, 300);

			$(window).on('resize', function() {
				frameHeight();
			});
		},
		afterClose: function () {
			clearTimeout(timerId);
			// console.log('clear');
		}
	});

	function frameHeight () {
		var height = $('iframe').contents().find('html').height();
		$('iframe').height(height);
	}

	function frameHeightRec () {
		var height = $('iframe').contents().find('html').height();
		$('iframe').height(height);
		timerId = setTimeout(function() {
			frameHeightRec();
		}, 100);
		// console.log('call');
	}
});