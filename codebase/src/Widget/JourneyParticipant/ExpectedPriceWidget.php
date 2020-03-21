<?php

declare(strict_types=1);

namespace App\Widget\JourneyParticipant;

use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ExpectedPriceWidget extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('journey_price', [$this, 'price'], ['needs_environment' => true, 'is_safe' => ['html']]),
        ];
    }

    public function price(Environment $twig, string $price)
    {
        return $twig->render('widget/journey-participant/price.html.twig', [
            'price' => $price
        ]);
    }
}