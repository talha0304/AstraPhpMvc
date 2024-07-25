<?php
namespace app\core;


/**
 * Class View
 * 
 *  @author Talha saleem
 *  @package app\core
 */



class View
{
   public string $title = '';


   public function renderView($view, $params = [])
   {
      $viewContent = $this->renderOnlyView($view, $params);
       $layoutContent = $this->layoutContent();
       return str_replace('{{content}}', $viewContent, $layoutContent);
   }

   public function renderContent($viewContent)
   {
       $layoutContent = $this->layoutContent();
       return str_replace('{{content}}', $viewContent, $layoutContent);
   }



   protected function layoutContent()
   {


       $Controller = Application::$app->controller ?? new Controller(); //====> Use a default controller if none is set
       $layout = $Controller->layout;
       ;
       ob_start();
       include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
       return ob_get_clean();
   }


   public function renderOnlyView($views, $params)
   {
       foreach ($params as $key => $value) {
           $$key = $value;
       }
       ob_start();
       include_once Application::$ROOT_DIR . "/views/$views.php";
       return ob_get_clean();
   }

}