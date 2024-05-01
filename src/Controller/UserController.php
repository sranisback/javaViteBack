<?php

namespace App\Controller;

use App\Dto\UserDto;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
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

    #[Route('/user/login', name: 'app_login', methods: ['POST'])]
    public function login(#[CurrentUser] $user = null): Response
    {
        return $this->json([
            'user' => $user ? $user->getId() : null,
        ]);
    }
}
