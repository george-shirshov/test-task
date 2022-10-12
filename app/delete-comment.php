<?php
  require_once __DIR__ . '/../db/db-mysql.php';

  use \db\DbMySql;

  $id = $_POST['deleteButton'];

  $db = new DbMySql();

  $db->deleteComment($id);

?>