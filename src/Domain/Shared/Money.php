<?php

declare(strict_types=1);

namespace Eddy\PhpPocketLedger\Domain\Shared;

final readonly class Money
{
    private string $currency;

    public function __construct(
        private int $minorUnits,
        string $currency,
    ) {
        $currency = strtoupper(trim($currency));

        if (!preg_match('/^[A-Z]{3}$/', $currency)) {
            throw new InvalidArgumentException('Currency must be a 3-letter ISO-style code.');
        }

        if ($minorUnits < 0) {
            throw new InvalidArgumentException('Money amount cannot be negative.');
        }

        $this->currency = $currency;
    }

    public function minorUnits(): int
    {
        return $this->minorUnits;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function isZero(): bool
    {
        return $this->minorUnits === 0;
    }

    public function add(self $other): self
    {
        $this->assertSameCurrency($other);

        return new self($this->minorUnits + $other->minorUnits, $this->currency);
    }

    public function subtract(self $other): self
    {
        $this->assertSameCurrency($other);

        $result = $this->minorUnits - $other->minorUnits;

        if ($result < 0) {
            throw new InvalidArgumentException('Money subtraction cannot produce a negative amount.');
        }

        return new self($result, $this->currency);
    }

    public function equals(self $other): bool
    {
        return $this->minorUnits === $other->minorUnits
            && $this->currency === $other->currency;
    }

    private function assertSameCurrency(self $other): void
    {
        if ($this->currency !== $other->currency) {
            throw new InvalidArgumentException('Cannot operate on different currencies.');
        }
    }
}
