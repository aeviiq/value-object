<?php

declare(strict_types=1);

namespace Aeviiq\ValueObject\Tests;

use Aeviiq\ValueObject\AbstractFloat;
use PHPUnit\Framework\TestCase;

final class FloatTest extends TestCase
{
    public function testIsEqualTo(): void
    {
        $value1 = $this->createValue(13.37);
        $value2 = $this->createValue(13.38);
        $value3 = $this->createValue(13.37);

        self::assertTrue($value1->isEqualTo($value3));
        self::assertTrue($value1->isEqualTo(13.37));
        self::assertTrue($value1->isEqualTo($value1));
        self::assertFalse($value1->isEqualTo(1.23));
        self::assertFalse($value1->isEqualTo($value2));
    }

    public function testGet(): void
    {
        $value1 = $this->createValue(13.37);
        self::assertEquals(13.37, $value1->get());
        self::assertNotEquals(1.23, $value1->get());
    }

    private function createValue(float $value): AbstractFloat
    {
        return new class($value) extends AbstractFloat {
            public static function getConstraints(): array
            {
                return [];
            }
        };
    }
}
