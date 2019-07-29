<?php declare(strict_types=1);

namespace Aeviiq\ValueObject;

use Symfony\Component\Validator\Constraint;

interface ValidatableInterface
{
    /**
     * @return Constraint[]
     */
    public static function getConstraints(): array;

    /**
     * @return mixed The validated object value.
     */
    public function get();

    /**
     * @return string The validated object value, converted to string.
     */
    public function __toString(): string;
}
