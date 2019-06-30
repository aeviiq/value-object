<?php declare(strict_types = 1);

namespace Aeviiq\ValueObject\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

final class IpAddressValidator extends ConstraintValidator
{
    /**
     * @inheritdoc
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof IpAddress) {
            throw new UnexpectedTypeException($constraint, IpAddress::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!\is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        try {
            $inAddr = \inet_pton($value);
        } catch (\ErrorException $e) {
            $inAddr = false;
        }

        if (false === $inAddr) {
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
