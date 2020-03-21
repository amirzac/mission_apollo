<?php

declare(strict_types=1);

namespace App\Model\JourneyParticipant\UseCase\Create;

use App\Model\JourneyParticipant\Entity\ExpectedPrice;
use App\Model\JourneyParticipant\Entity\JourneyType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', Type\TextType::class)
            ->add('lastName', Type\TextType::class)
            ->add('email', Type\TextType::class)
            ->add('expectedPrice', Type\ChoiceType::class, [
                'choices' => [
                    '0-10 thousands' => ExpectedPrice::ZERO_TEN,
                    '10-50 thousands' => ExpectedPrice::TEN_FIFTY,
                    '50-100 thousands' => ExpectedPrice::FIFTY_ONE_HUNDRED,
                ],
            ])
            ->add('journeyType', Type\ChoiceType::class, [
                'choices' => [
                    'One direction' => JourneyType::ONE_DIRECTION,
                    'Two directions' => JourneyType::TWO_DIRECTIONS,
                ],
            ])
            ->add('comment', Type\TextareaType::class, [
                'required'   => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array(
            'data_class' => Command::class,
        ));
    }
}