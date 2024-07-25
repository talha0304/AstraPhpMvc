<?php

namespace app\models;

use app\core\Model;


/**
 * Class ContactForm
 * 
 *  @author Talha Saleem
 *  @package app\models
 *  
 */



class ContactForm extends Model
{
    public string $name = '';
    public string $email = '';
    public string $message = '';

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQURIED],
            'email' => [self::RULE_REQURIED],
            'message' => [self::RULE_REQURIED]

        ];
    }


    public function lables(): array
    {
       return  [
            'name' => 'Enter your Name',
            'email' => ' Email',
            'message' => 'Enter your Message'
        ];

    }


    public function send(){
        return true;
    }
}



