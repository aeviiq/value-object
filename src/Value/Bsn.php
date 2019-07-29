<?php declare(strict_types=1);

namespace Aeviiq\ValueObject\Value;

use Aeviiq\ValueObject\AbstractString;
use Aeviiq\ValueObject\Constraint;
use Aeviiq\ValueObject\Normalizer;

final class Bsn extends AbstractString
{
    /**
     * {@inheritDoc}
     */
    public static function getConstraints(): array
    {
        return [
            new Constraint\Bsn(),
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function normalize($value): string
    {
        return Normalizer::removeWhitespace($value);
    }
}
