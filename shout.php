<? php
/*** mysql хост ***/
$hostname = 'localhost';

/*** mysql пользователь ***/
$username = 'root';

/*** mysql пароль ***/
$password = '';

$dbname = 'diplom';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

if($_POST['name']) {
    $name         = $_POST['name'];
    $message    = $_POST['message'];
    /*** превратить все ошибки в исключения ***/
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO shoutbox (name, message)
            VALUES (NOW(), :name, :message)";
    /*** готовим выражение ***/
    $stmt = $dbh->prepare($sql);

    /*** вставляем параметры ***/
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);

    /*** запускаем sql выражение ***/
    if ($stmt->execute()) {
        populate_shoutbox();
    }
}
}
catch(PDOException $e) {
    echo $e->getMessage();
}

/***** Это я объясню позже *****/
if($_POST['refresh']) {
    populate_shoutbox();
}
/********************************/

function populate_shoutbox() {
    // нам не нужно снова подключаться
    global $dbh;
    $sql = "select * from shoutbox order by date_time desc limit 10";
    echo '<ul>';
    foreach ($dbh->query($sql) as $row) {
        echo '<li>';
        //echo '<span class="date">'.date("d.m.Y H:i", strtotime($row['date_time'])).'</span>';
        echo '<span class="name">'.$row['name'].'</span>';
        echo '<span class="message">'.$row['message'].'</span>';
        echo '</li>';
    }
    echo '</ul>';
}
?>