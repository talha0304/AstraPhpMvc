<?php

namespace app\core\exception;

use Exception;



/**
 * Class ForbiddenException
 * 
 *  @author Talha Saleem
 *  @package app\core\exception;;
 */


class ForbiddenException extends \Exception
{

    protected $message = 'You dont have to access this page';
    protected $code = 403;
}