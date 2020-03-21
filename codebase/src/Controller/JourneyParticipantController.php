<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\ReadModel\JourneyParticipant\JourneyParticipantFetcher;
use App\Model\JourneyParticipant\UseCase\Create;

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

        return $this->render('app/journey-participant/list.html.twig', [
            'title' => 'Journey participants',
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/register", name="_register")
     * @param Request $request
     * @param Create\Handler $handler
     * @return Response
     */
    public function create(Request $request, Create\Handler $handler): Response
    {
        $command = new Create\Command();
        $form = $this->createForm(Create\Form::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $handler->handle($command);
                $this->addFlash('success', 'You have been registered');
                return $this->redirectToRoute('journey_participants');
            } catch (\DomainException $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('app/journey-participant/register.html.twig', [
            'form' => $form->createView(),
            'title' => 'Registration to journey',
        ]);
    }
}