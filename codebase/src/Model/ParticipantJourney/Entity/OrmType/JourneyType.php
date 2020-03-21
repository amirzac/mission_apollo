<?php

declare(strict_types=1);

namespace App\Model\ParticipantJourney\Entity\OrmType;

use App\Model\ParticipantJourney\Entity\JourneyType as JourneyTypeEntity;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\SmallIntType;

class JourneyType extends SmallIntType
{
    public const NAME = 'journey_type';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof JourneyTypeEntity ? $value->getName() : $value;
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