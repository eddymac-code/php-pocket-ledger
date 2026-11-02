<?php

declare(strict_types=1);

namespace Eddy\PhpPocketLedger\Tests\Unit\Domain\Expense;

use Eddy\PhpPocketLedger\Domain\Expense\Expense;
use Eddy\PhpPocketLedger\Domain\Expense\ExpenseCategory;
use Eddy\PhpPocketLedger\Domain\Shared\InvalidArgumentException;
use Eddy\PhpPocketLedger\Domain\Shared\Money;
use PHPUnit\Framework\TestCase;

final class ExpenseTest extends TestCase
{
    public function test_it_can_record_an_expense(): void
    {
        $expense = Expense::record(
            new Money(5000, 'KES'),
            'Lunch',
            ExpenseCategory::Food,
        );

        self::assertSame('Lunch', $expense->description());
        self::assertSame(5000, $expense->amount()->minorUnits());
        self::assertSame(ExpenseCategory::Food, $expense->category());
    }

    public function test_it_rejects_an_empty_description(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Expense::record(
            new Money(5000, 'KES'),
            '   ',
            ExpenseCategory::Food,
        );
    }
}
