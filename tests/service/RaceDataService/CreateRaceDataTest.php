<?php


namespace App\Tests\service\RaceDataService;


use App\Entity\RaceData;
use App\Service\RaceDataService;
use PHPUnit\Framework\TestCase;

class CreateRaceDataTest extends TestCase
{
    /**
     * @test
     */
    public function raceData_created_ok() {

        $dataJoueur = new \stdClass();
        $dataJoueur->Pseudo = 'JohnConnor';
        $dataJoueur->Ecurie = 'Aston Martine';
        $dataJoueur->Classement = 1;
        $dataJoueur->NbCoups = 27;
        $dataJoueur->meilleurTour = 7;
        $dataJoueur->Grille = 4;
        $dataJoueur->Elimination = 'NA';
        $dataJoueur->Essais = '13 coups en 0\u002711,716';

        $raceDataExpected = new RaceData();
        $raceDataExpected->setPseudo('JohnConnor');
        $raceDataExpected->setEcurie(null);
        $raceDataExpected->setClassement(1);
        $raceDataExpected->setNbCoups(27);
        $raceDataExpected->setMeilleurTour(7);
        $raceDataExpected->setGrille(4);
        $raceDataExpected->setElimination('NA');
        $raceDataExpected->setEssais('13 coups en 0\u002711,716');

        $raceDataService = new RaceDataService();

        $raceDataActual = $raceDataService->createRaceData($dataJoueur);

        self::assertEquals($raceDataExpected, $raceDataActual);

    }
}