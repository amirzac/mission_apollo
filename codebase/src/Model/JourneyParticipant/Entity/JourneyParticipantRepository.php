<?php

declare(strict_types=1);

namespace App\Model\JourneyParticipant\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class JourneyParticipantRepository
{
    private ObjectRepository $repo;

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repo = $em->getRepository(JourneyParticipant::class);
        $this->em = $em;
    }

    public function add(JourneyParticipant $journeyParticipant): void
    {
        $this->em->persist($journeyParticipant);
    }
}