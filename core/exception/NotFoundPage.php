<?php

namespace app\core\exception;

use Exception;



/**
 * Class NotFoundPage
 * 
 *  @author Talha Saleem
 *  @package app\core\exception;;
 */


class NotFoundPage  extends \Exception
{

    protected $message = 'Page Not Found !';
    protected $code = 404;
}