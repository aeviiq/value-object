<?php declare(strict_types=1);

namespace Aeviiq\ValueObject;

use UnexpectedValueException;

final class Normalizer
{
    public static function removeWhitespace(string $value): string
    {
        $replaced = preg_replace('/\s+/', '', $value);

        if(!is_string($replaced)) {
            throw new UnexpectedValueException(sprintf('Could not remove whitespaces from string "%s".', $value));
        }

        return $replaced;
    }
}
