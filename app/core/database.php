<?php
//require '../app/core/config.php';

class Database
{
    public function db_connect()
    {
        try {
            $string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";";
            return $db = new PDO($string, DB_USER, DB_PASS);
        } catch (PDOException $e)
        {
          die($e->getMessage());  
        }
    }
}