<?php

namespace App\Webhook\Github\Event;

use App\Webhook\Github\VO\Sender;

final class PushGithubEvent extends GithubEvent
{
    public function __construct(string $name, string $id, array $payload)
    {
        parent::__construct($name, $id, $payload);
    }

    public function getSender(): Sender
    {
        return Sender::fromPayload($this->getPayload());
    }

    public function getMessage(): string
    {
        return $this->getPayload()['head_commit']['message'];
    }

    public function getCountAddedFiles(): int
    {
        return count($this->getPayload()['head_commit']['added']);
    }

    public function getCountDeletedFiles(): int
    {
        return count($this->getPayload()['head_commit']['removed']);
    }

    public function getCountModifiedFiles(): int
    {
        return count($this->getPayload()['head_commit']['modified']);
    }

    public function getCommitUrl(): string
    {
        return $this->getPayload()['head_commit']['url'];
    }
}