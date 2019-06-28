<?php declare(strict_types = 1);

namespace Aeviiq\ValueObject\Value;

use Aeviiq\ValueObject\_String;
use Aeviiq\ValueObject\Exception\InvalidArgumentException;
use Aeviiq\ValueObject\Exception\LogicException;
use Aeviiq\ValueObject\Normalizer;
use Symfony\Component\Validator\Constraints;

/*
 * This class only supports the countries defined as public const.
 */
final class PostalCode extends _String
{
    // The supported country codes in ISO_3166-1_alpha-2 format
    public const COUNTRY_NL = 'NL';

    /**
     * @var string[]
     */
    private static $cache;

    /**
     * @var string[]
     */
    private static $patterns = [
        self::COUNTRY_NL => '/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i',
    ];

    /**
     * @var string
     */
    private $countryCode;

    public function __construct(string $value, string $countryCode = self::COUNTRY_NL)
    {
        $countryCode = \strtoupper($countryCode);
        if (!\in_array($countryCode, $this->getCountryCodes(), true)) {
            throw new InvalidArgumentException(\sprintf('"%s" is an invalid country code.', $countryCode));
        }

        $this->countryCode = $countryCode;

        parent::__construct($value);
    }

    /**
     * @inheritdoc
     */
    protected function getConstraints(): array
    {
        return [
            new Constraints\Regex([
                'pattern' => $this->getRegexPattern(),
                'match' => true,
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
        if (!isset(static::$patterns[$this->countryCode])) {
            throw new LogicException(\sprintf('The regex pattern is not implemented for country code "%s".', $this->countryCode));
        }

        return static::$patterns[$this->countryCode];
    }

    /**
     * @return string[]
     */
    private function getCountryCodes(): array
    {
        if (null === static::$cache) {
            static::$cache = (new \ReflectionClass($this))->getConstants();
        }

        return static::$cache;
    }
}
