<?php declare(strict_types=1);

namespace Aeviiq\ValueObject\Value\PostalCode;

use Aeviiq\ValueObject\Enum\Iso\Iso3166_1Alpha2\CountryCode;
use Symfony\Component\Validator\Constraints;

final class DutchPostalCode extends AbstractPostalCode
{
    public function __construct(string $value)
    {
        parent::__construct($value, new CountryCode(CountryCode::NL));
    }

    /**
     * {@inheritDoc}
     */
    protected static function getAdditionalConstraints(): array
    {
        return [
            new Constraints\Regex([
                'pattern' => '/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i',
                'message' => 'This is not a valid Postal Code.',
            ]),
        ];
    }
}
