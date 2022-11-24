<?php

namespace App\Infrastructure\Messenger\Handler;


use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SymfonyEventsHandler
{
    public function __invoke(SymfonyEventsHandlerDataInterface $message)
    {
        var_export($message);
        
        return true;
    }
}
