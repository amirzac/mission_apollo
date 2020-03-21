<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\ReadModel\JourneyParticipant\JourneyParticipantFetcher;

/**
 * @Route("/journey-participants", name="journey_participants")
 */
class JourneyParticipantController extends AbstractController
{
    private const PER_PAGE = 20;

    /**
     * @Route("", name="")
     * @param Request $request
     * @param JourneyParticipantFetcher $fetcher
     * @return Response
     */
    public function index(Request $request, JourneyParticipantFetcher $fetcher): Response
    {
        $pagination = $fetcher->all(
            $request->query->getInt('page', 1),
            self::PER_PAGE,
            'id',
            'desc'
        );

        return $this->render('app/participants/list.html.twig', [
            'title' => 'Journey participants',
            'pagination' => $pagination,
        ]);
    }
}