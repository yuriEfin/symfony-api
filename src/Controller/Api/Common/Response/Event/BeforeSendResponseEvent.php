<?php

namespace App\Controller\Api\Common\Response\Event;

use App\Controller\Api\Common\Response\Interfaces\ResponseModelInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BeforeSendResponseEvent extends Event
{
    public const NAME = 'onBeforeSendResponse';
    private ResponseModelInterface $responseModel;
    
    public function __construct(ResponseModelInterface $responseModel)
    {
        $this->responseModel = $responseModel;
    }
    
    /**
     * @return ResponseModelInterface
     */
    public function getResponseModel(): ResponseModelInterface
    {
        return $this->responseModel;
    }
}