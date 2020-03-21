<?php

declare(strict_types=1);

namespace App\Model\ParticipantJourney\Entity;

use Webmozart\Assert\Assert;

class JourneyType
{
    public const ONE_DIRECTION = 0;

    public const TWO_DIRECTIONS = 1;

    private int $value;

    public function __construct(int $value)
    {
        Assert::boolean($value);

        $this->value = $value;
    }

    public static function oneDirection(): self
    {
        return new self(self::ONE_DIRECTION);
    }

    public static function twoDirections(): self
    {
        return new self(self::TWO_DIRECTIONS);
    }

    public function isOneDirection(): bool
    {
        return $this->value === self::ONE_DIRECTION;
    }

    public function isTwoDirections(): bool
    {
        return $this->value === self::TWO_DIRECTIONS;
    }
}