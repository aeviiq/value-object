<?php

declare(strict_types=1);

namespace Aeviiq\ValueObject\Tests\Constraint;

use Aeviiq\ValueObject\Constraint;
use PHPUnit\Framework\TestCase;
use Aeviiq\ValueObject\Constraint\BsnValidator;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

final class BsnValidatorTest extends TestCase
{
    /**
     * @dataProvider bsnValidateDataProvider
     */
    public function testValidate(string $bsn, bool $expected): void
    {
        $context = $this->createMock(ExecutionContextInterface::class);
        $bsnValidator = new BsnValidator();
        $bsnValidator->initialize($context);
        if ($expected) {
            $context->expects(self::never())->method('buildViolation');
        } else {
            $context->expects(self::once())->method('buildViolation');
        }
        $bsnValidator->validate($bsn, new Constraint\Bsn());
    }

    /**
     * @return array<int, array<int, string|bool>>
     */
    public static function bsnValidateDataProvider(): array
    {
        return [
            ['996719131', true],
            ['258681767', true],
            ['641755193', true],
            ['973848194', true],
            ['757150470', true],
            ['679731684', true],
            ['654642643', true],
            ['441687593', true],
            ['722178803', true],
            ['905231879', true],
            ['123145678', false],
            ['23434343', false],
            ['223334567', false],
            ['2342343434', false],
            ['123145678', false],
            ['178954564', false],
            ['4565653636', false],
            ['3', false],
            ['1', false],
        ];
    }

}
