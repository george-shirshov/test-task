<?php
  require_once __DIR__ . '/../db/db-mysql.php';

  use \db\DbMySql;

  $postData = file_get_contents('php://input');
  $data = json_decode($postData, true);

  $db = new DbMySql();

  $id = $db->addComment($data['userName'], $data['text'], $data['date']);

  $request = array(
    'id' => $id
  );

  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($request);
?>