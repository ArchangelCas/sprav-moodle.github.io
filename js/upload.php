	
<?php
// В PHP 4.1.0 и более ранних версиях следует использовать $HTTP_POST_FILES
// вместо $_FILES.
//echo "sdsadas: ".$_FILES['filename']['name'];
if(isset($_POST['upldbtn'])){
//$uploaddir = '/dirForUploads/';
//if(!mkdir("/dirForUploads", 0700))
//echo "LALKA CHTOLI";
$uploadfile = basename($_FILES['filename']['name']);
//echo "filename: ".$uploadfile;

//echo '<pre>';
if (move_uploaded_file($_FILES['filename']['tmp_name'], $uploadfile)) {
    echo "<script>alert(\"Файл корректен и был успешно загружен.\");</script>";
} else {
    echo "<script>alert(\"Возможная атака с помощью файловой загрузки!\");</script>";
}

//echo 'Некоторая отладочная информация:';
//print_r($_FILES);

//print "</pre>";

}
?>

