<?php

namespace App\Webhook\Github\Strategy;

use App\Webhook\Github\Event\GithubEvent;
use App\Webhook\Github\Event\PushGithubEvent;

class PushEventStrategy implements GithubEventStrategy
{
    private const NAME = 'push';

    public function support(string $name): bool
    {
        return self::NAME === $name;
    }

    public function transform(string $name, array $payload): GithubEvent
    {
        return new PushGithubEvent($name, '', $payload);
    }
}