<?php

declare(strict_types=1);

namespace Aeviiq\ValueObject\Tests;

use Aeviiq\ValueObject\Normalizer;
use PHPUnit\Framework\TestCase;

final class NormalizerTest extends TestCase
{
    public function testRemoveWhitespaceTest(): void
    {
        $normalizer = new Normalizer();
        self::assertEquals('test123', $normalizer::removeWhitespace('test 123'));
        self::assertEquals('test123', $normalizer::removeWhitespace('tes   t 1 2 3'));
    }
}
