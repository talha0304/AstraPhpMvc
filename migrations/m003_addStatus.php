<?php

namespace app\migrations;
use app\core\Application;


/**
 * User: Talha saleem
 * date:
 */


class m003_addStatus
{
    public function up()
    {
            
        $db = Application::$app->db;

        $sql ="ALTER TABLE users ADD COLUMN status int  NOT NULL;";
   
        $db->pdo->exec($sql); 
    }


    public function down()
    {
        $db = Application::$app->db;

        $sql ="ALTER TABLE users DROP COLUMN status;";
   
        $db->pdo->exec($sql); 
        
    }
}
