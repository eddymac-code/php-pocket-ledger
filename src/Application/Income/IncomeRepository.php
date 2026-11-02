<?php

declare(strict_types=1);

namespace Eddy\PhpPocketLedger\Application\Income;

use Eddy\PhpPocketLedger\Domain\Income\Income;
use Eddy\PhpPocketLedger\Domain\Shared\Uuid;

interface IncomeRepository
{
    public function save(Income $income): void;

    public function find(Uuid $id): ?Income;

    /** @return list<Income> */
    public function all(): array;
}
