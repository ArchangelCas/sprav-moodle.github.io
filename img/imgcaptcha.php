<?php
//запускаем сессию
    session_start();
//подключаем класс
    include('mycaptcha.php');
//вызываем класс
    $captcha = new mycaptcha();
//генерим капчу
    $captcha->captcha();
//записываем значение капчи в сессию
    $_SESSION['keycaptcha'] = $captcha->getKeycaptcha();
?>    