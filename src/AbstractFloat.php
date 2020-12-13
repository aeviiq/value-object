<?php declare(strict_types=1);

namespace Aeviiq\ValueObject;

/**
 * @extends AbstractValue<float>
 */
abstract class AbstractFloat extends AbstractValue
{
    public function __construct(float $value)
    {
        parent::__construct($value);
    }
}
