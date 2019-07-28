<?php declare(strict_types=1);

namespace Aeviiq\ValueObject\Value;

use Aeviiq\ValueObject\AbstractString;
use Aeviiq\ValueObject\Enum\Iso\Iso3166_1Alpha2\CountryCode;
use Aeviiq\ValueObject\Exception\LogicException;
use Aeviiq\ValueObject\Normalizer;
use Symfony\Component\Validator\Constraints;

final class PostalCode extends AbstractString
{
    /**
     * @var string[]
     */
    private static $patterns = [
        CountryCode::NL => '/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i',
    ];

    /**
     * @var CountryCode
     */
    private $countryCode;

    public function __construct(string $value, CountryCode $countryCode)
    {
        $this->countryCode = $countryCode;
        parent::__construct($value);
    }

    public function getCountryCode(): CountryCode
    {
        return $this->countryCode;
    }

    /**
     * @inheritdoc
     */
    protected function getConstraints(): array
    {
        return [
            new Constraints\NotBlank(),
            new Constraints\Regex([
                'pattern' => $this->getRegexPattern(),
                'message' => 'This is not a valid Postal Code.',
            ]),
        ];
    }

    protected function normalize($value): string
    {
        $value = Normalizer::removeWhitespace($value);

        return \strtoupper($value);
    }

    private function getRegexPattern(): string
    {
        $code = $this->countryCode->getValue();
        if (!isset(static::$patterns[$code])) {
            throw new LogicException(\sprintf('The regex pattern is not implemented for country code "%s".', $code));
        }

        return static::$patterns[$code];
    }
}
