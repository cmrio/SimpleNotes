<?php
	   $host = 'localhost';
       $db   = 'notes_db';
       $user = 'vitaliy';
       $pass = '1234';
       $charset = 'utf8';
       $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
       $pdo = new PDO($dsn, $user, $pass,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
?>