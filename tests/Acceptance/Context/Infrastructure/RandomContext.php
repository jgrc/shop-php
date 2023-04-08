<?php

declare(strict_types=1);

namespace Jgrc\Shop\Acceptance\Context\Infrastructure;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Jgrc\Shop\Tool\Stub\RandomGenerator;

class RandomContext implements Context
{
    /** @BeforeScenario */
    public function changeSeed(): void
    {
        RandomGenerator::instance()->randomSeed();
    }

    /** @AfterScenario */
    public function showSeedOfFailed(AfterScenarioScope $scope): void
    {
        if (!$scope->getTestResult()->isPassed()) {
            $file = explode('features/', (string) $scope->getFeature()->getFile());
            $test = sprintf('%s: %s', end($file), $scope->getScenario()->getTitle());
            $seed = RandomGenerator::instance()->seed();
            fwrite(STDERR, sprintf('%s%s -> Seed %d%s', PHP_EOL, $test, $seed, PHP_EOL));
        }
    }
}
