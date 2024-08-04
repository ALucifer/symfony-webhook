<?php

namespace App\RemoteEvent;

use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\RemoteEvent\Attribute\AsRemoteEventConsumer;
use Symfony\Component\RemoteEvent\Consumer\ConsumerInterface;
use Symfony\Component\RemoteEvent\RemoteEvent;
use Symfony\Component\Serializer\SerializerInterface;

#[AsRemoteEventConsumer('github')]
final class GithubWebhookConsumer implements ConsumerInterface
{
    public function __construct(
        private HubInterface $hub,
        private SerializerInterface $serializer
    ) {
    }

    public function consume(RemoteEvent $event): void
    {
        try {
            $update = new Update(
                'test',
                $this->serializer->serialize($event, 'json')
            );

            $this->hub->publish($update);
        } catch (\Throwable $e) {
            dump($e->getMessage());
        }
    }
}
