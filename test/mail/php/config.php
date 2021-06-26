<?
	// *** Настройка обязательности полей, в случае если они присутствуют в вашей форме

	// Имя
	const NAMEISREQUIRED = true;
	const MSGSNAMEERROR = "⚠ Поле обязательно для заполнения";

	// Телефон
	const TELISREQUIRED = true;
	const MSGSTELERROR = "⚠ Поле обязательно для заполнения";

	// Сообщение об успешной отправке
	const MSGSSUCCESS = "Сообщение успешно отправлено";

	// *** SMTP *** //

		require_once($_SERVER['DOCUMENT_ROOT'] . '/test/mail/phpmailer/smtp.php');
		const HOST = 'ssl://smtp.yandex.ru';
		const LOGIN = 'webtech19studio@yandex.kz';
		const PASS = 'web_tech2019';
		const PORT = '465';

	// *** /SMTP *** //

  // Почта с которой будет приходить письмо
	const SENDER = 'webtech19studio@yandex.kz';
	
	// Почта на которую будет приходить письмо
	const CATCHER = 'aiman.numerology@yandex.kz';
	
	// Тема письма
	const SUBJECT = 'Заявка с сайта';
	
	// Кодировка
  const CHARSET = 'UTF-8';
