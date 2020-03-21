<?php

declare(strict_types=1);

namespace App\Model\ParticipantJourney\Entity;

use Webmozart\Assert\Assert;

class ExpectedPrice
{
    public const ZERO_TEN = '0-10';
    public const TEN_FIFTY = '10-50';
    public const FIFTY_ONE_HUNDRED = '50-100';

    private string $value;

    public function __construct(string $value)
    {
        Assert::oneOf($value, self::getValues());

        $this->value = $value;
    }

    public static function zeroTen(): self
    {
        return new self(self::ZERO_TEN);
    }

    public static function TenFifty(): self
    {
        return new self(self::ZERO_TEN);
    }

    public static function FiftyOneHundred(): self
    {
        return new self(self::ZERO_TEN);
    }

    public function isZeroTen(): bool
    {
        return $this->value === self::ZERO_TEN;
    }

    public function isTenFifty(): bool
    {
        return $this->value === self::TEN_FIFTY;
    }

    public function isFiftyOneHundred(): bool
    {
        return $this->value === self::FIFTY_ONE_HUNDRED;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function getValues(): array
    {
        return [
            self::ZERO_TEN,
            self::TEN_FIFTY,
            self::FIFTY_ONE_HUNDRED,
        ];
    }
}