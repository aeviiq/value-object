<?php declare(strict_types=1);

namespace Aeviiq\ValueObject;

/**
 * @extends AbstractValue<int>
 */
abstract class AbstractInt extends AbstractValue
{
    public function __construct(int $value)
    {
        parent::__construct($value);
    }
}
