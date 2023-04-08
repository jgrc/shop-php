<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Ui\Cli\Category;

use Jgrc\Shop\Application\Category\CreateCategory;
use Jgrc\Shop\Domain\Common\Bus\CommandBus;
use Jgrc\Shop\Domain\Common\Service\Clock;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCategoryCli extends Command
{
    private CommandBus $commandBus;
    private Clock $clock;

    public function __construct(CommandBus $commandBus, Clock $clock)
    {
        parent::__construct('shop:category:create');
        $this->commandBus = $commandBus;
        $this->clock = $clock;
    }

    protected function configure()
    {
        $this
            ->addArgument('id', InputArgument::REQUIRED, 'Category id.')
            ->addArgument('name', InputArgument::REQUIRED, 'Category name');
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $command = new CreateCategory(
            $input->getArgument('id'),
            $input->getArgument('name'),
            $this->clock->now()
        );
        $this->commandBus->dispatch($command);

        return Command::SUCCESS;
    }
}
