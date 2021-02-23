<?php
// Страница регистрации нового пользователя 
// Соединяемся с БД
$link=mysqli_connect("localhost", "root", "", "testmodul28"); 
if(isset($_POST['submit']))
{
    $err = [];
    // проверяем логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    } 
    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    } 
    // проверяем, не существует ли пользователя с таким именем
    $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='".mysqli_real_escape_string($link, $_POST['login'])."'");
    if(mysqli_num_rows($query) > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    } 
    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {
        $login = $_POST['login'];
        // Убираем лишние пробелы и делаем двойное хэширование (используем старый метод md5)
        $password = md5(md5(trim($_POST['password']))); 
        mysqli_query($link,"INSERT INTO users SET user_login='".$login."', user_password='".$password."'");
        header("Location: log"); exit();
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}
?> 

<div class="container"> 
    <h1>Регистрация пользователя</h1>
    <form method="POST">
        <div class="row" style="padding-top: 20px">
            <div class="col">
                Логин <input name="login" type="text" required><br>
            </div>
        </div>
        <div class="row" style="padding: 20px 0px">
            <div class="col">
                Пароль <input name="password" type="password" required><br> 
            </div>
        </div>
        <div>
            <input name="submit" type="submit" class="btn btn-primary" value="Зарегистрироваться">
        </div>
    </form>
</div>



