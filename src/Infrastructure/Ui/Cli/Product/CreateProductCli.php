<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Ui\Cli\Product;

use Assert\Assertion;
use Jgrc\Shop\Application\Product\CreateProduct;
use Jgrc\Shop\Domain\Common\Bus\CommandBus;
use Jgrc\Shop\Domain\Common\Service\Clock;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateProductCli extends Command
{
    private CommandBus $commandBus;
    private Clock $clock;

    public function __construct(CommandBus $commandBus, Clock $clock)
    {
        parent::__construct('shop:product:create');
        $this->commandBus = $commandBus;
        $this->clock = $clock;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('id', InputArgument::REQUIRED, 'Product id.')
            ->addArgument('name', InputArgument::REQUIRED, 'Product name')
            ->addArgument('price', InputArgument::REQUIRED, 'Product price.')
            ->addArgument('image', InputArgument::REQUIRED, 'Product image.')
            ->addArgument('categoryId', InputArgument::REQUIRED, 'Category id.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $price = $input->getArgument('price');
        Assertion::integerish($price, 'The price should be a integer');

        $command = new CreateProduct(
            (string) $input->getArgument('id'),
            (string) $input->getArgument('name'),
            (int) $price,
            (string) $input->getArgument('image'),
            (string) $input->getArgument('categoryId'),
            $this->clock->now()
        );
        $this->commandBus->dispatch($command);

        return Command::SUCCESS;
    }
}
