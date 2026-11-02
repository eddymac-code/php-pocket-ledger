<?php

declare(strict_types=1);

namespace Eddy\PhpPocketLedger\Domain\Income;

use DateTimeImmutable;
use Eddy\PhpPocketLedger\Domain\Shared\Money;
use Eddy\PhpPocketLedger\Domain\Shared\Uuid;
use Eddy\PhpPocketLedger\Domain\Shared\InvalidArgumentException;

final class Income
{
    private function __construct(
        private readonly Uuid $id,
        private readonly Money $amount,
        private string $source,
        private readonly DateTimeImmutable $receivedAt,
    ) {
        $this->source = trim($source);

        if ($this->source === '') {
            throw new InvalidArgumentException('Income source cannot be empty.');
        }
    }

    public static function receive(
        Money $amount,
        string $source,
        ?DateTimeImmutable $receivedAt = null,
    ): self {
        return new self(
            id: Uuid::generate(),
            amount: $amount,
            source: $source,
            receivedAt: $receivedAt ?? new DateTimeImmutable(),
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

    public function source(): string
    {
        return $this->source;
    }

    public function receivedAt(): DateTimeImmutable
    {
        return $this->receivedAt;
    }
}
