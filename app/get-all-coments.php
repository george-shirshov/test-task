<?php
  require_once __DIR__ . '/../db/db-mysql.php';

  use \db\DbMySql;

  $db = new DbMySql();

  $comments = $db->getAllComments();

  $request = array(
    'comments' => json_encode($comments)
  );

  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($request);
?>