<?php declare(strict_types=1);

namespace Aeviiq\ValueObject\Constraint;

use Symfony\Component\Validator\Constraint;

final class Ip extends Constraint
{
    public $message = 'This is not a valid IP Address.';
}
