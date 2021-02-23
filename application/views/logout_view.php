<?php
// Страница разавторизации 
// Удаляем куки
$_SESSION['auth'] = false;
setcookie("id", "", time() - 3600*24*30*12, "/");
setcookie("hash", "", time() - 3600*24*30*12, "/",null,null,true); // httponly !!! 
// Переадресовываем браузер на страницу проверки нашего скрипта
header("Location: main"); exit; 
?>