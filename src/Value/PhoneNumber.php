<?php declare(strict_types=1);

namespace Aeviiq\ValueObject\Value;

use Aeviiq\ValueObject\AbstractString;
use Aeviiq\ValueObject\Normalizer;
use Symfony\Component\Validator\Constraints;

final class PhoneNumber extends AbstractString
{
    /**
     * {@inheritDoc}
     */
    public static function getConstraints(): array
    {
        return [
            new Constraints\NotBlank(),
            new Constraints\Length([
                'max' => 15, // According to E.164 of ITU-T
                'min' => 7,
            ]),
            new Constraints\Regex([
                'pattern' => '/^[\d ()+-]+$/',
                'message' => 'This is not a valid phone number.',
            ]),
            // TODO find a better way to validate this or maybe implement country specific value objects, as is done with postal code?
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function normalize($value): string
    {
        return Normalizer::removeWhitespace($value);
    }
}
