<?php declare(strict_types=1);

namespace Aeviiq\ValueObject;

use Aeviiq\ValueObject\Exception\InvalidArgumentException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class Validator
{
    /**
     * @var ValidatorInterface|null
     */
    private static $validator;

    /**
     * @throws InvalidArgumentException When the value violates any of the present constraints.
     */
    public static function validateBy(ValidatableInterface $validatable): void
    {
        static::validate($validatable, $validatable::getConstraints());
    }

    /**
     * @param mixed                   $value
     * @param Constraint|Constraint[] $rules
     *
     * @throws InvalidArgumentException When the value violates any of the given constraints.
     */
    public static function validate($value, $constraints): void
    {
        $violations = static::getValidator()->validate($value, $constraints);
        if (0 === $violations->count()) {
            return;
        }

        $violationMessages = [];
        /** @var ConstraintViolation $violation */
        foreach ($violations as $violation) {
            $violationMessages[] = $violation->getMessage();
        }

        throw new InvalidArgumentException(\sprintf('Invalid value: "%s". "%s"', $value, implode('", "', $violationMessages)));
    }

    private static function getValidator(): ValidatorInterface
    {
        if (null === static::$validator) {
            static::$validator = Validation::createValidator();
        }

        return static::$validator;
    }
}
