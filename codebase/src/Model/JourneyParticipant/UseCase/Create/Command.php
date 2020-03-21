<?php

declare(strict_types=1);

namespace App\Model\JourneyParticipant\UseCase\Create;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    public $firstName;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    public $lastName;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Email()
     */
    public $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Choice(callback={"App\Model\JourneyParticipant\Entity\ExpectedPrice", "getValues"})
     */
    public $expectedPrice;

    /**
     * @Assert\NotBlank()
     * @Assert\Choice(callback={"App\Model\JourneyParticipant\Entity\JourneyType", "getValues"})
     */
    public $journeyType;

    /**
     * @Assert\Type("string")
     * @Assert\Length(
     *     max = 1000,
     *     maxMessage = "Comment cannot be longer than {{ limit }} characters"
     * )
     */
    public $comment;
}