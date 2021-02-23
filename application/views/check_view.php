<?php
    // Скрипт проверки 
    // Соединяемся с БД
    $link=mysqli_connect("localhost", "root", "", "testmodul28");
    $infoText = 0;
     
    if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
    {
        $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
        $userdata = mysqli_fetch_assoc($query);
     
        if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])
     or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0.0.0.0")))
        {
            setcookie("id", "", time() - 3600*24*30*12, "/");
            setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true); // httponly !!!
            $infoText = 1;

        }
        else
        {   
            $_SESSION['auth'] = true;
            $infoText = 2;
        }
    }
    else
    { 
        $infoText = 3;
    }
?>
<div class="container"> 
    <div class="row" style="margin-top: 50px">
        <?php if ($infoText  == 1): ?>
            <div class="col-xs">
                <p class="lead">Хм, что-то не получилось</p>
            </div>
        <?php elseif ($infoText == 2):  ?>
            <div class="col-xs">
                <p class="lead">Привет, пользователь <?php echo $userdata['user_login'] ?>. Всё работает!</p>
            </div>
        <?php elseif ( $infoText  == 3) :  ?>
            <div class="col-xs">
                <p class="lead">Включите кук!</p>
            </div>;
       <?php endif ?>
   </div>
   <div class="row">
        <div class="col-xs" style="margin-right: 50px">
            <Button type="button" class="btn btn-outline-warning"><a href="/download">Можешь перейти к Галереи!</a></Button>
        </div>
        <div class="col-xs">
            <Button type="button" class="btn btn-outline-warning"><a href="/logout">Выйти</a></Button>
        </div>
    </div>
</div>

