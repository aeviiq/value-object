<?php declare(strict_types=1);

namespace Aeviiq\ValueObject\Value\PostalCode;

use Aeviiq\ValueObject\AbstractString;
use Aeviiq\ValueObject\Enum\Iso\Iso3166_1Alpha2\CountryCode;
use Aeviiq\ValueObject\Normalizer;

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
