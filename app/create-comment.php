<?php
  require_once __DIR__ . '/../db/db-mysql.php';

  use \db\DbMySql;

  $userName = $_POST['userName'];
  $message = $_POST['message'];

  $db = new DbMySql();

  $db->addComment($userName, $message);

?>