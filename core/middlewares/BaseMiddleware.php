<?php

namespace app\core\middlewares;



/**
 * Class BaseMiddleware 
 * 
 *  @author Talha Saleem
 *  @package app\core\middlewares;
 */


 abstract Class BaseMiddleware {
    abstract public function execute();
 }