<?php declare(strict_types=1);

namespace Aeviiq\ValueObject\Enum;

use MyCLabs\Enum\Enum;

final class Gender extends Enum
{
    public const MALE = 'm';
    public const FEMALE = 'f';
}
