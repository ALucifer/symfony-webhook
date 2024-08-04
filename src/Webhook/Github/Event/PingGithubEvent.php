<?php

namespace App\Webhook\Github\Event;

use App\Webhook\Github\VO\Sender;

final class PingGithubEvent extends GithubEvent
{
    public function __construct(string $name, string $id, array $payload)
    {
        parent::__construct($name, $id, $payload);
    }

    public function getSender(): Sender
    {
        return Sender::fromPayload($this->getPayload());
    }
}