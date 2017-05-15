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
    <li><a href="http://moodle.dpo-energo.ru"><img src="img/23.jpg" alt=""></a></li>
    <li><a href="vhodd.php">Вход</a></li>
    <div class="clear"></div>
  </ul>
  <div class="footer">
    <h1 class="pageTitle" align="center">Создание новой учетной записи</h1>
    <form action="#" method="post">
    <h2>Выберите имя пользователя и пароль</h2><hr>
    <label>Логин<br></label>
    <input name="login" type="text" size="27" maxlength="30" placeholder= "" required>
    <p>Пароль должен содержать символов - не менее 8, цифр - не менее 1, строчных букв - не менее 1, прописных букв - не менее 1, не менее 1 символов, не являющихся буквами и цифрами, например таких как *, - или #.</p>
    <label>Пароль<br></label>
    <input name="password" type="password" size="27" maxlength="30" placeholder= "" required><br>
    <label>Подтвердите пароль<br></label>
    <input name="r_password" type="password" size="27" maxlength="30" placeholder= "" required>
  <h2>Заполните информацию о себе</h2><hr>
    <label>Адрес электронной почты<br></label>
    <input name="email" type="text" size="27" maxlength="100" placeholder= "" required><br>
    <label>Адрес электронной почты (еще раз)<br></label>
    <input name="r_email" type="text" size="27" maxlength="100" placeholder= "" required><br>
    <label>Имя<br></label>
    <input name="name" type="text" size="27" maxlength="30" placeholder= "" required><br>
    <label>Фамилия<br></label>
    <input name="surname" type="text" size="27" maxlength="30" placeholder= "" required><br>
    <label>Город<br></label>
    <input name="сity" type="text" size="27" maxlength="30" placeholder= "Томск" required><br>
    <label>Страна<br></label>
<select>
<option>Микронезия, федеральные штаты</option>
<option>Доминиканская республика</option>
<option selected="">Россия</option>
<option>США</option>
<option>Китай</option>
<option>Польша</option><
<option>Украина</option></select>

<p>
<input type="submit" name="submit" value="Зарегистрироваться">
<br>
<?php $connection = mysqli_connect('localhost', 'root', '', 'diplom') or die(mysqli_error()); ?>
<?php if (isset($_POST['submit'])) // Отлавливаем нажатие на кнопку отправить 
{
if (empty($_POST['login']))  // Условие - если поле логин пустое
{
echo "<script>alert('Поле логин не заполненно');</script>"; // Выводим сообщение об ошибке
}  
elseif (empty($_POST['email']))  // Условие - если поле емайл пустое
{
echo "<script>alert('Поле Email не заполненно');</script>"; // Выводим сообщение об ошибке
}          
elseif (empty($_POST['password'])) // Иначе если поле с паролем пустое
{
echo "<script>alert('Поле логин не заполненно');</script>"; // Выводим сообщение об ошибке
}  
elseif (empty($_POST['r_password'])) // Иначе если поле с подтверждением пароля пустое
{
echo "<script>alert('Вы не подтвердили пароль');</script>"; // Выводим сообщение об ошибке
}     
elseif (empty($_POST['r_email']))  // Условие - если поле емайл пустое
{
echo "<script>alert('Поле Email не заполненно');</script>"; // Выводим сообщение об ошибке
} 
elseif (empty($_POST['name']))  // Условие - если поле емайл пустое
{
echo "<script>alert('Поле имя не заполненно');</script>"; // Выводим сообщение об ошибке
}    
elseif (empty($_POST['surname']))  // Условие - если поле емайл пустое
{
echo "<script>alert('Поле Фамилия не заполненно');</script>"; // Выводим сообщение об ошибке
}                  
elseif (empty($_POST['city']))  // Условие - если поле емайл пустое
{
echo "<script>alert('Поле Город не заполненно');</script>"; // Выводим сообщение об ошибке
}            
                
else // Иначе если поля не пустые
{
$login = $_POST['login']; // Присваиваем переменной значение из поля с логином             
$email = $_POST['email']; // Присваиваем другой переменной значение из поля с email
$password = $_POST['password']; // Присваиваем другой переменной значение из поля с паролем
$r_password = $_POST['r_password']; // Присваиваем другой переменной значение из поля с паролем
$name = $_POST['name']; // Присваиваем переменной значение из поля с логином             
$r_email = $_POST['r_email']; // Присваиваем другой переменной значение из поля с email
$surname = $_POST['surname']; // Присваиваем другой переменной значение из поля с паролем
$city = $_POST['city']; // Присваиваем другой переменной значение из поля с паролем
$query = "INSERT INTO `reg` (login, email, password, r_password, r_email, name, surname, city) VALUES ('$login', '$email', '$password', '$r_password', '$r_email', '$name', '$surname', '$city')"; // Создаем переменную с запросом к базе данных на отправку нового юзера
$result = mysqli_query($connection, $query) or die(mysql_error()); // Отправляем переменную с запросом в базу данных 
echo "<div align='center'>Регистрация прошла успешно!</div>"; // Сообщаем что все получилось
}
} ?>
  </p>
  </form>
<div id="shout"></div>
  </div>
  <H5 align="CENTER">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;© Все права защищены., 2017 год</H5>
</div>
</body>
</html>