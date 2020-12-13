<?php declare(strict_types=1);

namespace Aeviiq\ValueObject;

/**
 * @template T
 *
 * @implements ValidatableInterface<T>
 */
abstract class AbstractValue implements EquatableInterface, ValidatableInterface
{
    /**
     * @psalm-var T
     *
     * @var mixed
     */
    protected $value;

    /**
     * @psalm-param T $value
     */
    public function __construct($value)
    {
        $value = $this->normalize($value);
        $this->value = $value;
        Validator::validateBy($this);
    }

    /**
     * @inheritDoc
     */
    final public function get()
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    final public function isEqualTo($value): bool
    {
        if ($value instanceof self) {
            return $this->value === $value->get();
        }

        return $value === $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    /**
     * @psalm-param T $value
     *
     * @psalm-return T
     *
     * @return mixed
     */
    protected function normalize($value)
    {
        return $value;
    }
}
