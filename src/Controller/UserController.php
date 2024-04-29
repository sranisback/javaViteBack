<?php

namespace App\Controller;

use App\Dto\UserDto;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/api/user', name: 'app_user')]
    public function getAllUsers(EntityManagerInterface $entityManagerInterface): JsonResponse
    {
        $userList = $entityManagerInterface->getRepository(User::class)->findAll();

        $userDtoList = [];

        /** @var User $user */
        foreach ($userList as $user) {
            $userDto = new UserDto();

            $userDto->setId($user->getId());
            $userDto->setPassword($user->getPassword());
            $userDto->setUserName($user->getUserName());

            $userDtoList[] = $userDto;
        }

        return $this->json($userDtoList);
    }
}
