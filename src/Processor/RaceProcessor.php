<?php


namespace App\Processor;


use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Service\RaceService;
use Symfony\Component\HttpFoundation\Response;

class RaceProcessor implements ProcessorInterface
{
    private RaceService $raceService;

    public function __construct(RaceService $raceService) {
        $this->raceService = $raceService;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if($data) {
            return $this->raceService->createRace($data);
        }

        return new Response(null, Response::HTTP_BAD_REQUEST);
    }
}