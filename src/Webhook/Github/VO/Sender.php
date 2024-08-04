<?php

namespace App\Webhook\Github\VO;

readonly class Sender
{
    public function __construct(
      public string $pseudo,
      public string $avatar
    ) {
    }

    public static function fromPayload(array $payload): self
    {
        if (!$sender = $payload['sender']) {
            throw new \InvalidArgumentException('Sender key must be define.');
        }


        return new self(
            $sender['login'],
            $sender['avatar_url'],
        );
    }
}