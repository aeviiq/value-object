<?php declare(strict_types = 1);

namespace Aeviiq\ValueObject;

interface Equatable
{
    /**
     * @param mixed $value
     */
    public function isEqualTo($value): bool;
}
