<?php

declare(strict_types=1);

namespace Aeviiq\ValueObject\Tests\Value;

use Aeviiq\ValueObject\Value\Iban;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints;

final class IbanTest extends TestCase
{
    public function testGetConstraints(): void
    {
        self::assertEquals([new Constraints\Iban()], Iban::getConstraints());
    }
}
