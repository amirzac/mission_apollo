<?php

declare(strict_types=1);

namespace App\Model\JourneyParticipant\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="journey_participant")
 */
class JourneyParticipant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=180, nullable=false)
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", length=180, nullable=false)
     */
    private string $lastName;

    /**
     * @ORM\Column(type="string", length=180, unique=true, nullable=false)
     */
    private string $email;

    /**
     * @var ExpectedPrice
     * @ORM\Column(type="journey_price", length=50, nullable=false)
     */
    private ExpectedPrice $expectedPrice;

    /**
     * @var JourneyType
     * @ORM\Column(type="journey_type", nullable=false)
     */
    private JourneyType $journeyType;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $comment;

    public function __construct(
        UserData $userData,
        ExpectedPrice $expectedPrice,
        JourneyType $journeyType,
        string $comment = null
    )
    {
        $this->firstName = $userData->getFirstName();
        $this->lastName = $userData->getLastName();
        $this->email = $userData->getEmail();
        $this->expectedPrice = $expectedPrice;
        $this->journeyType = $journeyType;
        $this->comment = $comment;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getDisplayedName(): string
    {
        return sprintf("%s %s", $this->firstName, $this->lastName);
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setExpectedPrice(ExpectedPrice $expectedPrice): void
    {
        $this->expectedPrice = $expectedPrice;
    }

    public function getExpectedPrice(): ExpectedPrice
    {
        return $this->expectedPrice;
    }

    public function setJourneyType(JourneyType $journeyType): void
    {
        $this->journeyType = $journeyType;
    }

    public function getJourneyType(): JourneyType
    {
        return $this->journeyType;
    }

    public function setComment(string $comment = null): void
    {
        $this->comment = $comment;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }
}