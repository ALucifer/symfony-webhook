<?php

namespace App\Webhook\Github;

use App\Webhook\Github\Event\GithubEvent;
use App\Webhook\Github\Strategy\GithubEventStrategy;

class GithubEventFactory
{
    /**
     * @param GithubEventStrategy[] $strategies
     */
    public function __construct(
        private iterable $strategies,
    ) {
    }

    public function transform(string $name, array $payload): GithubEvent
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->support($name)) {
                return $strategy->transform($name, $payload);
            }
        }
    }
}