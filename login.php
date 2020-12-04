<?php

// Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

// Соединямся с БД
       $host = 'localhost';
       $db   = 'notes_db';
       $user = 'vitaliy';
       $pass = '1234';
       $charset = 'utf8';
       $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
       $pdo = new PDO($dsn, $user, $pass,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

if(isset($_POST['submit']))
{
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $sql = "Select ID_User,Pass_User From usertbl Where Login_User=?";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$_POST['login']]);
    $data = $stmt->fetch();

    // Сравниваем пароли
    if($data['Pass_User'] === md5(md5($_POST['password'])))
    {
        // Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));


        // Записываем в БД новый хеш авторизации
        $sql = "Update usertbl Set Hash_User = ? Where ID_User = ?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$hash,$data['ID_User']]);

        // Ставим куки
        setcookie("id", $data['ID_User'], time()+60*60*24*30, "/");
        setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true);

        // Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: home_page.php"); exit();
    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
?>
<form method="POST">
Логин <input name="login" type="text" required><br>
Пароль <input name="password" type="password" required><br>
<input name="submit" type="submit" value="Войти">
</form>