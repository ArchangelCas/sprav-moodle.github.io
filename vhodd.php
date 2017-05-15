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
    <h1 class="pageTitle" align="center">Вход</h1>
    <form action="#" method="post">
      <p>
    <label>Логин<br></label>
    <input name="login" type="text" size="15" maxlength="15" placeholder= "Иван" required>
  </p>

  <p>
    <label>Пароль<br></label>
    <input name="password" type="password" size="15" maxlength="15" placeholder= "12345678" required>
  </p>
<p>
<input type="submit" name="submit" value="Войти">
<br>
<br>
<form>
  <input type="button" value="Создать пользователя" onclick="javascript:window.location='registraziya.php'"/>
</form>
  <?php
session_start();
?>
<?php $connection = mysqli_connect('localhost', 'root', '', 'diplom') or die(mysqli_error()); ?>
<?php if (isset($_POST['submit'])) // Отлавливаем нажатие кнопки "Отправить"
{
if (empty($_POST['login'])) // Если поле логин пустое
{
echo '<script>alert("Поле логин не заполненно");</script>'; // То выводим сообщение об ошибке
}
elseif (empty($_POST['password'])) // Если поле пароль пустое
{
echo '<script>alert("Поле пароль не заполненно");</script>'; // То выводим сообщение об ошибке
}
else  // Иначе если все поля заполненны
{    
$login = $_POST['login']; // Записываем логин в переменную 
$password = $_POST['password']; // Записываем пароль в переменную           
$query = mysqli_query($connection, "SELECT `id` FROM `reg` WHERE `login` = '$login' AND `password` = '$password'"); // Формируем переменную с запросом к базе данных с проверкой пользователя
$result = mysqli_fetch_array($query); // Формируем переменную с исполнением запроса к БД 
if (empty($result['id'])) // Если запрос к бд не возвразяет id пользователя
{
echo '<script>alert("Неверные Логин или Пароль");</script>'; // Значит такой пользователь не существует или не верен пароль
}
else // Если возвращяем id пользователя, выполняем вход под ним
{
$_SESSION['password'] = $password; // Заносим в сессию  пароль
$_SESSION['login'] = $login; // Заносим в сессию  логин
$_SESSION['id'] = $result['id']; // Заносим в сессию  id
echo '<div align="center">Вы успешно вошли в систему: '.$_SESSION['login'].'</div>'; // Выводим сообщение что пользователь авторизирован        
}     
}   
} ?>
 <!-- <a href="vihod.php" align="left">Выйти</a> -->
  </p>
  </form>
<div id="shout"></div>
  </div>
  <H5 align="CENTER">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;© Все права защищены., 2017 год</H5>
</div>
</body>
</html>