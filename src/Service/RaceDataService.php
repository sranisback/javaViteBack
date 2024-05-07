<?php


namespace App\Service;


use App\Entity\RaceData;

class RaceDataService
{
    public function createRaceData($data) {

        $raceData = new RaceData();
        $raceData->setPseudo($data->Pseudo);
        $raceData->setClassement($data->Classement);
        $raceData->setNbCoups($data->NbCoups);
        $raceData->setMeilleurTour($data->meilleurTour);
        $raceData->setGrille($data->Grille);
        $raceData->setElimination($data->Elimination);
        $raceData->setEssais($data->Essais);

        return $raceData;
    }
}