<?php declare(strict_types=1);

namespace Aeviiq\ValueObject;

use Aeviiq\ValueObject\Exception\InvalidArgumentException;

/**
 * @extends AbstractValue<string>
 */
abstract class AbstractString extends AbstractValue
{
    public function __construct(string $value)
    {
        if ('' === $value) {
            throw new InvalidArgumentException('A string value should not be empty. If the value is optional, make the type nullable.');
        }

        parent::__construct($value);
    }
}
