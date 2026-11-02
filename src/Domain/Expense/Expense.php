<?php

declare(strict_types=1);

namespace Eddy\PhpPocketLedger\Domain\Expense;

use DateTimeImmutable;
use Eddy\PhpPocketLedger\Domain\Shared\Money;
use Eddy\PhpPocketLedger\Domain\Shared\Uuid;
use Eddy\PhpPocketLedger\Domain\Shared\InvalidArgumentException;

final class Expense
{
    private function __construct(
        private readonly Uuid $id,
        private readonly Money $amount,
        private string $description,
        private ExpenseCategory $category,
        private readonly DateTimeImmutable $occurredAt,
    ) {
        $this->description = trim($description);

        if ($this->description === '') {
            throw new InvalidArgumentException('Expense description cannot be empty.');
        }
    }

    public static function record(
        Money $amount,
        string $description,
        ExpenseCategory $category,
        ?DateTimeImmutable $occurredAt = null,
    ): self {
        return new self(
            id: Uuid::generate(),
            amount: $amount,
            description: $description,
            category: $category,
            occurredAt: $occurredAt ?? new DateTimeImmutable(),
        );
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function amount(): Money
    {
        return $this->amount;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function category(): ExpenseCategory
    {
        return $this->category;
    }

    public function occurredAt(): DateTimeImmutable
    {
        return $this->occurredAt;
    }

    public function rename(string $description): void
    {
        $description = trim($description);

        if ($description === '') {
            throw new InvalidArgumentException('Expense description cannot be empty.');
        }

        $this->description = $description;
    }

    public function recategorize(ExpenseCategory $category): void
    {
        $this->category = $category;
    }
}
