<?php

declare(strict_types=1);

namespace Eddy\PhpPocketLedger\Domain\Expense;

enum ExpenseCategory: string
{
    case Housing = 'housing';
    case Food = 'food';
    case Transport = 'transport';
    case Utilities = 'utilities';
    case Health = 'health';
    case Entertainment = 'entertainment';
    case Shopping = 'shopping';
    case Debt = 'debt';
    case Other = 'other';
}
