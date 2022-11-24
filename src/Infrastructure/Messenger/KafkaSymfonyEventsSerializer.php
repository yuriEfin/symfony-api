<?php

namespace App\Infrastructure\Messenger;


use App\Infrastructure\Messenger\Handler\SymfonyEventsHandlerDataInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;


class KafkaSymfonyEventsSerializer implements SerializerInterface
{
    public function decode(array $encodedEnvelope): Envelope
    {
        return new Envelope(
            new class ($encodedEnvelope) implements SymfonyEventsHandlerDataInterface {
                public function __construct(private readonly array $body)
                {
                }
                
                public function getBody(): array
                {
                    return $this->body;
                }
            }
        );
    }
    
    public function encode(Envelope $envelope): array
    {
        return json_decode($envelope->getMessage(), true);
    }
}
