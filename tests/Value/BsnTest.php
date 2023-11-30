<?php

declare(strict_types=1);

namespace Aeviiq\ValueObject\Tests\Value;

use Aeviiq\ValueObject\Value\Bsn;
use PHPUnit\Framework\TestCase;
use Aeviiq\ValueObject\Constraint;

final class BsnTest extends TestCase
{
    public function testGetConstraints(): void
    {
        self::assertEquals([new Constraint\Bsn()], Bsn::getConstraints());
    }
}
