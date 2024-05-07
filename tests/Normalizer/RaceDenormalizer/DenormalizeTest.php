<?php


namespace App\Tests\Normalizer\RaceDenormalizer;


use App\Entity\Race;
use App\Normalizer\RaceDenormalizer;
use DateTime;
use PHPUnit\Framework\TestCase;

class DenormalizeTest extends TestCase
{
    /**
     * @test
     */
    public function denormalization_ok() {

        $raceDenormalizer = new RaceDenormalizer();

        $sDatat = [
            'Pseudo' => "JohnConnor",
            'Ecurie' => "Aston Martine",
            'Classement' => 1,
            'NbCoups' => 27,
            'Meilleur Tour' => 7,
            'Grille' => 4,
            'Elimination' => 'NA',
            'Essais' => "13 coups en 0\u002711,716"
        ];

        $data = [
            'Date' => '20240505_230355',
            'Commissaire' => 'TEST COM',
            'Circuit' => 'TEST CIRCUIT',
            'nb_Joueurs' => 1,
            'nb_Tours' => 32,
            'nb_Essais' => 15,
            'MeteoEssais' => 51,
            'MeteoDepart' => 42,
            'Regle TOP' => true,
            'Regle TOPmotor' => false,
            'Regle SuperTOP' => true,
            'Regle Glissades Reduites' => false,
            'Joueur0' => $sDatat
        ];

        $dataJoueurExpected = new \stdClass();
        $dataJoueurExpected->Pseudo = 'JohnConnor';
        $dataJoueurExpected->Ecurie = 'Aston Martine';
        $dataJoueurExpected->Classement = 1;
        $dataJoueurExpected->NbCoups = 27;
        $dataJoueurExpected->meilleurTour = 7;
        $dataJoueurExpected->Grille = 4;
        $dataJoueurExpected->Elimination = 'NA';
        $dataJoueurExpected->Essais = '13 coups en 0\u002711,716';

        $dataExpected = new \stdClass();
        $dataExpected->Date =new DateTime( "2024-05-05 23:03:55");
        $dataExpected->Commissaire = 'TEST COM';
        $dataExpected->circuit = 'TEST CIRCUIT';
        $dataExpected->nbJoueurs = 1;
        $dataExpected->nbTours = 32;
        $dataExpected->nbEssais = 15;
        $dataExpected->meteoEssais = 51;
        $dataExpected->meteoDepart = 42;
        $dataExpected->regleTop = true;
        $dataExpected->regleTOPmotor = false;
        $dataExpected->regleSuperTop = true;
        $dataExpected->regleGlissadesReduites = false;
        $dataExpected->joueurs[0] = $dataJoueurExpected;

        $dataNormalized = $raceDenormalizer->denormalize($data, Race::class, "json", []);

        self::assertEquals($dataExpected, $dataNormalized);

    }
}