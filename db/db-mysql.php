<?php

  namespace db;

  require_once __DIR__ . '/../config.php';

  use Config;

  class DbMySql
  {
    public function getAllComments(){
      $connection = mysqli_connect(Config::$host, 
                                    Config::$user, 
                                    Config::$password, 
                                    Config::$database);

      $sqlQuery = "SELECT * FROM `Comments` ORDER BY dateComment DESC";
      
      $comments = mysqli_query($connection, $sqlQuery);
      
      mysqli_close($connection);

      return mysqli_fetch_all($comments);
    }

    public function addComment($userName, $message){
      $connection = mysqli_connect(Config::$host, 
                                    Config::$user, 
                                    Config::$password, 
                                    Config::$database);

      $userName = mysqli_real_escape_string($connection, $userName);
      $message = mysqli_real_escape_string($connection, $message);

      $sqlQuery = "INSERT INTO `Comments`(`id`, `userName`, `dateComment`, `comment`) 
                    VALUES (NULL,'$userName', now(),'$message')";
      
      mysqli_query($connection, $sqlQuery);

      mysqli_close($connection);
    }

    public function deleteComment($id)
    {
      $connection = mysqli_connect(Config::$host, 
                                    Config::$user, 
                                    Config::$password, 
                                    Config::$database);

      $id = (int) $id;

      $sqlQuery = "DELETE FROM `Comments` WHERE id = $id";

      mysqli_query($connection, $sqlQuery);

      mysqli_close($connection);
    }
  }
  
?>