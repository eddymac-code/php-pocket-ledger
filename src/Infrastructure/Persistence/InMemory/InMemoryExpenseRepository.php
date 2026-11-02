<?php

declare(strict_types=1);

namespace Eddy\PhpPocketLedger\Infrastructure\Persistence\InMemory;

use Eddy\PhpPocketLedger\Application\Expense\ExpenseRepository;
use Eddy\PhpPocketLedger\Domain\Expense\Expense;
use Eddy\PhpPocketLedger\Domain\Shared\Uuid;

final class InMemoryExpenseRepository implements ExpenseRepository
{
    /** @var array<string, Expense> */
    private array $expenses = [];

    public function save(Expense $expense): void
    {
        $this->expenses[(string) $expense->id()] = $expense;
    }

    public function find(Uuid $id): ?Expense
    {
        return $this->expenses[(string) $id] ?? null;
    }

    public function all(): array
    {
        return array_values($this->expenses);
    }
}
