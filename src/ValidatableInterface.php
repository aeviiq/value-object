<?php

declare(strict_types=1);

namespace Aeviiq\ValueObject;

use Symfony\Component\Validator\Constraint;

/**
 * @template T
 */
interface ValidatableInterface
{
    /**
     * @return array<array-key, Constraint>
     */
    public static function getConstraints(): array;

    /**
     * @psalm-return T
     *
     * @return mixed The validated object value.
     */
    public function get();
}
