<?php

declare(strict_types=1);

namespace Jgrc\Shop\Acceptance\Context\Infrastructure;

use Assert\Assertion;
use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

final class SymfonyHttpContext implements Context
{
    private KernelInterface $kernel;
    private ?Response $response;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        $this->response = null;
    }

    /** @When the :method request is sent to :path */
    public function requestSent(string $method, string $path): void
    {
        $this->response = $this->kernel->handle(Request::create($path, $method));
    }

    /** @Then the response status is :status */
    public function responseStatusIs(int $status): void
    {
        Assertion::notNull($this->response, 'No response');
        Assertion::eq($status, $this->response->getStatusCode());
    }
}
