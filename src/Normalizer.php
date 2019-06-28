<?php declare(strict_types = 1);

namespace Aeviiq\ValueObject;

final class Normalizer
{
    public static function removeWhitespace(string $value): string
    {
        return \preg_replace('/\s+/', '', $value);
    }
}
