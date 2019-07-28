<?php declare(strict_types=1);

namespace Aeviiq\ValueObject\Value\PostalCode;

use Aeviiq\ValueObject\AbstractString;
use Aeviiq\ValueObject\Enum\Iso\Iso3166_1Alpha2\CountryCode;
use Aeviiq\ValueObject\Normalizer;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints;

abstract class AbstractPostalCode extends AbstractString
{
    /**
     * @var CountryCode
     */
    private $countryCode;

    protected function __construct(string $value, CountryCode $countryCode)
    {
        $this->countryCode = $countryCode;
        parent::__construct($value);
    }

    /**
     * {@inheritDoc}
     */
    public static function getConstraints(): array
    {
        return array_merge(static::getAdditionalConstraints(), [
            new Constraints\NotBlank(),
        ]);
    }

    /**
     * @return Constraint[]
     */
    abstract protected static function getAdditionalConstraints(): array;

    public function getCountryCode(): CountryCode
    {
        return $this->countryCode;
    }

    /**
     * {@inheritDoc}
     */
    protected function normalize($value): string
    {
        $value = Normalizer::removeWhitespace($value);

        return \strtoupper($value);
    }
}
