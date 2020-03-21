<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Model\JourneyParticipant\Entity\ExpectedPrice;
use App\Model\JourneyParticipant\Entity\JourneyParticipant;
use App\Model\JourneyParticipant\Entity\JourneyType;
use App\Model\JourneyParticipant\Entity\UserData;
use Doctrine\Persistence\ObjectManager;

class JourneyParticipantFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(42, 'journey_participant', function (){

            /* @var ExpectedPrice $expectedPrice */
            $expectedPrice = $this->faker->randomElement([
                ExpectedPrice::zeroTen(),
                ExpectedPrice::TenFifty(),
                ExpectedPrice::FiftyOneHundred()]
            );

            return new JourneyParticipant(
                new UserData($this->faker->firstName, $this->faker->lastName, $this->faker->unique()->email),
                $expectedPrice,
                new JourneyType($this->faker->boolean),
                $this->faker->text(50)
            );
        });

        $manager->flush();
    }
}