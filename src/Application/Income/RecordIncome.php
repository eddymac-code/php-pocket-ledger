<?php

declare(strict_types=1);

namespace Eddy\PhpPocketLedger\Application\Income;

use DateTimeImmutable;
use Eddy\PhpPocketLedger\Domain\Income\Income;
use Eddy\PhpPocketLedger\Domain\Shared\Money;

final readonly class RecordIncome
{
    public function __construct(private IncomeRepository $incomes)
    {
    }

    public function execute(
        Money $amount,
        string $source,
        ?DateTimeImmutable $receivedAt = null,
    ): Income {
        $income = Income::receive(
            amount: $amount,
            source: $source,
            receivedAt: $receivedAt,
        );

        $this->incomes->save($income);

        return $income;
    }
}
