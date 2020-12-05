<html>
 <head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="main.css">
 </head>
 <body>
<?php
$host = 'localhost';
$db   = 'notes_db';
$user = 'vitaliy';
$pass = '1234';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

 if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])){
  $sql = "Select * From usertbl Where ID_User=?";
  $stmt= $pdo->prepare($sql);
  $stmt->execute([$_COOKIE['id']]);
  $userdata = $stmt->fetch();
 
 if(($userdata['Hash_User'] !== $_COOKIE['hash']) or ($userdata['ID_User'] !== $_COOKIE['id'])){
   setcookie("id", "", time() - 3600*24*30*12, "/");
   setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true);
    echo '<script language="javascript">';
    echo 'alert(Что-то не получилось, попробуйте ещё раз)';  
    echo '</script>';
	header("Location: login.php"); exit();
 }
   else {
	 echo '<table width="100%">
	        <tr>
			 <td align="center" width="70%">
			  <font color="#454545" size="6"><b>Ваши заметки</b></font>
			 </td>
			 <td align="right" width="30%">
			  <font color="#454545" size="3"><b>Добро пожаловать, '.$userdata['Login_User'].'</b></font><br>
			   <form method="POST">
			    <input name="logout" type="submit" value="Выход"><br><br>
			   </form>
			 </td>
			</tr>
			<tr>
			 <td align="center" valign="top" width="70%">';
			  $i = 0;
			  $sql = "Select ID_Note,Text_Note,Date_Note From notetbl Where Usr_ID=?";
              $stmt= $pdo->prepare($sql);
              $stmt->execute([$userdata['ID_User']]);
				  
                while($notedata = $stmt->fetch()) {
                  $note[$i][0] = $notedata['ID_Note'];
                  $note[$i][1] = $notedata['Text_Note'];
                  $note[$i][2] = $notedata['Date_Note'];
                $i = $i+1 ; }
				
				if($i != 0) {
					for($i = 0; $i < count($note); $i++) {
					 echo '<form method="POST">
                            <font color="#454545" size="3"<b>Дата: '.$note[$i][2].'</b></font>
                            <input name="changenote" type="submit" value="Изменить">
                            <input name="deletenote" type="submit" value="Удалить"><br>
							<input name="idnote" type="hidden" value='.$note[$i][0].'>
                             <textarea class="note" name="textnote" required>'.$note[$i][1].'</textarea>
                           </form><br>';
					}
				}					
				  
				echo '</td>
                       <td width="30%" valign="top" align="right">
                        <table>
                         <tr>
                          <form method="POST">
                           <textarea class="newnote" name="newnote" required placeholder="Введите новую заметку"></textarea><br>
                           <input name="addnote" type="submit" value="Добавить"><br><br>
                          </form>
                         </tr>
                        </table>
                       </td>
                      </tr>
                     </table>
 </body>
<html>';
   }
 }
 
     else {
		 echo '<script language="javascript">';
          echo 'alert(Включите cookie)';  
         echo '</script>';
	     header("Location: login.php"); exit();
	 }

 if(isset($_POST['addnote'])) {
  $sql = "INSERT INTO notetbl (Text_Note, Usr_ID, Date_Note) VALUES (?,?,?)";
  $stmt= $pdo->prepare($sql);
   if($stmt->execute([$_POST['newnote'], $userdata['ID_User'], date("Y-m-d")])) {
    header("Refresh: 0");
                                                                                }
 }
 if(isset($_POST['changenote'])) {
  $sql = "Update notetbl SET Text_Note=?, Date_Note=? Where ID_Note=?";
  $stmt= $pdo->prepare($sql);
 if($stmt->execute([$_POST['textnote'], date("Y-m-d"), $_POST['idnote']])) {
    header("Refresh: 0");
   }
 }
 if(isset($_POST['deletenote'])) {
  $sql = "Delete from notetbl Where ID_Note=?";
  $stmt= $pdo->prepare($sql);
   if($stmt->execute([$_POST['idnote']])) {
    header('Refresh: 0');
   }
 }							  
							  
 if(isset($_POST['logout'])) {
  setcookie("id", "", time() - 3600*24*30*12, "/");
  setcookie("hash", "", time() - 3600*24*30*12, "/",null,null,true);
  header("Location: login.php"); exit();
 }
?>				  
