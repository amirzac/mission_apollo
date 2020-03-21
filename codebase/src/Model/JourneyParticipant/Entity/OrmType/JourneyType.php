<?php

declare(strict_types=1);

namespace App\Model\JourneyParticipant\Entity\OrmType;

use App\Model\JourneyParticipant\Entity\JourneyType as JourneyTypeEntity;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\SmallIntType;

class JourneyType extends SmallIntType
{
    public const NAME = 'journey_type';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof JourneyTypeEntity ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new JourneyTypeEntity($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}