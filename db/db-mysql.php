<?php

  namespace db;

  require_once __DIR__ . '/../config.php';

  use Config;

class DbMySql
  {
    public function getAllComments(){
      $connection = $this->openConnection();

      $sqlQuery = "SELECT * FROM `Comments` ORDER BY `date` DESC";
      
      $comments = mysqli_query($connection, $sqlQuery);
      
      mysqli_close($connection);

      return mysqli_fetch_all($comments, MYSQLI_ASSOC);
    }

    public function addComment($userName, $text, $date){
      $connection = $this->openConnection();

      $userName = mysqli_real_escape_string($connection, $userName);
      $text = mysqli_real_escape_string($connection, $text);
      $date = mysqli_real_escape_string($connection, $date);

      $sqlQuery = "INSERT INTO `Comments`(`id`, `userName`, `date`, `text`) 
                   VALUES (NULL, '$userName', '$date', '$text')";
      
      mysqli_query($connection, $sqlQuery);
      
      $id = mysqli_insert_id($connection);
      
      mysqli_close($connection);

      return $id;
    }

    public function deleteComment($id){
      $connection = $this->openConnection();

      $id = (int) $id;

      $sqlQuery = "DELETE FROM `Comments` WHERE id = $id";

      $result = mysqli_query($connection, $sqlQuery);

      mysqli_close($connection);

      return $result;
    }

    private function openConnection(){
      return mysqli_connect(Config::$host, 
                            Config::$user, 
                            Config::$password, 
                            Config::$database);
    }
  }
  
?>