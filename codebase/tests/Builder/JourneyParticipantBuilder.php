<?php

declare(strict_types=1);

namespace App\Tests\Builder;

use App\Model\JourneyParticipant\Entity\ExpectedPrice;
use App\Model\JourneyParticipant\Entity\JourneyParticipant;
use App\Model\JourneyParticipant\Entity\JourneyType;
use App\Model\JourneyParticipant\Entity\UserData;

class JourneyParticipantBuilder
{
    private ?string $comment;

    public function withComment(): self
    {
        $clone = clone $this;
        $clone->comment = 'Test comment';
        return $clone;
    }

    public function withoutComment(): self
    {
        $clone = clone $this;
        $clone->comment = null;
        return $clone;
    }

    public function buildWithLowestPriceAndOneDirection(): JourneyParticipant
    {
        return new JourneyParticipant(
            new UserData('Test first name', 'Test last name', 'test@test.com'),
            ExpectedPrice::zeroTen(),
            JourneyType::oneDirection(),
            $this->comment
        );
    }
}