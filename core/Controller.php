<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;
use app\models\User;





/**
 * Class Controller 
 * 
 *  @author Talha Saleem
 *  @package app\core
 */


class Controller
{
    public string $layout = 'main';
    /**
     * Summary of middlewares
     * @var \app\core\middlewares\BaseMiddleware[]
     */
    protected array $middlewares = [];
    public string $action = '';
    public function setLayout($layout)
    {

        $this->layout = $layout;
    }

    public function render($view, $parms = [])
    {
        return Application::$app->view->renderView($view, $parms);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }


    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function ShowTableData(string $tablename, string $path)
    {
        try {
            $db = Application::$app->db;
            $sql = "SELECT * FROM `{$tablename}`";
            $stmt = $db->pdo->query($sql);
            $table = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $this->render($path, ['table' => $table]);
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();

        }
    }














}
