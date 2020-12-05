<?php
       $host = 'namehost';
       $db   = 'notes_db';
       $user = 'username';
       $pass = 'password';
       $charset = 'utf8';
       $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
       $pdo = new PDO($dsn, $user, $pass,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
?>
