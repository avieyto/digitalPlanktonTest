<?php


namespace App\WikipediaApi\Exception;


use Throwable;

class WikipediaException extends \Exception implements \Throwable
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
