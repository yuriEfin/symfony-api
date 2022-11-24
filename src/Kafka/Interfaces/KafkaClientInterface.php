<?php

namespace App\Kafka\Interfaces;


interface KafkaClientInterface
{
    public function createTopic(string $topicName, string $key = null): self;
    
    public function createPacket(string $message, array $options = []): self;
    
    public function push(): void;
    
    public function pushWithTransaction(int $identifier, bool $isCommit = false): void;
}
