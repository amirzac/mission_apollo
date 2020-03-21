<?php

declare(strict_types=1);

namespace App\Tests\Unit\JourneyParticipant\Entity;

use App\Model\JourneyParticipant\Entity\ExpectedPrice;
use App\Model\JourneyParticipant\Entity\JourneyParticipant;
use App\Model\JourneyParticipant\Entity\JourneyType;
use App\Tests\Builder\JourneyParticipantBuilder;
use PHPUnit\Framework\TestCase;

class JourneyParticipantTest extends TestCase
{
    private JourneyParticipant $participant;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->participant = (new JourneyParticipantBuilder())->withComment()->buildWithLowestPriceAndOneDirection();
    }

    public function testUserData()
    {
        $this->assertEquals($this->participant->getDisplayedName(), "Test first name Test last name");
        $this->assertEquals($this->participant->getEmail(), 'test@test.com');

        $this->participant->setFirstName('Changed first name');
        $this->participant->setLastName('Changed last name');
        $this->assertEquals($this->participant->getDisplayedName(), "Changed first name Changed last name");

        $this->participant->setEmail('changed@mail.com');
        $this->assertEquals($this->participant->getEmail(), 'changed@mail.com');
    }

    public function testComment()
    {
        $this->assertEquals($this->participant->getComment(), 'Test comment');

        $participant = (new JourneyParticipantBuilder())->withoutComment()->buildWithLowestPriceAndOneDirection();
        $this->assertEquals($participant->getComment(), null);
    }

    public function testExpectedPrice()
    {
        $this->assertEquals($this->participant->getExpectedPrice(), ExpectedPrice::zeroTen());
        $this->assertTrue($this->participant->getExpectedPrice()->isZeroTen());

        $this->participant->setExpectedPrice(ExpectedPrice::TenFifty());
        $this->assertTrue($this->participant->getExpectedPrice()->isTenFifty());

        $this->participant->setExpectedPrice(ExpectedPrice::FiftyOneHundred());
        $this->assertTrue($this->participant->getExpectedPrice()->isFiftyOneHundred());
        $this->assertFalse($this->participant->getExpectedPrice()->isZeroTen());
    }

    public function testJourneyType()
    {
        $this->assertEquals($this->participant->getJourneyType(), JourneyType::oneDirection());
        $this->assertTrue($this->participant->getJourneyType()->isOneDirection());

        $this->participant->setJourneyType(JourneyType::twoDirections());
        $this->assertTrue($this->participant->getJourneyType()->isTwoDirections());
        $this->assertFalse($this->participant->getJourneyType()->isOneDirection());
    }
}