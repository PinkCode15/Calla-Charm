<?php

namespace App\Exceptions;

use Exception;

class CallaCharmCurlException extends Exception
{
    protected $message;

    public function __construct($message)
    {
        $this->message= $message;
        abort(403, $message);
    }
}
