<?php
  /* Принимаем данные из формы */
  $name = $_POST["name"];
  $page_id = $_POST["page_id"];
  /*$text_comment = $_POST["text_comment"];*/
  $message = $_POST["message"];
  $name = htmlspecialchars($name);// Преобразуем спецсимволы в HTML-сущности
 /* $text_comment = htmlspecialchars($text_comment);// Преобразуем спецсимволы в HTML-сущности*/
  $mysqli = new mysqli("localhost", "root", "", "diplom");// Подключается к базе данных
  /*$mysqli->query("INSERT INTO `comments` (`name`, `page_id`, `text_comment`) VALUES ('$name', '$page_id', '$text_comment')");// Добавляем комментарий в таблицу*/
   $mysqli->query("INSERT INTO `shoutbox` (`name`, `date_time`, `message`, `page_id`) VALUES ('$name', '$date_time', '$message', '$page_id')");// Добавляем комментарий в таблицу
  header("Location: ".$_SERVER["HTTP_REFERER"]);// Делаем реридект обратно
?>
