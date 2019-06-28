<?php declare(strict_types = 1);

namespace Aeviiq\ValueObject\Value;

use Aeviiq\ValueObject\_String;
use Aeviiq\ValueObject\Normalizer;
use Symfony\Component\Validator\Constraints;

final class Iban extends _String
{
    /**
     * @inheritdoc
     */
    protected static function getConstraints(): array
    {
        return [
            new Constraints\Iban(),
        ];
    }

    /**
     * @inheritdoc
     */
    protected function normalize($value): string
    {
        return Normalizer::removeWhitespace($value);
    }
}
