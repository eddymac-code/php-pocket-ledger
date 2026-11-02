<?php

declare(strict_types=1);

namespace Eddy\PhpPocketLedger\Application\Expense;

use DateTimeImmutable;
use Eddy\PhpPocketLedger\Domain\Expense\Expense;
use Eddy\PhpPocketLedger\Domain\Expense\ExpenseCategory;
use Eddy\PhpPocketLedger\Domain\Shared\Money;

final readonly class RecordExpense
{
    public function __construct(private ExpenseRepository $expenses)
    {
    }

    public function execute(
        Money $amount,
        string $description,
        ExpenseCategory $category,
        ?DateTimeImmutable $occurredAt = null,
    ): Expense {
        $expense = Expense::record(
            amount: $amount,
            description: $description,
            category: $category,
            occurredAt: $occurredAt,
        );

        $this->expenses->save($expense);

        return $expense;
    }
}
