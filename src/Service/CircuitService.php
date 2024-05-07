<?php


namespace App\Service;


use App\Entity\Circuit;
use Doctrine\ORM\EntityManagerInterface;

class CircuitService
{
    private EntityManagerInterface $entityManagerInterface;

    public function __construct(EntityManagerInterface $entityManagerInterface) {
        $this->entityManagerInterface = $entityManagerInterface;
    }

    public function getCircuit($nom) {
        $circuit = new Circuit();

        if($nom != null) {
            $circuit = $this->entityManagerInterface->getRepository(Circuit::class)->findOneBy(['nom' => $nom]);
        }

        return $circuit;
    }

}