<?php declare(strict_types=1);

namespace Aeviiq\ValueObject\Value;

use Aeviiq\ValueObject\AbstractString;
use Aeviiq\ValueObject\Constraint;
use Symfony\Component\Validator\Constraints;

final class Ip extends AbstractString
{
    /**
     * @inheritdoc
     */
    protected function getConstraints(): array
    {
        return [
            new Constraints\NotBlank(),
            new Constraint\Ip(),
        ];
    }
}
