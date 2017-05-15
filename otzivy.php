<html>
<head>
 <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width">
<link href="style.css" rel="stylesheet" type="text/css" >
</head>
<body>
 <div class="wrapper"> 
  <div class="top">
  </div>
  <ul class="navigation">
    <li><a href="index.php">Главная</a></li>
    <li><a href="teomat.php">Теоретический материал</a></li>
    <li><a href="itog.php">Итоговый тест</a></li>
    <li><a href="onas.php">Контакты</a></li>
        <li><a href="otzivy.php">Отзывы</a></li>
    <li><a href="http://dpo-energo.ru"><img src="img/23.jpg" alt=""></a></li>
    <li><a href="vhodd.php">Вход</a></li>
    <div class="clear"></div>
  </ul>
  <div class="footer">
<form name="comment" action="comment.php" method="post">

  <p>
    <label>Имя:</label><br>
    <input type="text" id="name" name="name" />
  </p>
  <p>
    <label>Комментарий:</label>
    <br />
    <textarea name="message" cols="50" rows="10" id="message" class="message"></textarea>
  </p>
  <p>
    <input type="hidden" name="date_time" value="150" />
    <input type="submit" id="submit" value="Отправить" />
  </p>
</form>
<?php
  $date_time = 150;// Уникальный идентификатор страницы (статьи или поста)
  $mysqli = new mysqli("localhost", "root", "", "diplom");// Подключается к базе данных
  $result_set = $mysqli->query("SELECT name,message FROM `shoutbox` WHERE `date_time`='$date_time'"); //Вытаскиваем все комментарии для данной страницы
  while ($row = $result_set->fetch_assoc()) {
    //print_r($row); //Вывод комментариев
    echo $row["name"].": ".$row["message"].".";
    echo "<br />";
  }
?>
  </div>
  <H5 align="CENTER">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;© Все права защищены., 2017 год</H5>
</div>
</body>
</html>
</div>        
</body>
<html>