<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_songs');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

try {
  $pdo = new PDO(
    "mysql:host=".DB_HOST.";charset=".DB_CHARSET.";dbname=".DB_NAME,
    DB_USER, DB_PASSWORD, [
       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
  );
} catch (Exception $ex) { exit($ex->getMessage()); }

if (empty($_POST['search'])){
  if (isset($_POST['ajax'])) { echo json_encode(""); }
}

else{
  $stmt = $pdo->prepare("SELECT * FROM `tbl_songs` WHERE `song_name` LIKE ? ");
  $stmt->execute(['%'.$_POST['search']."%"]);
  $results = $stmt->fetchAll();
  if (isset($_POST['ajax'])) { echo json_encode($results); }
}