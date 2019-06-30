<?php declare(strict_types = 1);

namespace Aeviiq\ValueObject\Value;

use Aeviiq\ValueObject\_String;
use Aeviiq\ValueObject\Constraint;
use Symfony\Component\Validator\Constraints;

final class Bsn extends _String
{
    /**
     * @inheritdoc
     */
    protected function getConstraints(): array
    {
        return [
            new Constraints\NotBlank(),
            new Constraint\Bsn(),
        ];
    }
}
