<?php

declare(strict_types=1);

namespace Eddy\PhpPocketLedger\Tests\Unit\Domain\Shared;

use Eddy\PhpPocketLedger\Domain\Shared\InvalidArgumentException;
use Eddy\PhpPocketLedger\Domain\Shared\Money;
use PHPUnit\Framework\TestCase;

final class MoneyTest extends TestCase
{
    public function test_it_stores_minor_units_and_normalizes_currency(): void
    {
        $money = new Money(250000, ' kes ');

        self::assertSame(250000, $money->minorUnits());
        self::assertSame('KES', $money->currency());
    }

    public function test_it_rejects_negative_amounts(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Money(-1, 'KES');
    }

    public function test_it_adds_money_with_the_same_currency(): void
    {
        $left = new Money(1000, 'KES');
        $right = new Money(2500, 'KES');

        self::assertTrue((new Money(3500, 'KES'))->equals($left->add($right)));
    }
}
