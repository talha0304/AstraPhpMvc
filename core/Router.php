<?php

namespace app\core;
use app\core\exception\ForbiddenException;
use app\core\exception\NotFoundPage;



/**
 * Class Router
 * 
 *  @author Talha Saleem
 *  @package app\core
 */




class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];


    /**
     *  Router Constructor
     * 
     *  @param app\core\Request $request
     *  @param app\core\Response $response
     */



    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function delete($path, $callback)
    {
        $this->routes['delete'][$path] = $callback;
    }


    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->Method();
        $callback = $this->routes[$method][$path] ?? false;


        if ($callback === false) {
            
            throw new NotFoundPage();
        }

        if (is_string($callback)) {
            return Application::$app->view->renderView($callback);
        }
        if (is_array($callback)) {
            /**
             * @var \app\core\Controller $controller
             */
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;


            foreach($controller->getMiddlewares() as $middleware){
                    $middleware->execute();
            }

        }

        return call_user_func($callback, $this->request, $this->response);
    }


}
