<?php

namespace App\Controller;

use App\Dto\PiloteDto;
use App\Entity\Pilote;
use App\Service\PiloteService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class PiloteController extends AbstractController
{
    #[Route('/api/pilote', name: 'app_pilote')]
    public function getAllPilotes(PiloteService $piloteService): JsonResponse
    {
        return $this->json($piloteService->getAllPilotes());
    }
}
