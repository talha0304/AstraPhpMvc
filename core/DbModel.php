<?php

namespace app\core;

/**
 * Class DbModel 
 * 
 *  @author Talha saleem
 *  @package app\core
 */



abstract class DbModel extends Model
{
    abstract public function tableName(): string;
    abstract public function attribute(): array;
    abstract public function primarykey(): string;


    public function save()
    {
        $tableName = $this->tableName();
        $attribute = $this->attribute();
        $params = array_map(fn($attr) => ":$attr", $attribute);
        $statment = self::prepare("INSERT INTO $tableName (" . implode(',', $attribute) . ") VALUES (" . implode(',', $params) . ")");

        foreach ($attribute as $attributes) {
            $statment->bindValue(":$attributes",$this->{$attributes});
        }
        $statment->execute();
        return true;
        
    }

    public  function findOne($where){
        $tableName = static::tableName();
        $attribute = array_keys($where);
        $sql =implode("AND",array_map(fn($attr)=>"$attr = :$attr", $attribute));
        $statment = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach($where as $key =>$item ){
            $statment->bindValue(":$key",$item);
        }

        $statment->execute();
        return $statment->fetchObject(static::class);

    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    
    

}




