<?php

declare(strict_types=1);

namespace Aeviiq\ValueObject\Tests;

use Aeviiq\ValueObject\AbstractValue;
use PHPUnit\Framework\TestCase;

final class ValueTest extends TestCase
{
    public function testIsEqualTo(): void
    {
        $value1 = $this->createValue(1337);
        $value2 = $this->createValue('1338');
        $value3 = $this->createValue(1337);

        self::assertTrue($value1->isEqualTo($value3));
        self::assertTrue($value1->isEqualTo(1337));
        self::assertTrue($value1->isEqualTo($value1));
        self::assertFalse($value1->isEqualTo(123));
        self::assertFalse($value1->isEqualTo('321'));
        self::assertFalse($value1->isEqualTo($value2));
    }

    public function testGet(): void
    {
        $value1 = $this->createValue(1337);
        self::assertEquals(1337, $value1->get());
        self::assertNotEquals(123, $value1->get());
    }

    /**
     * @return AbstractValue<mixed>
     */
    private function createValue(mixed $value): AbstractValue
    {
        return new class($value) extends AbstractValue {
            public static function getConstraints(): array
            {
                return [];
            }
        };
    }
}
