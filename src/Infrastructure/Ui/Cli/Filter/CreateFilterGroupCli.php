<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Ui\Cli\Filter;

use Jgrc\Shop\Application\Filter\CreateFilterGroup;
use Jgrc\Shop\Domain\Common\Bus\CommandBus;
use Jgrc\Shop\Domain\Common\Service\Clock;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateFilterGroupCli extends Command
{
    private CommandBus $commandBus;
    private Clock $clock;

    public function __construct(CommandBus $commandBus, Clock $clock)
    {
        parent::__construct('shop:filter-group:create');
        $this->commandBus = $commandBus;
        $this->clock = $clock;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('id', InputArgument::REQUIRED, 'Filter group id.')
            ->addArgument('name', InputArgument::REQUIRED, 'Filter group name');
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $command = new CreateFilterGroup(
            (string) $input->getArgument('id'),
            (string) $input->getArgument('name'),
            $this->clock->now()
        );
        $this->commandBus->dispatch($command);

        return Command::SUCCESS;
    }
}
