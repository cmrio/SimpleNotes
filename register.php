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

       //Коннет к БД
       $host = 'localhost'; 
       $db   = 'notes_db';
       $user = 'vitaliy';
       $pass = '1234';
       $charset = 'utf8';
       $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
       $pdo = new PDO($dsn, $user, $pass,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); 

if(isset($_POST['registr']))
{
    $err = "";

    // проверяем, не сущестует ли пользователя с таким именем
    $sql = "Select ID_User From usertbl Where Login_user=?";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$_POST['login']]);
    $row = $stmt->fetch();

    if(isset($row['ID_User']))
    {
        $err = "Пользователь с таким логином уже существует в базе данных";
    }

    // Если нету пользователя с таким именем, то добавляем в БД.
    if($err == "")
    {

        $login = $_POST['login'];
        
        $password = md5(md5(trim($_POST['password'])));
        $sql = "Insert into usertbl(Login_User,Pass_User) Values(?,?)";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$login,$password]);
        
        // Вытаскиваем из БД код нового пользователя
        $sql = "Select ID_User From usertbl Where Login_User=?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$_POST['login']]);
        $data = $stmt->fetch();

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
      print "<b>".$err."<br>";
    }
    
}

if(isset($_POST['auth']))
{
  header("Location: login.php"); exit();
}
?>

<form method="POST">

Логин <input name="login" title="Длина 4-20 символов. Может содержать только буквы латинского алфавита" pattern="(?=.*[a-zA-Z]).{4,20}" type="text" required><br>

Пароль <input name="password" title="Длина 6-20 символов. Должен содержать хотя бы одну букву верхнего регистра [A-Z] и хотя бы одну цифру [0-9]" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}" type="password" required><br>

<input name="registr" type="submit" value="Зарегистрироваться"> <br>
</form>
<form method="POST">
Уже есть аккаунт?
<input name="auth" type="submit" value="Войти">
</form>