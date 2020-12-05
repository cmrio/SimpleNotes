<html>
 <head>
  <title>Вход</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="main.css">
 </head>
 <body>

<?php

// Функция для генерации хэша
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

// Коннект к БД
       include 'PDO.php';

       $err = "";
	   
if(isset($_POST['log']))
{
    
    $sql = "Select ID_User,Pass_User From usertbl Where Login_User=?";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$_POST['login']]);
    $data = $stmt->fetch();
	
   if(isset($data['Pass_User'])) {
    if($data['Pass_User'] === md5(md5($_POST['password'])))
    {
        // Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));


        // Записываем в БД новый хеш авторизации
        $sql = "Update usertbl Set Hash_User = ? Where ID_User = ?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$hash,$data['ID_User']]);

        setcookie("id", $data['ID_User'], time()+60*60*24*30, "/"); 
        setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true);
		
		
	    header("Location: home_page.php"); exit();
		
	}		
   
    else
    {
        $err = 'Вы ввели неправильный логин/пароль';
	} 
   } 
	else
    {
        $err = 'Пользователь не найден';
	}
}

if(isset($_POST['create']))
{
  header("Location: register.php"); exit();
}

?>
  <table width ="100%" height="100%" >
   <tr>
    <td width="40%">
    </td>
    <td align = "left" valign="middle"">
	 <font color="#454545" size="6"><b>Вход в аккаунт</b></font>
     <form method="POST">
	   <?php
	    echo '<b>'.$err.'</b>';
	   ?><br><br>
      Логин  <input name="login" type="text" required size="25"><br><br>
      Пароль <input name="password" type="password" required size="25"><br><br>
      <input name="log" type="submit" value="Войти">
     </form>
     <form method="POST">
      <b>Создать новый аккаунт?</b>
      <input name="create" type="submit" value="Создать">
     </form>
    </td>
   </tr>
  </table>
 </body>
</html>
