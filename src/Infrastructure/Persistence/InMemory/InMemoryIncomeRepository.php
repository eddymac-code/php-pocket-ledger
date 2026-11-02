<?php

declare(strict_types=1);

namespace Eddy\PhpPocketLedger\Infrastructure\Persistence\InMemory;

use Eddy\PhpPocketLedger\Application\Income\IncomeRepository;
use Eddy\PhpPocketLedger\Domain\Income\Income;
use Eddy\PhpPocketLedger\Domain\Shared\Uuid;

final class InMemoryIncomeRepository implements IncomeRepository
{
    /** @var array<string, Income> */
    private array $incomes = [];

    public function save(Income $income): void
    {
        $this->incomes[(string) $income->id()] = $income;
    }

    public function find(Uuid $id): ?Income
    {
        return $this->incomes[(string) $id] ?? null;
    }

    public function all(): array
    {
        return array_values($this->incomes);
    }
}
