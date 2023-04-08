<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\PhpUnit;

use Jgrc\Shop\Tool\PhpUnit\Memo\Memo;
use Jgrc\Shop\Tool\PhpUnit\Subscriber\ChangeSeed;
use Jgrc\Shop\Tool\PhpUnit\Subscriber\RegisterSeedOnError;
use Jgrc\Shop\Tool\PhpUnit\Subscriber\RegisterSeedOnFail;
use Jgrc\Shop\Tool\PhpUnit\Subscriber\ShowSeeds;
use PHPUnit\Runner\Extension\Extension;
use PHPUnit\Runner\Extension\Facade;
use PHPUnit\Runner\Extension\ParameterCollection;
use PHPUnit\TextUI\Configuration\Configuration;

class RandomExtension implements Extension
{
    public function bootstrap(Configuration $configuration, Facade $facade, ParameterCollection $parameters): void
    {
        $memo = new Memo();
        $facade->registerSubscribers(
            new ChangeSeed(),
            new RegisterSeedOnError($memo),
            new RegisterSeedOnFail($memo),
            new ShowSeeds($memo)
        );
    }
}
