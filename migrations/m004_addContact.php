<?php

namespace app\migrations;

use app\core\Application;
use PDO;

/**
 * User: Talha saleem
 * date:
 */


class m004_addContact
{
    public function up()
    {
        $db = Application::$app->db;

        $sql = "CREATE TABLE contact (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(50) NOT NULL,
      email VARCHAR(100) NOT NULL ,
      message VARCHAR(200) NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      );";
        $db->pdo->exec($sql);
    }


    public function down()
    {
        $db = Application::$app->db;
        $sql = "DROP TABLE IF EXISTS contact;";
        $db->pdo->exec($sql);
    }
}
