<?php

namespace app\migrations;
use app\core\Application;


/**
 * User: Talha saleem
 * date:
 */


class m002_addpassAtuser
{
    public function up()
    {
        $db = Application::$app->db;

        $sql ="ALTER TABLE users ADD COLUMN password VARCHAR(255) NOT NULL;";
   
        $db->pdo->exec($sql); 
    }


    public function down()
    {
      
        $db = Application::$app->db;

        $sql ="ALTER TABLE users DROP COLUMN password;";
   
        $db->pdo->exec($sql);
    }
}
