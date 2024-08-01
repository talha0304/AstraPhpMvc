<?php

namespace app\models;


use app\core\UserModel;

/**
 * Class User
 * 
 *  @author Talha Saleem
 *  @package app\models
 *  
 */

class User extends UserModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;


    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $ConfromPass = '';
    public int $status = self::STATUS_INACTIVE;

    public function tableName(): string
    {
        return "users";
    }

    public  function primarykey(): string{
        return 'id';
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();

    }

    public function update($id)
    {
        $attributes = $this->attribute();
        $params = array_map(fn($attr) => "$attr = :$attr", $attributes);
        $sql = "UPDATE {$this->tableName()} SET " . implode(',', $params) . " WHERE id = :id";
        $statement = self::prepare($sql);
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }


    public function delete($id)
    {
        $sql = "DELETE FROM {$this->tableName()} WHERE id = :id";
        $statement = self::prepare($sql);
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }


    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQURIED],
            'lastname' => [self::RULE_REQURIED],
            'email' => [self::RULE_REQURIED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQURIED, [self::RULE_MIN, 'min' => 3], [self::RULE_MAX, 'max' => 24]],
            'ConfromPass' => [self::RULE_REQURIED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function attribute(): array
    {
        return ['firstname', 'lastname', 'email', 'password', 'status'];
    }


    public function lables(): array{
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'ConfromPass' => 'Comform Password',
        ];
    }



    public function getDisplayName(): string{
        return $this->firstname.''.$this->lastname;
    }
}
