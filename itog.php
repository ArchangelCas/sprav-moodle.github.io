<html>
<head>
 <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width">
<link href="style.css" rel="stylesheet" type="text/css" >
	<title>
		Итоговый тест
	</title>
  <script type="text/javascript" src="js/script2.js"></script>
	<link rel="shortcut icon" href="img/znak.png" type="img/png">
  <script type="text/javascript" src="js/script1.js"></script>

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
    <li><a href="vhodd.php">Регистрация</a></li>
    <div class="clear"></div>
  </ul>
  <div class="footer">
<?php
 $test = array (
  array ('q'=>'Вопрос №1. Что включает в себя пользовательский интерфейс?','t'=>'multiselect',
    'i'=>'<br>Вход, Навигация, Новости|<br>Ссылку|<br>Выбор языка','a'=>'1|0|0'),
  array ('q'=>'Вопрос №2. Что включает в себя процедура регистрации?','t'=>'multiselect',
    'i'=>'<br>Редактирование учетной записи|<br>Создание учетной записи|<br>Удаление учетной записи','a'=>'0|1|0'),
  array ('q'=>'Вопрос №3. Курсы разбиваются на категории и ...?<br>','t'=>'text','a'=>'7'),
  array ('q'=>'Вопрос №4. Стандарт организации учебного материала. Что это?<br>','t'=>'text','a'=>'1'),
  array ('q'=>'Вопрос №5. Что входит в основное содержание курса?','t'=>'multiselect',
   'i'=>'<br>Нулевой и тематический раздел|<br>Ресурсы|<br>Учебного курса','a'=>'1|0|0')
 );
 if (!empty($_POST['action'])) { //считаем правильные и выводим резюме
  $ball = 0;
  foreach ($test as $key=>$val) {
   switch ($val['t']) {
    case 'checkbox':
     if (isset($_POST[$key]) and $val['a']==1 or !isset($_POST[$key]) and $val['a']==0) $ball++;
    break;
    case 'text':
     if (isset($_POST[$key]) and strlwr_($_POST[$key])==strlwr_($val['a'])) $ball++;
    break;
    case 'select':
     if (isset($_POST[$key]) and $_POST[$key]==$val['a']) $ball++;
    break;
    case 'multiselect':
     $i = explode ('|',$val['a']);
     $cnt = 0;
     foreach ($i as $number=>$answer)
      if (isset($_POST[$key.'_'.$number]) and $answer==1 or !isset($_POST[$key.'_'.$number]) and $answer==0) $cnt++;
     if ($cnt==count($i)) $ball++;
    break;
   }
  }
  $p = round ($ball/count($test)*100);
  echo '<p>Верных ответов: '.$ball.' из '.count($test).', '.$p.'%.</p>';
  echo '<p><a href="'.$_SERVER['PHP_SELF'].'">Ещё раз!</a></p>';
 }
 else { //предложить форму
  echo '<p align="center">Отметьте верные утверждения или введите ответ.</p>';
  $counter = 1;
  echo '<form method="post">';
  foreach ($test as $key=>$val) {
   error_check ($val);
   echo ($counter++).'. ';
   switch ($val['t']) {
    case 'checkbox':
     echo $val['q'].' <input type="checkbox" name="'.$key.'" value="1">';
    break;
    case 'text':
     $len = strlen ($val['a']);
     echo $val['q'].' <input type="text" name="'.$key.'" value="" maxlength="20" size="15">'; 
    break;
    case 'select':
     echo $val['q'].' <select name="'.$key.'" size="1">';
     $i = explode ('|',$val['i']);
     foreach ($i as $number=>$item) echo '<option value="'.$number.'">'.$item;
     echo '</select>';
    break;
    case 'multiselect':
     $i = explode ('|',$val['i']);   
     echo $val['q'].':&nbsp;&nbsp;&nbsp;';
     foreach ($i as $number=>$item)
      echo $item.' <input type="checkbox" name="'.$key.'_'.$number.'" value="1">&nbsp;&nbsp;&nbsp;';
    break;
   }
   echo '<br>';
  }
  echo '<input type="submit" name="action" value="Ответить"></form>';
 }

 function error_check ($q) {
  $question_types = array ('checkbox', 'text', 'select', 'multiselect');
  $error = '';
  if (!isset($q['q']) or empty($q['q'])) $error='Нет текста вопроса или он пуст';
  else if (!isset($q['t']) or empty($q['t'])) $error='Не указан или пуст тип вопроса';
  else if (!in_array($q['t'],$question_types)) $error='Указан неверный тип вопроса';
  else if (!isset($q['a']) or empty($q['a']) and $q['a']!='0') $error='Нет текста ответа или он пуст';
  else {
   if ($q['t']=='checkbox' and !($q['a']=='0' or $q['a']=='1')) $error = 'Для переключателя разрешены ответы 0 или 1';
   else if ($q['t']=='select' || $q['t']=='multiselect') {
    if (!isset($q['i']) or empty($q['i'])) $error='Не указаны элементы списка';
    else {
     $i = explode ('|',$q['i']);
     if (count($i)<2) $error='Нет хотя бы 2 элементов списка вариантов ответа с разделителем |';
     foreach ($i as $s) if (strlen($s)<1) { $error = 'Вариант ответа короче 1 символа'; break; }
     else {
      if ($q['t']=='select' and !array_key_exists($q['a'],$i)) $error='Ответ не является номером элемента списка';
      if ($q['t']=='multiselect' ) {
       $a = explode ('|',$q['a']);
       if (count($i)!=count($a)) $error='Число утверждений и ответов не совпадает';
       foreach ($a as $s) if ($s!='0' and $s!='1') { $error = 'Утверждение не отмечено как верное или неверное'; break; }
      }
     }
    }
   }
  }
  if (!empty($error)) {
   echo '<p>Найдена ошибка теста: '.$error.'</p><p>Отладочная информация:</p>';
   print_r ($q);
   exit;
  }
 }
 
 function strlwr_($s){
  $hi = "ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ";
  $lo = "abcdefghijklmnopqrstuvwxyzабвгдеёжзийклмнопрстуфхцчшщъыьэюя";
  $len = strlen ($s);
  $d='';
  for ($i=0; $i<$len; $i++) {
   $c = substr($s,$i,1);
   $n = strpos($c,$hi); 
   if ($n!==FALSE) $c = substr ($lo,$n,1);
   $d .= $c;
  }
  return $d;
 }
?>
<script type="text/javascript">
</script>
<!-- /скрипт расчета результатов тестирования -->
<!-- форма вывода результатов тестирования -->
</div>
  <H5 align="CENTER">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;© Все права защищены., 2017 год</H5>
</div>
</div> 
</body>
<html>