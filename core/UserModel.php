<?php
namespace app\core;


/**
 * Class UserModel
 * 
 *  @author Talha saleem
 *  @package app\core
 */




abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
    
    public function delete()
    {
        $tableName = $this->tableName();
        $primaryKey = $this->primaryKey();
        $condition = "$primaryKey = {$this->$primaryKey}";
        return Application::$app->db->delete($tableName, $condition);
    }
}