<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
// use App\Repository\ArticleRepository;
use App\Entity\User;
use App\Form\UserType;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();

        return $this->render('home/index.html.twig', [
            'users' => $users,
        ]);
    }
}
