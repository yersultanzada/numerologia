<?php
$msgs = [];
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
        if ($sendTextToTelegram) {
            $msgs['okSend'] = 'Спасибо за отправку вашего сообщения!';
            echo json_encode($msgs);
        } elseif ($sendTextToTelegram) {
            $msgs['okSend'] = 'Спасибо за отправку вашего сообщения!';
            echo json_encode($msgs);
            return true;
        } else {
            $msgs['err'] = 'Ошибка. Сообщение не отправлено!';
            echo json_encode($msgs);
            die('Ошибка. Сообщение не отправлено!');
        }

    } else {
        $msgs['err'] = 'Ошибка. Вы заполнили не все обязательные поля!';
        echo json_encode($msgs);;
    }
} else {
    header ("Location: /");
}
?>