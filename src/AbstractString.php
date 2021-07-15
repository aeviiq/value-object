<?php declare(strict_types=1);

namespace Aeviiq\ValueObject;

/**
 * @extends AbstractValue<string>
 */
abstract class AbstractString extends AbstractValue
{
    public function __construct(string $value)
    {
        parent::__construct($value);
    }
}
