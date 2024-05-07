<?php


namespace App\Tests\service\RaceService;


use App\Entity\Circuit;
use App\Entity\Commissaire;
use App\Entity\Race;
use App\Entity\RaceData;
use App\Service\CircuitService;
use App\Service\CommissaireService;
use App\Service\RaceDataService;
use App\Service\RaceService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class CreateRaceTest extends TestCase
{

    /**
     * @test
     */
    public function createRace_ok(){

        $circuit = new Circuit();

        $commissaire = new Commissaire();

        $dataJoueur = new \stdClass();
        $dataJoueur->Pseudo = 'JohnConnor';
        $dataJoueur->Ecurie = 'Aston Martine';
        $dataJoueur->Classement = 1;
        $dataJoueur->NbCoups = 27;
        $dataJoueur->meilleurTour = 7;
        $dataJoueur->Grille = 4;
        $dataJoueur->Elimination = 'NA';
        $dataJoueur->Essais = '13 coups en 0\u002711,716';

        $data = new \stdClass();
        $data->Date = new DateTime( "2024-05-05 23:03:55");
        $data->circuit = 'CIRCUIT';
        $data->Commissaire = 'TEST COM';
        $data->nbJoueurs = 1;
        $data->nbTours = 32;
        $data->nbEssais = 15;
        $data->meteoEssais = 51;
        $data->meteoDepart = 42;
        $data->regleTop = true;
        $data->regleTOPmotor = false;
        $data->regleSuperTop = true;
        $data->regleGlissadesReduites = false;
        $data->joueurs[0] = $dataJoueur;

        $raceData = new RaceData();
        $raceData->setPseudo('JohnConnor');
        $raceData->setEcurie(null);
        $raceData->setClassement(1);
        $raceData->setNbCoups(27);
        $raceData->setMeilleurTour(7);
        $raceData->setGrille(4);
        $raceData->setElimination('NA');
        $raceData->setEssais('13 coups en 0\u002711,716');

        $raceExpected = new Race();
        $raceExpected->setDate(new DateTime( "2024-05-05 23:03:55"));
        $raceExpected->setCircuit($circuit);
        $raceExpected->setCommissaire($commissaire);
        $raceExpected->setNbJoueurs(1);
        $raceExpected->setNbTours(32);
        $raceExpected->setNbEssais(15);
        $raceExpected->setMeteoEssais(51);
        $raceExpected->setMeteoDepart(42);
        $raceExpected->setRegleTOP(true);
        $raceExpected->setRegleTOPmotor(false);
        $raceExpected->setRegleSuperTop(true);
        $raceExpected->setRegleGlissadesReduites(false);
        $raceExpected->addData($raceData);

        $objectManager = $this->createMock(EntityManagerInterface::class);

        $circuitService = $this->createMock(CircuitService::class);
        $circuitService->method('getCircuit')->willReturn($circuit);

        $commissaireService = $this->createMock(CommissaireService::class);
        $commissaireService->method('getCommissaire')->willReturn($commissaire);

        $raceDataService = $this->createMock(RaceDataService::class);
        $raceDataService->method('createRaceData')->with($this->equalTo($dataJoueur))->willReturn($raceData);

        $raceService = new RaceService($objectManager, $circuitService, $commissaireService,$raceDataService);

        $objectManager->expects($this->once())->method('persist')->with(
            $this->equalTo($raceExpected)
        );
        $objectManager->expects($this->once())->method('flush');

        $raceService->createRace($data);

    }

}