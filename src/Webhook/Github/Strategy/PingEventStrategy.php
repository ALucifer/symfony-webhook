<?php

namespace App\Webhook\Github\Strategy;

use App\Webhook\Github\Event\GithubEvent;
use App\Webhook\Github\Event\PingGithubEvent;

class PingEventStrategy implements GithubEventStrategy
{
    private const NAME = 'ping';

    public function support(string $name): bool
    {
        return $this::NAME === $name;
    }

    public function transform(string $name, array $payload): GithubEvent
    {
        return new PingGithubEvent(
            $name,
            $name,
            $payload,
        );
    }
}