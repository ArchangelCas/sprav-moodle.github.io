<?php
class mycaptcha{
//сюда получаем сгенерированную капчу        
    public $keycaptcha;

    function captcha(){
//создаём картинку
        $myimg = imageCreateTrueColor(250, 50);
//количество символов
        $nChars=5;
//генерируем captcha
        $randStr=substr(md5(uniqid()),0,$nChars);
        $this->keycaptcha=$randStr;
//задаём подложку из картинки
        $myimg = imageCreateFromJPEG("img/bg_capcha.png");
        imageAntiAlias($img, true);
//генерируется случайное число от 1 до 4        
        function getColor(){
            $x=rand(1,4);
            return $x;
        }
//координата символа по гориз.
        $j=20;
        for ($i = 0; $i < 5; $i++) {
//получаем $i символ из сгенерир.
            $z=substr($randStr, $i, 1);
//рандомно получаем размер символа
            $size=rand(25,30);
//рандомно получаем угол поворота символа
            $angle=-30+rand(0,60);
//получаем рандомно цвет символа
            $n=getColor();
            switch ($n) {
                case 1:  $c=imageColorAllocate($myimg, 255, 0, 0); break;
                case 2:  $c=imageColorAllocate($myimg, 0, 200, 0); break;
                case 3:  $c=imageColorAllocate($myimg, 0, 0, 255); break;
                case 4:  $c=imageColorAllocate($myimg, 0, 0, 0); break;
            }
//генерируем картинку
imageTtfText($myimg, $size, $angle, $j, 30, $c,"bellb.ttf", "$z");
$j+=35;
        }
//выводим captcha
        header("Content-type: image/jpeg");
        imageJpeg($myimg);
    }
    function getKeycaptcha(){
            return $this->keycaptcha;
    }    
}
?>    