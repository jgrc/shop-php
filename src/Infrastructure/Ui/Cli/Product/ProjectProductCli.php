<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Ui\Cli\Product;

use Jgrc\Shop\Application\Product\ProjectProduct;
use Jgrc\Shop\Domain\Common\Bus\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProjectProductCli extends Command
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        parent::__construct('shop:product:project');
        $this->commandBus = $commandBus;
    }

    protected function configure(): void
    {
        $this->addArgument('id', InputArgument::REQUIRED, 'Product id.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $command = new ProjectProduct((string) $input->getArgument('id'));
        $this->commandBus->dispatch($command);

        return Command::SUCCESS;
    }
}
