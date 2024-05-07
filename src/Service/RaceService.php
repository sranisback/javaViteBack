<?php


namespace App\Service;


use App\Entity\Race;
use Doctrine\ORM\EntityManagerInterface;

class RaceService
{
    private EntityManagerInterface $entityManagerInterface;
    private CircuitService $circuitService;
    private CommissaireService $commissaireService;
    private RaceDataService $raceDataService;

    public function __construct(
        EntityManagerInterface $entityManagerInterface,
        CircuitService $circuitService,
        CommissaireService $commissaireService,
        RaceDataService $raceDataService
    ) {
        $this->entityManagerInterface = $entityManagerInterface;
        $this->circuitService = $circuitService;
        $this->commissaireService = $commissaireService;
        $this->raceDataService = $raceDataService;
    }

    public function createRace($data) {

        $circuit = $this->circuitService->getCircuit($data->circuit);
        $commissaire = $this->commissaireService->getCommissaire($data->Commissaire);

        $race = new Race();
        $race->setDate($data->Date);
        $race->setCircuit($circuit);
        $race->setCommissaire($commissaire);
        $race->setNbJoueurs($data->nbJoueurs);
        $race->setNbTours($data->nbTours);
        $race->setNbEssais($data->nbEssais);
        $race->setMeteoEssais($data->meteoEssais);
        $race->setMeteoDepart($data->meteoDepart);
        $race->setRegleTOP($data->regleTop);
        $race->setRegleTOPmotor($data->regleTOPmotor);
        $race->setRegleSuperTop($data->regleSuperTop);
        $race->setRegleGlissadesReduites($data->regleGlissadesReduites);

        foreach ($data->joueurs as $raceData) {
            $race->addData($this->raceDataService->createRaceData($raceData));
        }

        $this->entityManagerInterface->persist($race);
        $this->entityManagerInterface->flush();

        return $race;

    }

}