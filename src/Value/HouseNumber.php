<?php declare(strict_types = 1);

namespace Aeviiq\ValueObject\Value;

use Aeviiq\ValueObject\AbstractString;
use Symfony\Component\Validator\Constraints;

final class HouseNumber extends AbstractString
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
