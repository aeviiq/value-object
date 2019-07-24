<?php declare(strict_types = 1);

namespace Aeviiq\ValueObject;

use Symfony\Component\Validator\Constraint;

abstract class AbstractValue implements EquatableInterface
{
    /**
     * @var mixed
     */
    protected $value;

    public function __construct($value)
    {
        $value = $this->normalize($value);
        Validator::validate($value, $this->getConstraints());
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    final public function get()
    {
        return $this->value;
    }

    /**
     * @inheritdoc
     */
    final public function isEqualTo($value): bool
    {
        if ($value instanceof self) {
            return $value === $value->get();
        }

        return $value === $this->value;
    }

    /**
     * @return Constraint[]
     */
    abstract protected function getConstraints(): array;

    /**
     * @return mixed
     */
    protected function normalize($value)
    {
        return $value;
    }
}
