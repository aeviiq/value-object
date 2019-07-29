<?php declare(strict_types=1);

namespace Aeviiq\ValueObject;

abstract class AbstractValue implements EquatableInterface, ValidatableInterface
{
    /**
     * @var mixed
     */
    protected $value;

    public function __construct($value)
    {
        $value = $this->normalize($value);
        $this->value = $value;
        Validator::validateBy($this);
    }

    /**
     * {@inheritDoc}
     */
    final public function get()
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     */
    final public function isEqualTo($value): bool
    {
        if ($value instanceof self) {
            return $value === $value->get();
        }

        return $value === $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    /**
     * @return mixed
     */
    protected function normalize($value)
    {
        return $value;
    }
}
