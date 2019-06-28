<?php declare(strict_types = 1);

namespace Aeviiq\ValueObject;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints;

abstract class Value
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var bool
     */
    protected $allowEmpty = false;

    public function __construct($value)
    {
        $constraints = static::getConstraints();
        if (!$this->allowEmpty) {
            $constraints[] = new Constraints\NotBlank();
        }

        Validator::validate($value, $constraints);
        $this->value = $this->normalize($value);
    }

    /**
     * @return Constraint[]
     */
    abstract protected static function getConstraints(): array;

    /**
     * @return mixed
     */
    final public function get()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    protected function normalize($value)
    {
        return $value;
    }
}
