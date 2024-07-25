<?php

namespace app\models;


use app\core\Application;
use app\core\Model;

/**
 * Class LoginForm
 * 
 *  @author Talha Saleem
 *  @package app\models
 *  
 */

class LoginForm extends Model
{
    public string $email = "";
    public string $password = "";


    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQURIED, self::RULE_EMAIL],
            'password' => [self::RULE_REQURIED]
        ];
    }

    public function lables(): array
    {
        return [
            'email' => 'Your Email',
            'password' => 'Password'
        ];
    }
    public function login()
    {   
        $userModel = new User(); 
        $user = $userModel->findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'User does not exist wit this email');
            return false;
        }

        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }

        return Application::$app->login($user);

    }

}
