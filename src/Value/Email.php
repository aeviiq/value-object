<?php declare(strict_types=1);

namespace Aeviiq\ValueObject\Value;

use Aeviiq\ValueObject\AbstractString;
use Aeviiq\ValueObject\Normalizer;
use Symfony\Component\Validator\Constraints;

final class Email extends AbstractString
{
    /**
     * {@inheritDoc}
     */
    public static function getConstraints(): array
    {
        return [
            new Constraints\Email(),
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function normalize($value): string
    {
        $value = Normalizer::removeWhitespace($value);

        return \strtolower($value);
    }
}
