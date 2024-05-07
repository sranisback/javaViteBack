<?php


namespace App\Service;


use App\Entity\Commissaire;
use Doctrine\ORM\EntityManagerInterface;

class CommissaireService
{
    private EntityManagerInterface $entityManagerInterface;

    public function __construct(EntityManagerInterface $entityManagerInterface) {
        $this->entityManagerInterface = $entityManagerInterface;
    }

    public function getCommissaire($nom) {
        $commissaire = new Commissaire();
        $commissaire->setNom("commissaire inconnu");

        if($nom != null) {
            $commissaire = $this->entityManagerInterface->getRepository(Commissaire::class)->findOneBy(['nom' => $nom]);
        }

        return $commissaire;
    }

}