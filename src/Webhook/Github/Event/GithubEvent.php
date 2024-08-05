<?php

namespace App\Webhook\Github\Event;

use Assert\Assertion;
use Symfony\Component\RemoteEvent\RemoteEvent;

abstract class GithubEvent extends RemoteEvent
{
    private const PING = 'ping';
    private const PUSH = 'push';
    private const ALL = [
        self::PING,
        self::PUSH,
    ];

    public function __construct(string $name, string $id, array $payload)
    {
        Assertion::inArray(
            $name,
            self::ALL,
            sprintf('%s is not a valid github event', $name)
        );
        parent::__construct($name, $id, $payload);
    }
}