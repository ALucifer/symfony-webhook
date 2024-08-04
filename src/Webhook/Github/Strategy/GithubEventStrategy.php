<?php

namespace App\Webhook\Github\Strategy;

use App\Webhook\Github\Event\GithubEvent;

interface GithubEventStrategy
{
    public function support(string $name): bool;
    public function transform(string $name, array $payload): GithubEvent;
}