<?php

namespace app\migrations;

use app\core\Application;
use PDO;

/**
 * User: Talha saleem
 * date:
 */


class m001_initial
{
    public function up()
    {
        $db = Application::$app->db;

        $sql = "CREATE TABLE users (
      id INT AUTO_INCREMENT PRIMARY KEY,
      firstname VARCHAR(50) NOT NULL UNIQUE,
      lastname VARCHAR(50) NOT NULL UNIQUE,
      email VARCHAR(100) NOT NULL UNIQUE,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      );";
        $db->pdo->exec($sql);
    }


    public function down()
    {
        $db = Application::$app->db;
        $sql = "DROP TABLE IF EXISTS users;";
        $db->pdo->exec($sql);
    }
}
