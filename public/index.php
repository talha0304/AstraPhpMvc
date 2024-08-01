<?php

/** User : Talha Saleem */

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;
use app\models\User;

require_once __DIR__ . '/../../../autoload.php';
$dotenv = Dotenv\Dotenv::createMutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/contact', [SiteController::class, 'Contact']);
$app->router->post('/contact', [SiteController::class, 'Contact']);



$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [SiteController::class, 'showUsers']);
$app->router->post('/deleteuser', [SiteController::class, 'deleteUser']);
$app->router->get('/updateuser', [SiteController::class, 'updateUser']);
$app->router->post('/updateuser', [SiteController::class, 'updateUser']);




$app->run();


