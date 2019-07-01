<?php declare(strict_types = 1);

namespace Aeviiq\ValueObject\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

final class BsnValidator extends ConstraintValidator
{
    /**
     * @inheritdoc
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof Bsn) {
            throw new UnexpectedTypeException($constraint, Bsn::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!\is_numeric($value)) {
            throw new UnexpectedValueException($value, 'numeric');
        }

        $sum = 0;
        $stringLength = \strlen($value);
        $multiplier = $stringLength;
        for ($counter = 0; $counter < $stringLength; $counter++, $multiplier--) {
            if ($multiplier === 1) {
                $multiplier = -1;
            }

            $sum += $value[$counter] * $multiplier;
        }
        if (false === ($sum % 11 === 0)) {
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
