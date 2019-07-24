<?php declare(strict_types = 1);

namespace Aeviiq\ValueObject;

abstract class AbstractString extends AbstractValue
{
    public function __construct(string $value)
    {
        parent::__construct($value);
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}
