<?php

declare(strict_types=1);

namespace Jgrc\Shop\Acceptance\Context\Infrastructure;

use Assert\Assertion;
use Behat\Behat\Context\Context;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpKernel\KernelInterface;

final class SymfonyCliContext implements Context
{
    private Application $application;
    private ?string $output;
    private ?int $exitCode;

    public function __construct(KernelInterface $kernel)
    {
        $this->application = new Application($kernel);
        $this->application->setCatchExceptions(false);
        $this->application->setAutoExit(false);
        $this->output = null;
        $this->exitCode = null;
    }

    /** @When the command :command is executed */
    public function commandIsExecuted(string $command): void
    {
        $input = new StringInput($command);
        $output = new BufferedOutput();
        $this->exitCode = $this->application->run($input, $output);
        $this->output = $output->fetch();
    }

    /** @Then the command exit code is :exitCode */
    public function commandExitCodeIs(int $exitCode): void
    {
        Assertion::eq($exitCode, $this->exitCode);
    }

    /** @Then the command output is :output */
    public function commandOutputIs(string $output): void
    {
        $output = str_replace("\\n", PHP_EOL, $output);
        Assertion::eq($this->output, $output);
    }
}
