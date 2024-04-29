<?php

namespace App\Tests\service\PiloteService;

use App\Dto\PiloteDto;
use App\Entity\Pilote;
use App\Entity\User;
use App\Repository\PiloteRepository;
use App\Service\PiloteService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class GetAllPilotesTest extends TestCase
{
    /**
     * @test
     */
    public function all_is_ok(): void
    {
        $user = new User();

        $pilote = new Pilote();
        $pilote->setId(1);
        $pilote->setName("TEST");
        $pilote->setUser($user);

        $piloteRepository = $this->createMock(PiloteRepository::class);
        $piloteRepository->method('findAll')->willReturn([$pilote]);

        $objectManager = $this->createMock(EntityManagerInterface::class);
        $objectManager->method('getRepository')->willReturn($piloteRepository);

        $piloteService = new PiloteService($objectManager);

        $piloteDtoList = $piloteService->getAllPilotes();

        $this->assertNotNull($piloteDtoList);

        /** @var PiloteDto $piloteDto */
        $piloteDto =  $piloteDtoList[0];

        $this->assertEquals(1, $piloteDto->getId());
        $this->assertEquals("TEST", $piloteDto->getNom());

    }
}
