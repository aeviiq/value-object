<?php declare(strict_types=1);

namespace Aeviiq\ValueObject\Value;

use Aeviiq\ValueObject\AbstractString;
use Aeviiq\ValueObject\Constraint;

final class Ip extends AbstractString
{
    /**
     * {@inheritDoc}
     */
    public static function getConstraints(): array
    {
        return [
            new Constraint\Ip(),
        ];
    }
}
