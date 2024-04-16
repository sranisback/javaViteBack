<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/lucky/number')]
    public function number(): JsonResponse
    {
        $number = random_int(0, 100);

        return new JsonResponse([
            'number' => $number
        ]);
    }
}