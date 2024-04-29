<?php


namespace App\Service;


use App\Dto\PiloteDto;
use App\Entity\Pilote;
use Doctrine\ORM\EntityManagerInterface;

class PiloteService
{
    private $entityManagerInterface;

    public function __construct(EntityManagerInterface $entityManagerInterface) {
        $this->entityManagerInterface = $entityManagerInterface;
    }

    public function getAllPilotes() {
        $pilotesList = $this->entityManagerInterface->getRepository(Pilote::class)->findAll();

        foreach ($pilotesList as $pilote) {
            $piloteDtoList[] = $this->convertPiloteToPiloteDto($pilote);
        }

        return $piloteDtoList;
    }

    private function convertPiloteToPiloteDto(Pilote $pilote) {

        $piloteDto = new PiloteDto();
        $piloteDto->setId($pilote->getId());
        $piloteDto->setNom($pilote->getName());

        return $piloteDto;

    }
}