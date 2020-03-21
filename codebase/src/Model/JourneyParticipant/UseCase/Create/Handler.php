<?php

declare(strict_types=1);

namespace App\Model\JourneyParticipant\UseCase\Create;

use App\Model\Flusher;
use App\Model\JourneyParticipant\Entity\ExpectedPrice;
use App\Model\JourneyParticipant\Entity\JourneyParticipant;
use App\Model\JourneyParticipant\Entity\JourneyParticipantRepository;
use App\Model\JourneyParticipant\Entity\JourneyType;
use App\Model\JourneyParticipant\Entity\UserData;

class Handler
{
    private JourneyParticipantRepository $journeyParticipants;
    private Flusher $flusher;

    public function __construct(JourneyParticipantRepository $journeyParticipants, Flusher $flusher)
    {
        $this->journeyParticipants = $journeyParticipants;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        if ($this->journeyParticipants->hasByEmail($command->email)) {
            throw new \DomainException('You have already registered');
        }

        $journeyParticipant = new JourneyParticipant(
            new UserData($command->firstName, $command->lastName, $command->email),
            new ExpectedPrice($command->expectedPrice),
            new JourneyType(boolval($command->journeyType)),
            $command->comment
        );

        $this->journeyParticipants->add($journeyParticipant);

        $this->flusher->flush();
    }
}