<?php

declare(strict_types=1);

namespace Eddy\PhpPocketLedger\Application\Expense;

use Eddy\PhpPocketLedger\Domain\Expense\Expense;
use Eddy\PhpPocketLedger\Domain\Shared\Uuid;

interface ExpenseRepository
{
    public function save(Expense $expense): void;

    public function find(Uuid $id): ?Expense;

    /** @return list<Expense> */
    public function all(): array;
}
