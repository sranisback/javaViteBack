<?php

namespace App\Normalizer;

use App\Entity\Race;
use DateTime;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class RaceDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function supportsDenormalization(
        mixed $data,
        string $type,
        ?string $format = null,
        array $context = []
    ): bool {
        return true;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []) : mixed
    {
        $mapping = [
            'Date' => 'date',
            'Commissaire' => 'Commissaire ',
            'circuit' => 'Circuit',
            'nbJoueurs' => 'nb_Joueurs',
            'nbTours' => 'nb_Tours',
            'nbEssais' => 'nb_Essais',
            'meteoEssais' => 'MeteoEssais',
            'meteoDepart' => 'MeteoDepart',
            'regleTop' => 'Regle TOP',
            'regleTOPmotor' => 'Regle TOPmotor',
            'regleSuperTop' => 'Regle SuperTOP',
            'regleGlissadesReduites' => 'Regle Glissades Reduites'
        ];

        $mappingJoueurData = [
            'meilleurTour' => 'Meilleur Tour',
        ];

        $data['date'] = DateTime::createFromFormat('Ymd_His', $data['Date']);

        $data['joueurs'] = array_map(
            function($compteurJoueur) use (&$data, $mappingJoueurData) {
                $joueur = $data['Joueur' . $compteurJoueur];
                unset($data['Joueur' . $compteurJoueur]);
                foreach ($mappingJoueurData as $newKey => $oldKey) {
                    if (array_key_exists($oldKey, $joueur)) {
                        $joueur[$newKey] = $joueur[$oldKey];
                        unset($joueur[$oldKey]);
                    }
                }
                return (object) $joueur;
            },
            range(0, $data['nb_Joueurs'] - 1)
        );

        foreach ($mapping as $newKey => $oldKey) {
            if (array_key_exists($oldKey, $data)) {
                $data[$newKey] = $data[$oldKey];
                unset($data[$oldKey]);
            }
        }

        return (object) $data;
    }

    public function __call(string $name, array $arguments) {}

    public function getSupportedTypes(?string $format): array
    {
        return [
            Race::class => true
        ];
    }
}