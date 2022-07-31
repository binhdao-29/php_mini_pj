<!-- connection.php -->

<?php
class DB
{
    private static $instance = NULl;
    public static function getInstance() {
      if (!isset(self::$instance)) {
        try {
          self::$instance = new PDO('mysql:host=localhost;dbname=sun_demo_php', 'root', '123456');
          self::$instance->exec("SET NAMES 'utf8'");
        } catch (PDOException $ex) {
          die($ex->getMessage());
        }
      }
      return self::$instance;
    }

    public static function getConn() {
      $servername = "localhost";
      $database = "sun_demo_php";
      $username = "root";
      $password = "123456";
      $conn = mysqli_connect($servername, $username, $password, $database);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      return $conn;
    }
} 
