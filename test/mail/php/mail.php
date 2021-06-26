<?php

// mb_internal_encoding("UTF-8");
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

	use PHPMailer\PHPMailer\PHPMailer;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $token = "1870693626:AAEZTO4_VaiRNit1Slr4I9dFEGJhmLQI7fA";
        $chat_id = "-523327787";

        if (!empty($_POST['name']) && !empty($_POST['tel'])){
            if (isset($_POST['name'])) {
                if (!empty($_POST['name'])){
                    $name = "Имя: " . strip_tags($_POST['name']) . "%0A";
                }
            }
            if (isset($_POST['tel'])) {
                if (!empty($_POST['tel'])){
                    $tel = "Телефон: " . "%2B" . strip_tags($_POST['tel']) . "%0A";
                }
            }
            if (isset($_POST['step1'])) {
                if (!empty($_POST['step1'])){
                    $step1 = "Направление: " .strip_tags($_POST['step1']) . "%0A";
                }
            }
            if (isset($_POST['step2'])) {
                if (!empty($_POST['step2'])){
                    $step2 = "Количество консультаций: " .strip_tags($_POST['step2']) . "%0A";
                }
            }
            if (isset($_POST['step3'])) {
                if (!empty($_POST['step3'])){
                    $step3 = "Заработок: " .strip_tags($_POST['step3']) . "%0A";
                }
            }
            if (isset($_POST['step4'])) {
                if (!empty($_POST['step4'])){
                    $step4 = "Хочет зарабатывать: " .strip_tags($_POST['step4']) . "%0A";
                }
            }
            if (isset($_POST['step5'])) {
                if (!empty($_POST['step5'])){
                    $step5 = "Бонус: " .strip_tags($_POST['step5']) . "%0A";
                }
            }
            // Формируем текст сообщения
            $txt = $name . $tel . $step1 . $step2 . $step3 . $step4 . $step5;

            $sendTextToTelegram = file_get_contents("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}");

        } else {
            $msgs['err'] = 'Ошибка. Вы заполнили не все обязательные поля!';
            echo json_encode($msgs);;
        }

		require_once($_SERVER['DOCUMENT_ROOT'] . '/test/mail/phpmailer/phpmailer.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/test/mail/php/config.php');
		require_once($_SERVER['DOCUMENT_ROOT'] . '/test/mail/php/valid.php');

		if(defined('HOST') && HOST != '') {
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->Host = HOST;
			$mail->SMTPAuth = true;
			$mail->Username = LOGIN;
			$mail->Password = PASS;
			$mail->SMTPSecure = 'ssl';
			$mail->Port = PORT;
			$mail->AddReplyTo(SENDER);
		} else {
			$mail = new PHPMailer;
		}

		for ($ct = 0; $ct < count($_FILES['files']['tmp_name']); $ct++) {
        $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['files']['name'][$ct]));
        $filename = $_FILES['files']['name'][$ct];
            if (move_uploaded_file($_FILES['files']['tmp_name'][$ct], $uploadfile)) {
                $mail->addAttachment($uploadfile, $filename);
            } else {
                $msg .= 'failfile';
            }
    } 

		$mail->setFrom(SENDER);
    $mail->addAddress(CATCHER);
    $mail->CharSet = CHARSET;
    $mail->isHTML(true);
		$mail->Subject = SUBJECT;
		$mail->Body = "$name $tel $step1 $step2 $step3 $step4 $step5";
		if(!$mail->send()) {
    } else {
      echo json_encode($msgs);
    }
	
	} else{
    header ("Location: /");
	}