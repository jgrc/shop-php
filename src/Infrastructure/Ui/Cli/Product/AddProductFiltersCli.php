<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Ui\Cli\Product;

use Jgrc\Shop\Application\Product\AddProductFilters;
use Jgrc\Shop\Domain\Common\Bus\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddProductFiltersCli extends Command
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        parent::__construct('shop:product:add-filters');
        $this->commandBus = $commandBus;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('productId', InputArgument::REQUIRED, 'Product id.')
            ->addArgument(
                'filterIds',
                InputArgument::REQUIRED | InputArgument::IS_ARRAY,
                'Filter ids'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $productId = (string) $input->getArgument('productId');
        /** @var string[] $filterIds */
        $filterIds = $input->getArgument('filterIds');
        $command = new AddProductFilters($productId, ...$filterIds);
        $this->commandBus->dispatch($command);

        return Command::SUCCESS;
    }
}
