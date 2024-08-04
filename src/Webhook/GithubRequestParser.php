<?php

namespace App\Webhook;

use App\Webhook\Github\Event\GithubEvent;
use App\Webhook\Github\GithubEventFactory;
use Symfony\Component\HttpFoundation\ChainRequestMatcher;
use Symfony\Component\HttpFoundation\Exception\JsonException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestMatcher\IsJsonRequestMatcher;
use Symfony\Component\HttpFoundation\RequestMatcher\MethodRequestMatcher;
use Symfony\Component\HttpFoundation\RequestMatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\RemoteEvent\RemoteEvent;
use Symfony\Component\Webhook\Client\AbstractRequestParser;
use Symfony\Component\Webhook\Exception\RejectWebhookException;

final class GithubRequestParser extends AbstractRequestParser
{
    public function __construct(private GithubEventFactory $factory)
    {
    }

    protected function getRequestMatcher(): RequestMatcherInterface
    {
        return new ChainRequestMatcher([
            new IsJsonRequestMatcher(),
            new MethodRequestMatcher('POST'),
        ]);
    }

    /**
     * @throws JsonException
     */
    protected function doParse(Request $request, #[\SensitiveParameter] string $secret): ?RemoteEvent
    {
        list($hash, $signature) = explode('=', $request->headers->get('X-Hub-Signature'));

        $payload = hash_hmac($hash, $request->getContent(), $secret);
        $valid = hash_equals($payload, $signature);

        if (!$valid) {
            throw new RejectWebhookException(Response::HTTP_UNAUTHORIZED, 'Invalid signature');
        }

        return $this->factory->transform(
            $request->headers->get('X-GitHub-Event'),
            $request->getPayload()->all()
        );
    }
}
