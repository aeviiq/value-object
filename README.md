# Aeviiq PHP Value Object

## Why
To provide an easy way to create value objects in PHP. Validation can be done by using the Symfony Validator component (https://github.com/symfony/validator and its documentation https://symfony.com/doc/current/validation.html#constraints). This also allows for easy integration with the Symfony Form component, as the value object constraints are defined statically.

## Installation
```
composer require aeviiq/value-object
```

## Declaration
```php
<?php declare(strict_types=1);

namespace Aeviiq\ValueObject\Value;

use Aeviiq\ValueObject\AbstractString;
use Aeviiq\ValueObject\Normalizer;
use Symfony\Component\Validator\Constraints;

final class Iban extends AbstractString
{
    /**
     * {@inheritDoc}
     */
    public static function getConstraints(): array
    {
        return [
            new Constraints\Iban(),
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
```

## Usage
```php
$iban = new Iban('Invalid value'); // Results in InvalidArgumentException
$iban = new Iban('NL91 ABNA 0417 1643 00'); // Contains a valid Iban.
```
