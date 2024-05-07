<?php


namespace App\Tests\service\CircuitService;


use App\Entity\Circuit;
use App\Service\CircuitService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class GetCircuitTest extends TestCase
{
    /**
     * @test
     */
    public function getCircuit_dont_exist() {

        $circuitRepoMock = $this->getMockBuilder(Circuit::class)
            ->addMethods(['findOneBy'])
            ->getMock();
        $circuitRepoMock->method('findOneBy')->willReturn(null);

        $objectManager = $this->createMock(EntityManagerInterface::class);
        $objectManager->method('getRepository')->willReturn($circuitRepoMock);

        $circuitService = new CircuitService($objectManager);

        $circuitActual = $circuitService->getCircuit("TEST");

        self::assertNull($circuitActual);

    }

    /**
     * @test
     */
    public function getCircuit_exist() {

        $circuitActual = new Circuit();
        $circuitActual->setNom("TEST");
        $circuitActual->setId(25);

        $circuitRepoMock = $this->getMockBuilder(Circuit::class)
            ->addMethods(['findOneBy'])
            ->getMock();
        $circuitRepoMock->method('findOneBy')->willReturn($circuitActual);

        $objectManager = $this->createMock(EntityManagerInterface::class);
        $objectManager->method('getRepository')->willReturn($circuitRepoMock);

        $circuitService = new CircuitService($objectManager);

        $circuitActual = $circuitService->getCircuit("TEST");

        $circuitExpected = new Circuit();
        $circuitExpected->setNom("TEST");
        $circuitExpected->setId(25);

        self::assertEquals($circuitExpected, $circuitActual);

    }

}