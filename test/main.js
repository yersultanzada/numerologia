$(document).ready(function() {

	$('input[type="tel"]').mask('+7 (799) 999-99-99');

	var progress = {
		current: ( 100 / ($('.step-slide').length - 1) ),
		total: $('.step-slide').length,
		width: ( 100 / ($('.step-slide').length - 1) ),
		process: doProgress
	};

	// console.log(progress);

	function doProgress () {}

	var testSlider = $('.test-slider').bxSlider({
		mode: 'fade',
		infiniteLoop: false,
		speed: 0,
		adaptiveHeight: true,
		adaptiveHeightSpeed: 0,
		touchEnabled: false,
		pager: false,
		nextSelector: '.btn-next-container',
		nextText: '<div class="btn-next"><span>на следующий шаг</span></div>',
		onSliderLoad: function (currentIndex) {
			// первоначальные стили
			$('.main-progress__text').eq(currentIndex).addClass('main-progress__text_active');
			$('.step__extender-item').eq(currentIndex).addClass('step__extender-item_active');
			$('.main-progress__extender').css('width', progress.width + '%');
		},
		onSlideAfter: function (slideElement, oldIndex, newIndex) {
			// активация кнопок
			$('.btn-next-container').removeClass('btn-next-container_active');
			$('.btn-next').removeClass('btn-next_active btn-shine');

			// изменение полосы загрузки
			progress.current += progress.width;
			$('.main-progress__extender').css('width', progress.current + '%');

			// изменение шага
			$('.step__extender-item').eq(newIndex).addClass('step__extender-item_active');
			$('.step__text span').html(newIndex + 1);

			// изменение заголовка в полосе загрузки
			if ( $('.main-progress__text').eq(newIndex).length != 0 ) {
				$('.main-progress__text').eq(oldIndex).removeClass('main-progress__text_active');
				$('.main-progress__text').eq(newIndex).addClass('main-progress__text_active');
			};

			var toTopDoc = window.parent.document.querySelector('.fancybox-slide--iframe');

			// console.log(toTopDoc);

			$(toTopDoc).animate({scrollTop: 0}, 0);

		}
	});

	// testSlider.goToSlide(4);

	$('.pick-item__input').on('change', function(event) {
		event.preventDefault();
		$('.btn-next-container').addClass('btn-next-container_active');
		$('.btn-next').addClass('btn-next_active btn-shine');
	});

});