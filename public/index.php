<?php

declare(strict_types=1);

use Eddy\PhpPocketLedger\Application\Expense\RecordExpense;
use Eddy\PhpPocketLedger\Domain\Expense\ExpenseCategory;
use Eddy\PhpPocketLedger\Domain\Shared\Money;
use Eddy\PhpPocketLedger\Infrastructure\Persistence\InMemory\InMemoryExpenseRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$repository = new InMemoryExpenseRepository();
$recordExpense = new RecordExpense($repository);

$expense = $recordExpense->execute(
    amount: new Money(2500_00, 'KES'),
    description: 'Groceries',
    category: ExpenseCategory::Food,
);

echo $expense->description() . PHP_EOL;
echo $expense->category()->value . PHP_EOL;
echo $expense->amount()->minorUnits() . ' ' . $expense->amount()->currency() . PHP_EOL;
