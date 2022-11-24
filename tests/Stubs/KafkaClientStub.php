<?php

namespace App\Tests\Stubs;


use App\Kafka\Interfaces\KafkaClientInterface;

class KafkaClientStub implements KafkaClientInterface
{
    public function createTopic(string $topicName, string $key = null): self
    {
        return $this;
    }
    
    public function createPacket(string $message, array $options = []): self
    {
        return $this;
    }
    
    public function push(): void
    {
    }
}
