<?php declare(strict_types = 1);

namespace Aeviiq\ValueObject;

use Symfony\Component\Validator\Constraint;

abstract class Value
{
    /**
     * @var mixed
     */
    protected $value;

    public function __construct($value)
    {
        Validator::validate($value, $this->getConstraints());
        $this->value = $this->normalize($value);
    }

    /**
     * @return mixed
     */
    final public function get()
    {
        return $this->value;
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
