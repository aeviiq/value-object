<?php declare(strict_types = 1);

namespace Aeviiq\ValueObject\Value;

use Aeviiq\ValueObject\_String;
use Symfony\Component\Validator\Constraints;

final class HouseNumber extends _String
{
    /**
     * @inheritdoc
     */
    protected function getConstraints(): array
    {
        return [
            new Constraints\NotBlank(),
            new Constraints\Length([
                'max' => 10,
            ]),
        ];
    }
}
