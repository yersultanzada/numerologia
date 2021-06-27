(function ($) {
	$(".contact-form").submit(function (event) {
		event.preventDefault();

		let form = $('#' + $(this).attr('id'))[0];

		// Сохраняем в переменную див, в который будем выводить сообщение формы
		let formDescription = $(this).find('.contact-form__description');

		let fd = new FormData(form);
		$.ajax({
			url: "mail/php/mail.php",
			type: "POST",
			data: fd,
			processData: false,
			contentType: false,
			success: function success(res) {
				let respond = $.parseJSON(res);
				if (respond.err) {
					formDescription.html(respond.err).css('color','#d42121');
					setTimeout(()=> {
						formDescription.text('');
					}, 3000);
				} else if(respond.okSend) {
					$('.prev_slide').css({
						'display': 'none'
					});
					$('.last_slide').css({
						'display': 'block'
					});
					$('.header-line').slideUp(300);
					$('.progress-line').slideUp(300);
				} else {
					alert ('Необработанная ошибка. Проверьте консоль и устраните.');
				}
			},
		});
	});
}(jQuery));