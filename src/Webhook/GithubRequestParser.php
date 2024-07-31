<?php

namespace App\Webhook;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\ChainRequestMatcher;
use Symfony\Component\HttpFoundation\Exception\JsonException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestMatcher\IsJsonRequestMatcher;
use Symfony\Component\HttpFoundation\RequestMatcher\MethodRequestMatcher;
use Symfony\Component\HttpFoundation\RequestMatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Symfony\Component\RemoteEvent\RemoteEvent;
use Symfony\Component\Webhook\Client\AbstractRequestParser;
use Symfony\Component\Webhook\Exception\RejectWebhookException;

final class GithubRequestParser extends AbstractRequestParser
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    protected function getRequestMatcher(): RequestMatcherInterface
    {
        dd('ok');
        $this->logger->debug('Hello world');

        return new ChainRequestMatcher([
//            new IsJsonRequestMatcher(),
//            new MethodRequestMatcher('POST'),
        ]);
    }

    /**
     * @throws JsonException
     */
    protected function doParse(Request $request, #[\SensitiveParameter] string $secret): ?RemoteEvent
    {
        // TODO: Adapt or replace the content of this method to fit your need.

//        dd('ok');
//        // Validate the request against $secret.
//        $authToken = $request->headers->get('X-Authentication-Token');
//
//        if ($authToken !== $secret) {
//            throw new RejectWebhookException(Response::HTTP_UNAUTHORIZED, 'Invalid authentication token.');
//        }
//
//        // Validate the request payload.
//        if (!$request->getPayload()->has('name')
//            || !$request->getPayload()->has('id')) {
//            throw new RejectWebhookException(Response::HTTP_BAD_REQUEST, 'Request payload does not contain required fields.');
//        }
//
//        // Parse the request payload and return a RemoteEvent object.
//        $payload = $request->getPayload();

        return new RemoteEvent(
            'test',
            'id',
            []
        );
//        return new RemoteEvent(
//            $payload->getString('name'),
//            $payload->getString('id'),
//            $payload->all(),
//        );
    }
}
