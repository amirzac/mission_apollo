<?php

declare(strict_types=1);

namespace App\Model\ParticipantJourney\Entity\OrmType;

use App\Model\ParticipantJourney\Entity\ExpectedPrice;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class ExpectedPriceType extends StringType
{
    public const NAME = 'journey_price';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof ExpectedPrice ? $value->getName() : $value;
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