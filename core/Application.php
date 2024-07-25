<?php

namespace app\core;

use app\core\Database;
use app\models\User;

/**
 * Class Application
 * 
 *  @author Talha saleem
 *  @package app\core
 */



class Application
{
    public string $userClass;
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;

    public ?DbModel $user;
    public View $view;
    public static Application $app;
    public ?Controller $controller = null;

    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View;
        $this->db = new Database($config['db']);


        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $user = new User();
            $primaryKey = $user->primarykey();
            $user = $user->findOne([$primaryKey => $primaryValue]);
            if ($user) {
                $this->user = $user;
            }
        } else {
            $this->user = null;
        }
    }


    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $msg) {
            $this->response->setStatusCode($msg->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $msg
            ]);
        }
    }

    public function getController(): ?Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }


    public function login(DbModel $user)
    {

        $this->user = $user;
        $primaryKey = $user->primarykey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;

    }


    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }


    public static function isGuest()
    {
        return !self::$app->user;
    }
}
