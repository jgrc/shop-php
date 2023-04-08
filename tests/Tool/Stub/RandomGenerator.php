<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Stub;

use Faker\Factory;
use Faker\Generator;

class RandomGenerator
{
    private static ?RandomGenerator $instance = null;

    private Generator $faker;
    private int $seed;

    public function __construct()
    {
        $this->faker = Factory::create();
        $this->randomSeed();
    }

    public function changeSeed(int $seed): void
    {
        $this->seed = $seed;
        $this->faker->seed($this->seed);
    }

    public function randomSeed(): void
    {
        $this->changeSeed((int) (microtime(true) * 1000000));
    }

    public function seed(): int
    {
        return $this->seed;
    }

    public function faker(): Generator
    {
        return $this->faker;
    }

    public static function instance(): RandomGenerator
    {
        if (self::$instance === null) {
            self::$instance = new RandomGenerator();
        }
        return self::$instance;
    }
}
