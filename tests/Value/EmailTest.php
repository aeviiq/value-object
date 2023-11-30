<?php

declare(strict_types=1);

namespace Aeviiq\ValueObject\Tests\Value;

use Aeviiq\ValueObject\Value\Email;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints;

final class EmailTest extends TestCase
{
    public function testGetConstraints(): void
    {
        self::assertEquals([new Constraints\Email()], Email::getConstraints());
    }
}
