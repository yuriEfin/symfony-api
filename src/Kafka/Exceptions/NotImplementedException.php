<?php

namespace App\Kafka\Exceptions;


use Exception;
use Throwable;

class NotImplementedException extends Exception
{
    private const MESSAGE = 'Not implemented';
    
    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        $message = $message ? self::MESSAGE : '';
        parent::__construct($message, $code, $previous);
    }
}
