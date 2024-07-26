<?php

/**
 * User: Talha Saleem 
 * 
 * 
 */



 use app\core\Application;

 require_once __DIR__ . '/../../autoload.php';
 
 $dotenv = Dotenv\Dotenv::createMutable(__DIR__);
 $dotenv->load();
 
 $config = [
     'userClass' => \app\models\User::class,  
     'db' => [
         'dsn' => $_ENV['DB_DSN'],
         'user' => $_ENV['DB_USER'],
         'password' => $_ENV['DB_PASSWORD']
     ]
 ];
 
 $app = new Application(__DIR__, $config);
 
 $app->db->applyMigrations();
 