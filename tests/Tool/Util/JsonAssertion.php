<?php

declare(strict_types=1);

namespace Jgrc\Shop\Tool\Util;

use Assert\Assertion;
use JsonException;
use SebastianBergmann\Diff\Differ;
use SebastianBergmann\Diff\Output\DiffOnlyOutputBuilder;

class JsonAssertion
{
    public static function eq(string $expected, string $response): void
    {
        $encodedExpected = self::encode($expected, 'expected');
        $encodedResponse = self::encode($response, 'response');
        $differ = new Differ(new DiffOnlyOutputBuilder(''));
        $diff = $differ->diff($encodedExpected, $encodedResponse);
        Assertion::true(empty($diff), $diff);
    }

    /** @return string[] */
    private static function encode(string $json, string $parameter): array
    {
        try {
            /** @var mixed[] */
            $decodedJson = json_decode(
                json: $json,
                associative: true,
                flags: JSON_THROW_ON_ERROR
            );
            /** @var string */
            $encodedJson = json_encode(
                $decodedJson,
                JSON_PRETTY_PRINT
            );
            return array_map(fn(string $line): string => trim($line), explode(PHP_EOL, $encodedJson));
        } catch (JsonException $exception) {
            throw new JsonException(
                sprintf('The %s value does not contain a valid json syntax', $parameter),
                0,
                $exception
            );
        }
    }
}
