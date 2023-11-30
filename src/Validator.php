<?php

declare(strict_types=1);

namespace Aeviiq\ValueObject;

use Aeviiq\ValueObject\Exception\InvalidArgumentException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Callback;
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
     * @psalm-param ValidatableInterface<mixed> $validatable
     *
     * @throws InvalidArgumentException When the value violates any of the present constraints.
     */
    public static function validateBy(ValidatableInterface $validatable): void
    {
        $constraints = $validatable::getConstraints();

        $callbackConstraints = [];
        foreach ($constraints as $key => $constraint) {
            if ($constraint instanceof Callback) {
                unset($constraints[$key]);
                $callbackConstraints[$key] = $constraint;
            }
        }

        static::validate($validatable->get(), $constraints);

        if (count($callbackConstraints) > 0) {
            static::validate($validatable, $callbackConstraints);
        }
    }

    /**
     * @param mixed                        $value
     * @param array<array-key, Constraint> $constraints
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

        throw new InvalidArgumentException(sprintf('Invalid value: "%s"', implode('", "', $violationMessages)));
    }

    private static function getValidator(): ValidatorInterface
    {
        if (null === static::$validator) {
            static::$validator = Validation::createValidator();
        }

        return static::$validator;
    }
}
