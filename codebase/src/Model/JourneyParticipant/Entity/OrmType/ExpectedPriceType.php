<?php

declare(strict_types=1);

namespace App\Model\JourneyParticipant\Entity\OrmType;

use App\Model\JourneyParticipant\Entity\ExpectedPrice;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class ExpectedPriceType extends StringType
{
    public const NAME = 'journey_price';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof ExpectedPrice ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new ExpectedPrice($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}